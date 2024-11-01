<?php

namespace DeviceSystem;

abstract class Device {
    protected $model;
    protected $processor;
    protected $ram;
    protected $gpu; 

    public function __construct($model, $processor, $ram, $gpu) {
        $this->model = $model;
        $this->processor = $processor;
        $this->ram = $ram;
        $this->gpu = $gpu;
    }

    // Abstract method untuk implementasi di kelas turunan
    abstract public function getSpecs();
}
