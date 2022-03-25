<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payement extends Model
{
    use HasFactory;

    protected $fillable = ['facture_id','montant_paye', 'reste', 'acompte'];

    /**
     * Get the facture associated with the Payement
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function facture(): BelongsTo
    {
        return $this->belongsTo(Facture::class, 'facture_id');
    }
}
