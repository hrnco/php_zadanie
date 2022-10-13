<?php

namespace App\Model;

class BusinessHourModel
{
    /** @var string */
    private $dayOfWeek;
    /** @var string */
    private $businessHour;

    /**
     * @param string $dayOfWeek
     * @param string $businessHour
     */
    public function __construct(string $dayOfWeek, string $businessHour)
    {
        $this->dayOfWeek = $dayOfWeek;
        $this->businessHour = $businessHour;
    }

    /**
     * @return string
     */
    public function getDayOfWeek(): string
    {
        return $this->dayOfWeek;
    }

    /**
     * @param string $dayOfWeek
     */
    public function setDayOfWeek(string $dayOfWeek): void
    {
        $this->dayOfWeek = $dayOfWeek;
    }

    /**
     * @return string
     */
    public function getBusinessHour(): string
    {
        return $this->businessHour;
    }

    /**
     * @param string $businessHour
     */
    public function setBusinessHour(string $businessHour): void
    {
        $this->businessHour = $businessHour;
    }

}