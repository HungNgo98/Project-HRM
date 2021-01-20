<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class coursesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'course_category_id' => $this->course_category_id,
            'description' => $this->description,
            'current_order' => $this->current_order,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at
        ];
    }
}
