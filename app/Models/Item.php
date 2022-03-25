<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'sous_article_id',
        'facture_id',
        'client_id',
        'prix',
        'qte',
        'montant',
        'type'
    ];

    /**
     * Get the facture that owns the Item
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function facture()
    {
        return $this->belongsTo(Facture::class, 'facture_id', 'id');
    }

    public function sousArticle(){
        return $this->belongsTo(sousArticle::class, 'sous_article_id');
    }
}
