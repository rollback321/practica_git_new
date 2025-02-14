<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResourceUsuarios extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

     /** Permite generar un estandar y/o orden  para devoluciones de datos */
    public function toArray($request): array
    {
        return [
            'id' => $this->us_id,
            'name' => $this->us_nombres,
            'usuario' => $this->us_nom_usuario,
            'password' => $this->us_password,
            'paterno' => $this->us_paterno,
            'materno' => $this->us_materno,
            'dateCreate' => $this->created_at,
            'state' => $this->us_estado 
        ];
    }
}
