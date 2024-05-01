<?php

namespace App\Http\Resources;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Date;

class ChurchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'document_number' => $this->document_number,
            'phone' => $this->phone,
            'address' => $this->address,
            'geolocation' => $this->geolocation,
            'foundation_date' => (new DateTime($this->foundation_date))->format('d-m-Y'),
            'members_count' => $this->members_count ?? 0,
            'pastor_president' => $this->president ?? '',
            // 'users' => UserResource::make($this->users()->get()),
        ];
    }
}
