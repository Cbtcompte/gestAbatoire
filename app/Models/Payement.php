<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payement extends Model
{
    use HasFactory;

    protected $fillable = ['facture_id','montant_paye', 'reste', 'acompte'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d'
    ];

    /**
     * Get the facture associated with the Payement
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function facture(): BelongsTo
    {
        return $this->belongsTo(Facture::class, 'facture_id');
    }

    public function getCreatedAt(){
        return Carbon::parse($this->created_at)->locale('fr_FR')->isoFormat('LLLL');
    }
}
