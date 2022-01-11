<?php

namespace App\Http\Resources;

use App\Models\Image;
use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
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
            'status' => $this->status,
            'product_id' => $this->product_id,
            'type' => $this->type,
            'data' => $this->data,
            'videos' => VideoResource::collection($this->videos)->sortByDesc('lesson'),
            'last_video' => count(VideoResource::collection($this->videos))-1,
            'image' => config('app.presta_url') .'/'.$this->images->first()->id_image.'-'.Image::PRODUCT_800.'/'. \Str::slug($this->name) .'.jpg'
        );
    }
}
