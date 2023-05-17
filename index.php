<?php

class Computer {
    public $brand;
    public $model;
    public $image;

    public function __construct($brand, $model, $image) {
        $this->brand = $brand;
        $this->model = $model;
        $this->image = $image;
    }

    public function getProductType() {
        return "Computer";
    }
}


class Desktop extends Computer {
    public $GPU;

    public function __construct($brand, $model, $GPU, $image) {
        parent::__construct($brand, $model, $image);
        $this->GPU = $GPU;
    }
    
    

    public function getProductType() {
        return "Desktop";
    }

}

class Laptop extends Computer {
    public function __construct($brand, $model, $image) {
        parent::__construct($brand, $model, $image);
    }

    public function getProductType() {
        return "Laptop";
    }
}





