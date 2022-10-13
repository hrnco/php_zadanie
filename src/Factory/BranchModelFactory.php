<?php

namespace App\Factory;

use App\Factory\Connector\UlozenkaConnector;
use App\Factory\Connector\ApiConnectorInterface;
use App\Model\BranchModel;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Contracts\Cache\ItemInterface;

class BranchModelFactory
{

    /**
     * @return ApiConnectorInterface[]
     */
    public static function getConnectors(): array
    {
        return [
            new UlozenkaConnector()
        ];
    }


    /**
     * @return BranchModel[]
     * @throws InvalidArgumentException
     */
    public static function all(): array
    {
        $models = [];
        foreach(self::getConnectors() as $connector) {
            $models += self::getFromOneConnector($connector);
        }
        return $models;
    }

    /**
     * @return BranchModel[]
     * @throws InvalidArgumentException
     */
    private static function getFromOneConnector(ApiConnectorInterface $connector): array
    {
        $cache = new FilesystemAdapter();
        return $cache->get(self::getConnectorCacheId($connector), function (ItemInterface $item) use ($connector) {
            $item->expiresAfter($connector->getCacheTimeSeconds());
            return $connector->getBranchModels();
        });
    }

    private static function getConnectorCacheId(ApiConnectorInterface $connector): string
    {
        $reflect = new \ReflectionClass($connector);
        return 'cache_'.$reflect->getShortName();
    }

}