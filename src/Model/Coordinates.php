<?php

namespace App\Model;

class Coordinates
{

    /** @var float */
    private $latitude;
    /** @var float */
    private $longitude;

    /**
     * @param float $latitude
     * @param float $longitude
     */
    public function __construct(float $latitude, float $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function __toString(): string
    {
        return $this->getLatitude().','.$this->getLongitude();
    }

}