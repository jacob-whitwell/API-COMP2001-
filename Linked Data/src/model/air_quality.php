<?php

class Air_Quality
{
    //Name,Address,Post Code,Town,Type,PM2_5,Exceed_10,Latitude,Longitude
    private $name;
    private $address;
    private $postcode;
    private $town;
    private $type;
    private $pm25;
    private $exceed10;
    private $lat;
    private $lng;

    /* Create the constructor */
    public function __construct($Name, $Address, $Postcode, $Town, $Type, $Pm25, $Exceed10, $Lat, $Lng)
    {
        $this->name = $Name;
        $this->address = $Address;
        $this->postcode = $Postcode;
        $this->town = $Town;
        $this->type = $Type;
        $this->pm25 = $Pm25;
        $this->exceed10 = $Exceed10;
        $this->lat = $Lat;
        $this->lng = $Lng;
    }

    /* Create Getters and Setters */

    public function getName() { return $this->name; }
    public function getAddress() { return $this->address; }
    public function getPostcode() { return $this->postcode; }
    public function getTown() { return $this->town; }
    public function getType() { return $this->type; }
    public function getPm25() { return $this->pm25; }
    public function getExceed10() { return $this->exceed10; }
    public function getLat() { return $this->lat; }
    public function getLng() { return $this->lng; }
}

