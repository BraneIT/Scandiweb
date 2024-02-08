<?php
namespace Scandioop\Models;

class Book extends Product {
   protected $weight;

    public function setWeight($weight) {
        $this->$weight = $weight;
    }

    public function getWeight() {
        return $this->weight;
    }
}

?>
