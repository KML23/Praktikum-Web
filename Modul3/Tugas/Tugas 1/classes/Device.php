<?php

namespace DeviceSystem;

abstract class Device {
    protected $model;
    protected $processor;
    protected $ram;

    public function __construct($model, $processor, $ram) {
        $this->model = $model;
        $this->processor = $processor;
        $this->ram = $ram;
    }

    // Abstract method untuk implementasi di kelas turunan
    abstract public function getSpecs();
}
