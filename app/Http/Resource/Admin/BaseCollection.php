<?php

namespace App\Http\Resource\Admin;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BaseCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'pagination' => [
                'page'        => $this->currentPage(),
                'per_page'    => $this->perPage(),
                'total_item'  => $this->total(),
                'total_pages' => $this->lastPage()
            ],
        ];
    }
}
