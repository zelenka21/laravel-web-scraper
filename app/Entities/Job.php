<?php

namespace App\Entities;

use JsonSerializable;

class Job implements JsonSerializable
{
    public const STATUS_WAITING = "waiting";
    public const STATUS_COMPLETED = "completed";
    public const STATUS_FAILED = "failed";


    private string $id;
    private string $status;
    private string $data;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->id     = $data['id'];
        $this->status = $data['status'];
        $this->data   = $data['data'];
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'id'     => $this->id,
            'status' => $this->status,
            'data'   => $this->data,
        ];
    }
}
