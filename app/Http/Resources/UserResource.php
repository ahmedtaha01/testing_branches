<?php

namespace App\Http\Resources;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        // $routeDontShowPost = $request->routeIs('api/register');
        return [
            // 'id'            => $this->id,
            'name'          => $this->name,
            'email'         => $this->email,
            // $this->mergeWhen($routeDontShowPost, [
            //     'posts'         => PostResource::collection(Post::where('user_id',$this->id)->get())
            // ]),
            'token'         => $this->token,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
        ];
    }
}
