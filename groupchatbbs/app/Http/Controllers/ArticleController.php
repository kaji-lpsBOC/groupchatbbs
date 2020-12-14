<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        if($request->filled('keyword')){ //キーワードがあるなら
            $keyword = $request->input('keyword');
            $message = '検索結果: '.$keyword;
            $articles = Article::where('content','like','%' .$keyword. '%')->get();
        }else{
            $message = 'グループ募集掲示板へようこそ！！';
            $articles = Article::all(); //allでもいい
        }
        return view('index',['message' => $message,'articles' => $articles]); //単純に連想配列の形で渡す
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       $message = 'New article';
       return view('new',['message' => $message]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $article = new Article();

       $article->content = $request->content;
       $article->user_name = $request->user_name;
       $article->save();
       return redirect()->route('article.show', ['id' => $article->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id, Article $article)
    {
        $message = 'This is your article '.$id;
        $article = Article::find($id);
        return view('show',['message' => $message, 'article' =>$article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id, Article $article)
    {
        $message = 'Edit your article '.$id;
        $article = Article::find($id);
        return view('edit',['message' => $message, 'article' =>$article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id, Article $article)
    {
        $article = Article::find($id);

       $article->content = $request->content;
       $article->user_name = $request->user_name;
       $article->save();
       return redirect()->route('article.show', ['id' => $article->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id, Article $article)
    {
        $article = Article::find($id);
        $article->delete();
        return redirect('/articles');
    }
}
