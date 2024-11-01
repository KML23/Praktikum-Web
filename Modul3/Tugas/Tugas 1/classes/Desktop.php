<?php

namespace DeviceSystem;

require_once 'classes/Device.php';
require_once 'classes/DisplayTrait.php';

class Desktop extends Device {
    private $formFactor;

    use DisplayTrait;

    public function __construct($model, $processor, $ram, $gpu, $formFactor) {
        parent::__construct($model, $processor, $ram, $gpu);
        $this->formFactor = $formFactor;
    }

    public function getSpecs() {
        return "Desktop - Model: {$this->model}, Processor: {$this->processor}, RAM: {$this->ram} GB, GPU: {$this->gpu}, Form Factor: {$this->formFactor}";
    }

    // Magic method __toString untuk menampilkan objek sebagai string
    public function __toString() {
        return $this->getSpecs();
    }
}
