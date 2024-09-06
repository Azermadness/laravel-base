<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class HomeCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $totalSurface = $this->collection->sum('surface');
        return [
            'data' => $this->collection->transform(function ($home) {
                return [
                    'id' => $home->id,
                    'type' => $home->type,
                    'surface' => $home->surface,
                    'town' => $home->town,
                    'owner_id'=> $home->owner_id
                ];
            }),
            'meta' => [
                //on renvoie une métadonnée récupérable en front
                'total' => $this->collection->count(),
                'total_surface' => $totalSurface,
            ],
        ];
    }
}
