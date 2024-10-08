<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'societe_id',
    ];

    public function societe(){
        return $this->belongsTo(Societe::class, 'societe_id');
    }
}
