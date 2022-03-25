<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Societe extends Model
{
    use HasFactory;

    protected $fillable = [
        'raisonSocial',
        'ifu',
        'adresse',
        'telephone',
        'description',
        'email',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'societe_id');
    }

    public function app(){
        return $this->hasOne(App::class, 'societe_id');
    }

     public function configsociete(){
        return $this->hasOne(Configsociete::class, 'societe_id');
    }

    public function articles(){
        return $this->hasMany(Article::class, 'societe_id');
    }
}
