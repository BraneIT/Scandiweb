<?php
namespace Scandioop\Models;

abstract class Product {
    private $sku;
    private $name;
    private $price;
    private $product_type_id;
    

    public function setSku($sku) {
        $this->sku = $sku;
    }

    public function getSku() {
        return $this->sku;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setProductTypeId($product_type_id) {
        $this->product_type_id = $product_type_id;
    }

    public function getProductTypeId(){
        
        return $this->product_type_id;
    }
    

}

?>
