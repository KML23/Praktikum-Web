<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class gamelistsResource extends JsonResource
{
    // Define properti
    public $status;
    public $message;
    public $resource;

    /**
     * Constructor
     *
     * @param bool $status
     * @param string $message
     * @param mixed $resource
     */
    public function __construct(bool $status, string $message, $resource)
    {
        parent::__construct($resource);
        $this->status = $status;
        $this->message = $message;
    }

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'success' => $this->status,
            'message' => $this->message,
            'data' => $this->resource,
        ];
    }
}
