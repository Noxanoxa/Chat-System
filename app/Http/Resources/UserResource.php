<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UserResource extends JsonResource
{

    public static $wrap = false;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
          'id' => $this->id,
          'avatar_url' => $this->avatar_url ? Storage::url($this->avatar_url) : null,
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at . ' UTC',
            'updated_at' => $this->updated_at . ' UTC',
            'is_admin' => (bool) $this->is_admin,
            'last_message' => $this->last_message,
            'last_message_date' => $this->last_message_date . ' UTC',
        ];
    }
}
