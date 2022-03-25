<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Item;
use App\Models\SousArticle;
use Illuminate\Http\Request;

class ItemController extends Controller
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
        $data = $request->validate([
            'client_id' => 'required',
            'sous_article_id' => 'required',
            'qte' => 'required',
            'prix' => 'required',
            'montant' => 'required',
            'facture_id' => 'required',
        ]);


        $tmp = Item::create([
            'client_id' => $request->client_id,
            'sous_article_id' => $request->sous_article_id,
            'qte' => $request->qte,
            'prix' => $request->prix,
            'montant' => $request->montant,
            'facture_id' => $request->facture_id,
            'type' => 'attent'
        ]);

        $tmp = Item::findOrfail($tmp->id);

        $sous = SousArticle::find($request->sous_article_id);

        $article = Article::find($sous->article_id);

        return response()->json(['tmp' => $tmp, 'sous' => $sous, 'article' => $article]);
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
        $item = Item::withTrashed()->find($id);

       Item::where('id', $item->id)->forceDelete();

        return response()->json(['message' => 'Supression réussir', 'total' => $item->montant]);
    }

}
