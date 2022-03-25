<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configsociete extends Model
{
    use HasFactory;
    protected $fillable = [
        'societe_id',
        'type_user',
        'type_article',
        'type_sousarticle'
    ];

    public function societe(){
        return $this->belongsTo(Societe::class, 'societe_id');
    }
}
