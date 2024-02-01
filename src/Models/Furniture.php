<?php
namespace Scandioop\Models;

class Furniture extends Product {
   protected $height;
   protected $width;
   protected $length;

    public function setHeight($height) {
        $this->height = $height;
    }

    public function getHeight() {
        return $this->height;
    }

    public function setWidth($width) {
        $this->width = $width;
    }

    public function getWidth() {
        return $this->width;
    }
    public function setLength($length) {
        $this->length = $length;
    }

    public function getLength() {
        return $this->length;
    }

}
?>
