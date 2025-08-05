<?php

namespace App\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserPaginateResource extends ResourceCollection
{
    protected array $paginate;
    public function __construct($resource, $paginate)
    
    {
        parent::__construct($resource);
        $this->paginate = $paginate;
    }

    public function toArray(Request $request)
    {
        $data = $this->collection->map(function($visit){

            return [
                'id' => $visit->id,
                'name' => $visit->name,
                'email' => $visit->email,
                'photo' => $visit->photo ?? null,
                'role' => $visit->role ?? null,
            ];
        })->all();

        return [
            'data' => $data,
            'paginate' => $this->paginate,
        ];
    }
}
