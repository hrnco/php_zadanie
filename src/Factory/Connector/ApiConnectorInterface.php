<?php

namespace App\Factory\Connector;

use App\Model\BranchModel;

interface ApiConnectorInterface
{

    /**
     * @return string
     */
    public function getApiUri(): string;

    /**
     * @return int
     */
    public function getCacheTimeSeconds(): int;

    /**
     * @return BranchModel[]
     */
    public function getBranchModels(): array;

    /**
     * @return string
     */
    public function getInternalIdPrefix(): string;

}