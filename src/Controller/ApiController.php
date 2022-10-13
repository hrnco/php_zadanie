<?php

namespace App\Controller;

use App\Factory\BranchModelFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{

    #[Route('/api/branches', name: 'app_api')]
    public function index(): Response
    {
        $branchModels = BranchModelFactory::all();

        $resultData = [];
        foreach($branchModels as $models) {
            $resultData[] = [
                'id' => $models->getInternalId(),
                'name' => $models->getInternalName(),
            ];
        }
        $response = new JsonResponse($resultData);
        $response->setEncodingOptions( $response->getEncodingOptions() | JSON_PRETTY_PRINT );
        return $response;
    }

    #[Route('/api/branches/detail/{id}', name: 'app_api_detail')]
    public function detail($id): Response
    {
        $branchModels = BranchModelFactory::all();

        if (!isset($branchModels[$id])) {
            throw new \Exception('Not found!');
        }
        $branchModel = $branchModels[$id];
        $hours = [];
        foreach($branchModel->getBusinessHours() as $hour) {
            $hours[] = [
                'businnes_hours' => $hour->getBusinessHour(),
                'day_of_week' => $hour->getDayOfWeek()
            ];
        }
        $resultData = [
            'id' => $branchModel->getInternalId(),
            'name' => $branchModel->getInternalName(),
            'address' => $branchModel->getAddress(),
            'announcement' => $branchModel->getAnnouncement(),
            'web' => $branchModel->getWeb(),
            'location' => (string)$branchModel->getLocation(),
            'hours' => $hours,
        ];
        $response = new JsonResponse($resultData);
        $response->setEncodingOptions( $response->getEncodingOptions() | JSON_PRETTY_PRINT );
        return $response;
    }

}
