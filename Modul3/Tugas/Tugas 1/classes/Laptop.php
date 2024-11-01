<?php

namespace DeviceSystem;

require_once 'classes/Device.php';
require_once 'classes/DisplayTrait.php';

class Laptop extends Device {
    private $batteryLife;

    use DisplayTrait;

    public function __construct($model, $processor, $ram, $gpu, $batteryLife) {
        parent::__construct($model, $processor, $ram, $gpu);
        $this->batteryLife = $batteryLife;
    }

    public function getSpecs() {
        return "Laptop - Model: {$this->model}, Processor: {$this->processor}, RAM: {$this->ram} GB, GPU: {$this->gpu}, Battery Life: {$this->batteryLife} hours";
    }

    // Magic method __toString untuk menampilkan objek sebagai string
    public function __toString() {
        return $this->getSpecs();
    }
}
