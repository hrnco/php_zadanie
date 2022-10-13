<?php

namespace App\Factory\Connector;

use App\Model\BranchModel;
use App\Model\BusinessHourModel;
use App\Model\Coordinates;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class UlozenkaConnector implements ApiConnectorInterface
{

    public function getApiUri(): string
    {
        return 'https://www.ulozenka.cz/gmap';
    }

    public function getCacheTimeSeconds(): int
    {
        return 1;
    }

    public function getInternalIdPrefix(): string
    {
        return 'ulozenka';
    }

    /**
     * @return array
     * @throws TransportExceptionInterface
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    public function getBranchModels(): array
    {
        $client = HttpClient::create();
        $api_response = $client->request('GET', $this->getApiUri());
        $api_data = json_decode($api_response->getContent());

        $branchModels = [];

        if (!is_array($api_data)) {
            return $branchModels;
        }
        foreach($api_data as $branch) {
            $coordinates = new Coordinates($branch->lat, $branch->lng);
            $hours = [];
            foreach($branch->openingHours as $dayHour) {
                $businessHour = $this->getHourFormatToFloat($dayHour->close) - $this->getHourFormatToFloat($dayHour->open);
                $hours[] = new BusinessHourModel($dayHour->day, $businessHour);
            }
            $id = $this->getInternalIdPrefix().'_'.$branch->id;
            $branchModels[$id] = new BranchModel($id, $branch->name, $coordinates, $hours, $branch->name, $branch->odkaz, implode("\n", $branch->announcements));
        }
        return $branchModels;

    }

    private function getHourFormatToFloat($hour): float
    {
        $hour = explode(':', $hour);
        $minutes = (int)$hour[0] * 60 + (int)$hour[1];
        return round($minutes / 60, 2);
    }

}