<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
        'societe_id',
    ];

    public function sousArticles(){
        return $this->hasMany(SousArticle::class, 'article_id');
    }

    public function societe(){
        return $this->belongsTo(Societe::class, 'societe_id');
    }

}
