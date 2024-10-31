<?php

namespace Controller;

class Controller
{
    // Declare properties to avoid dynamic creation
    protected $controllerName;
    protected $controllerMethod;

    // Method to retrieve all attributes
    public function getControllerAttribute()
    {
        return [
            "ControllerName" => $this->controllerName,
            "Method" => $this->controllerMethod,
        ];
    }
}
