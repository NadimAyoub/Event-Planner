<?php
class Type {
    private $Description;
    private $Min_Cost;    
    private $Min_People;
    private $Max_People;


    
    public function __construct($Description, $Min_Cost, $Min_People, $Max_People) {
        $this->Description = $description;
        $this->Min_Cost = $min_cost;
        $this->Min_People = $min_people;
        $this->Max_People = $max_people;

    }
    
    public function getDescription() { return $this->Description; }
    public function getMinCost() { return $this->Min_Cost; }
    public function getMinPeople() { return $this->Min_People; }
    public function getMaxPeople() { return $this->Max_People; }
}
?>