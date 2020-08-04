<?php
class Offer {
    private $Price;

    
    public function __construct($price) {
        $this->Price = $price;
    }
    
    public function getPrice() { return $this->Price; }
}
?>