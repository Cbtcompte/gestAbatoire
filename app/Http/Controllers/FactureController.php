<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\Item;
use App\Models\Client;
use App\Models\Article;
use App\Models\Facture;
use App\Models\Payement;
use App\Models\SousArticle;
use Illuminate\Http\Request;

class FactureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($retour = null)
    {
        if($retour !=null){
            $retour = true;
        }else{
            $retour = false;
        }

        $factures = Facture::where('user_id', auth()->user()->id)->get();

        return view('factures.index', compact('factures', 'retour'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($retour = null)
    {
        do{
            $id = 'F'.rand(0001,9999);

            $item = Item::where('facture_id', $id)->get()->first();

        }while($item!=null);

        $clients = Client::all();
        $articles = Article::all();
        $sousarticles = SousArticle::all();
        $app = App::get()->first();
        return view('factures.create', compact('app', 'articles', 'clients', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function etablir($id, Request $request){
        $item = Item::where('facture_id', $id)->get();

        $montant = 0;
        foreach ($item as $value) {
            $montant = $montant + $value->montant;
            $data = $value->update(['type' => 'valide']);
        }

        Item::where('type', 'attent')->forceDelete();

        $facture = Facture::create([
            'id' => $id,
            'montant' => $montant,
            'status' => 'Enregistrée',
            'user_id' => auth()->user()->id,
            'client_id' => $item->first()->client_id
        ]);

        Payement::create([
            'facture_id' => $facture->id,
            'montant_paye' => $request->acompte,
            'acompte' => $request->acompte,
            'reste' => $montant-$request->acompte,
        ]);

        do{
            $id = 'F'.rand(0001,9999);

            $item = Item::where('facture_id', $id)->get()->first();

        }while($item!=null);

        return response()->json(['id' => $id]);
    }
}
