<?php
class EventRegistration {
    private $name;
    private $num_people;    
    private $total;
    private $EventID;
    private $UserID;
    
    public function __construct($name, $num_people, $total, $EventID, $UserID) {
        $this->name = $name;
        $this->num_people = $num_people;
        $this->total = $total;
        $this->EventID = $EventID;
        $this->UserID = $UserID;
    }
    
    public function getname() { return $this->name; }
    public function getnum() { return $this->num_people; }
    public function gettotal() { return $this->total; }
    public function getEID() { return $this->EventID; }
    public function getUID() { return $this->UserID; }
}
?>