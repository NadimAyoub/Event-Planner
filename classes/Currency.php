<?php
class Currency {
    private $C_Name;
    private $Type;    
    private $Value;
    private $Local_Currency_Value;

    
    public function __construct($cname, $type, $value, $localvalue) {
        $this->C_Name = $cname;
        $this->Type = $type;
        $this->Value = $value;
        $this->Local_Currency_Value = $localvalue;
    }
    
    public function getName() { return $this->C_Name; }
    public function getType() { return $this->Type; }
    public function getValue() { return $this->Value; }
    public function getLocalvalue() { return $this->Local_Currency_Value; }
}
?>