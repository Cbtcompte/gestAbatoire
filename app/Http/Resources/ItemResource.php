<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'sous_article' => $this->sousArticle->article->libelle.'('.$this->sousArticle->libelle.')',
            'qte' => $this->qte,
            'prix' => $this->prix,
            'montant' => $this->montant
        ];
    }
}
