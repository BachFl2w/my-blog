<?php

namespace App\Http\Resources;

use App\Http\Resources\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Resources\Json\JsonResource;

class Post extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($this);
    }
}
