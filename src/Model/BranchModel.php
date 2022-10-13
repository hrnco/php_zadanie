<?php

namespace App\Model;

class BranchModel
{
    /** @var string */
    private $internalId;
    /** @var string */
    private $internalName;
    /** @var Coordinates */
    private $location;
    /** @var array<BusinessHourModel> */
    private $businessHours;
    /** @var string */
    private $address;
    /** @var string */
    private $web;
    /** @var string */
    private $announcement;

    /**
     * @param string $internalId
     * @param string $internalName
     * @param Coordinates $location
     * @param BusinessHourModel[] $businessHours
     * @param string $address
     * @param string $web
     * @param string $announcement
     */
    public function __construct(string $internalId, string $internalName, Coordinates $location, array $businessHours, string $address, string $web, string $announcement)
    {
        $this->internalId = $internalId;
        $this->internalName = $internalName;
        $this->location = $location;
        $this->businessHours = $businessHours;
        $this->address = $address;
        $this->web = $web;
        $this->announcement = $announcement;
    }

    /**
     * @return string
     */
    public function getInternalId(): string
    {
        return $this->internalId;
    }

    /**
     * @return string
     */
    public function getInternalName(): string
    {
        return $this->internalName;
    }

    /**
     * @return Coordinates
     */
    public function getLocation(): Coordinates
    {
        return $this->location;
    }

    /**
     * @return BusinessHourModel[]
     */
    public function getBusinessHours(): array
    {
        return $this->businessHours;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function getWeb(): string
    {
        return $this->web;
    }

    /**
     * @return string
     */
    public function getAnnouncement(): string
    {
        return $this->announcement;
    }

}