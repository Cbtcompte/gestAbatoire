<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Facture extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'montant',
        'acompte',
        'reste',
        'client_id',
        'user_id',
        'id',
        'status'
    ];

    public $incrementing  = false;

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function client(){
        return $this->belongsTo(Client::class, 'client_id');
    }

    /**
     * Get all of the items for the Facture
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(Item::class, 'facture_id', 'id');
    }

    /**
     * Get all of the payements for the Facture
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payements(): HasMany
    {
        return $this->hasMany(Payement::class, 'facture_id');
    }
}
