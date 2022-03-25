<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SousArticle extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
        'prix',
        'article_id',
    ];

     public function article(){
        return $this->belongsTo(Article::class, 'article_id');
    }

    public function items(){
        return $this->hasMany(Item::class, 'sous_article_id');
    }
}
