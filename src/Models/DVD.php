<?php
namespace Scandioop\Models;

class DVD extends Product {
  protected $size;

    public function setSize($size) {
        $this->size = $size;
    }

    public function getSize() {
        return $this->size;
    }
  
}
?>
