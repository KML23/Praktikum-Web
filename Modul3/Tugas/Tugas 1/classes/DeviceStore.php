<?php

namespace DeviceSystem;

require_once 'classes/Laptop.php';
require_once 'classes/Desktop.php';

class DeviceStore {
    private $devices = [];

    public function addDevice(Device $device) {
        $this->devices[] = $device;
    }

    public function showAllDevices() {
        foreach ($this->devices as $device) {
            echo $device . "\n";
        }
    }
}
