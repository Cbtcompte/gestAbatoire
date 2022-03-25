<?php

namespace App\Http\Controllers;

use NumberFormatter;
use App\Models\Facture;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class PdfController extends Controller
{
    public function generate(Facture $facture)
    {
        $temp = $facture->items;
        $payement = $facture->payements->last();
        $f = new NumberFormatter("fr", NumberFormatter::SPELLOUT);
        $lettre_chiffre = $f->format($facture->montant);
        return PDF::loadView('pdf.facture', compact('facture','payement', 'temp', 'lettre_chiffre'))
                            ->setPaper('a5', 'portrait')
                            ->setWarnings(false)
                            ->stream();
    }
}
