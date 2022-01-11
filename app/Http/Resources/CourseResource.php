<?php

namespace App\Http\Resources;

use App\Models\Image;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            'product_id' => $this->product_id,
            'type' => $this->type,
            'data' => $this->data,
            'features' => !empty($this->product->features) ? FeatureResource::collection($this->product->features) : null,
            'videos' => VideoResource::collection($this->videos)->sortByDesc('lesson'),
            'last_video' => count(VideoResource::collection($this->videos))-1,
            'image' => (isset($this->images->first()->id_image)) ? config('app.presta_url') .'/'.$this->images->first()->id_image.'-'. Image::PRODUCT_800 .'/'. \Str::slug($this->name) .'.jpg' : null,
            'categories' => (isset($this->product->categories)) ? CategoriesResource::collection($this->product->categories)->where('name', '!=', 'Strona główna') : null,
        );
    }
}
