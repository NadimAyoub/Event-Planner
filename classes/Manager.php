<?php
class Manager {
    private $M_Name;
    private $Number;    
    private $M_Address;
    private $Email;

    
    public function __construct($mname, $number, $address, $email) {
        $this->M_Name = $mname;
        $this->Number = $number;
        $this->M_Address = $address;
        $this->Email = $email;
    }
    
    public function getName() { return $this->M_Name; }
    public function getNumber() { return $this->Number; }
    public function getAddress() { return $this->M_Address; }
    public function getEmail() { return $this->Email; }
}
?>