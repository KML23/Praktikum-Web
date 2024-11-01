<?php

namespace DeviceSystem;

trait DisplayTrait {
    public function displaySpecs() {
        echo "Model: {$this->model}, Processor: {$this->processor}, RAM: {$this->ram} GB, GPU: {$this->gpu}\n";
    }
}
