<?php
class Role {
    private $Description;    

    
    public function __construct($descripiton) {
        $this->Description = $descripiton;
    }
    
    public function getDesc() { return $this->Description; }
}
?>