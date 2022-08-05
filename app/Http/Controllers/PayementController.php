<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\Payement;
use Illuminate\Http\Request;

class PayementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $facture = Facture::where('id', $request->facture_id)->first();

        $acompte = $facture->payements->sum('montant_paye')+$request->acompte;

        $payement = Payement::create([
            'facture_id' => $facture->id,
            'montant_paye' => $request->acompte,
            'acompte' => $acompte,
            'reste' => ($facture->montant > $acompte) ? $facture->montant-$acompte : 0,
        ]);

        return response()->json([
            'paiement' => $payement
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Payement $payement)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function dataPayement(Facture $facture)
    {
        return response()->json([
            'paiement' => $facture->payements->last(),
        ]);
    }

    public function detailPayement(Facture $facture){
        return response()->json([
            'client' => $facture->client,
            'paiement' => $facture->payements,
            'status' => ($facture->payements->last()->reste == 0) ? "SOLDE" : "NON SOLDE"
        ]);
    }
}
