<?php
class Sponsor {
    private $Name;
    private $Number;    
    private $Email;

    
    public function __construct($name, $number, $email) {
        $this->Name = $name;
        $this->Number = $number;
        $this->Email = $email;
    }
    
    public function getName() { return $this->Name; }
    public function getNumber() { return $this->Number; }
    public function getEmail() { return $this->Email; }
}
?>