<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return array(
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'status' => $this->status,
            'vimeo_id' => $this->vimeo_id,
            'lesson' => $this->whenPivotLoaded('course_videos', function () {
                return $this->pivot->lesson;
            }),
            'chapter' => $this->whenPivotLoaded('course_videos', function () {
                return $this->pivot->chapter;
            }),
        );
    }
}
