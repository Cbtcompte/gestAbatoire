<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\SousArticle;
use Illuminate\Http\Request;

class ArticleController extends Controller
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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $app = auth()->user()->societe->app;

        $data = $request->validate([
            'libelle' => 'required|string'
        ]);

        $article = Article::create(['libelle' => $request->libelle, 'societe_id' => auth()->user()->societe->id]);

        return response()->json([
            'zone' => view('partials.pages.tab2', compact('app'))->render()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(SousArticle $sous, Request $request)
    {
       // dd($sous);
        if($request->ajax()){
            if($sous->prix == null){
                return response()->json([
                    'prix' => 0
             ]);
            }else{
                return response()->json([
                    'prix' => $sous->prix
             ]);
            }

        }else{
            return 0;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_2(Article $article, Request $request)
    {
        if($request->ajax()){
            if($request->type == '2'){
                return response()->json([
                    'zone' => view('partials.pages.tab1', compact('article'))->render(),
                    'sarticle' => $article->societe->configsociete->type_sousarticle]
                );
            }else{
                return response()->json([
                    'article' => $article->sousArticles
             ]);
            }

        }else{
            return 0;
        }
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
    public function update(Request $request, Article $article)
    {
        $data = $request->validate([
            'libelle' => 'required|string'
        ]);

        $article->update(['libelle' => $request->libelle]);

        return response()->json([
            'article' => $article
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return response()->json(['message' => 'Article supprimé']);
    }
}
