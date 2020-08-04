<?php
class Location {
    private $Name;
    private $Address;
    private $MaxCapacity;
    
    public function __construct($name, $address, $maxCap) {
        $this->Name = $name;
        $this->Address = $address;
        $this->MaxCapacity = $maxCap;
    }
    
    public function getName() { return $this->Name; }
    public function getAddress() { return $this->Address; }
    public function getCap() { return $this->MaxCapacity; }
}
?>