<?php

namespace App\Http\Controllers;

use App\Article;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Parsedown;

class ArticlesController extends Controller
{
    public function get_articles(){
        $articles = Article::all();
        $images = Image::all();
        return view('articles_list')->with('articles', $articles)->with('images', $images);
    }

    public function get_article($slug){
        $article = Article::where('article_slug', $slug)->first();
        
        $article_body = new Parsedown();
        $article_body = $article_body->text($article->article_body);
        $image = Image::where('article_id', $article->id)->first();
        return view('articles_view')->with('article', $article)->with('image', $image)->with('body', $article_body);
    }

    public function get_articles_create(){
        return view('articles_create');
    }

    public function post_articles_create(Request $request){
        // dd($request->file);
        $request->validate([
            'article_title' => 'required|max:50',
            'article_subject' => 'required',
            'article_body' => 'required',
            'file' => 'array|min:1'
        ]);
        
        if($request->file != null){
        for($i=0; $i < count($request->file); $i++){
            $request->file[$i]->validate([
                'file' => 'required|image'
            ]);
        }
    }

        $article = new Article;

        $article->article_title = $request->article_title;
        $article->article_subject = $request->article_subject;
        $article->article_slug = strtolower(preg_replace('/ /', '-', $request->article_title));
        $article->article_body = $request->article_body;
        $article->save();

        if($request->file){

        for($i=0; $i < count($request->file); $i++){
            $image = new Image;
            $path = str_replace('public', 'storage', $request->file[$i]->store('public/article_imgs'));
            $image->path = $path;
            $image->article_id = $article->id;
            $image->save();
        }
    }
        return redirect('/articles');
    }

    public function get_articles_edit($slug){
        $article = Article::where('article_slug', $slug)->first();
        $image = Image::where('article_id', $article->id)->first();
        return view('articles_edit')->with('article', $article)->with('image', $image);
    }

    public function post_articles_edit(Request $request){
        // $request->validate([
        //     'article_title' => 'required|max:50',
        //     'article_subject' => 'required',
        //     'article_body' => 'required'
        // ]);
        
        $article = Article::where('id', $request->article_id)->first();

        $article->update([
            'article_title' => $request->article_title,
            'article_subject' => $request->article_subject,
            'article_body' => $request->article_body,
        ]);

        if($request->article_image){
            $request->validate([
                'article_image' => 'image|max:1000'
            ]);
            
            $image_to_delete = Image::where('article_id', $request->article_id)->first();
            Storage::delete($image_to_delete->path);
            $image_to_delete->delete();
            $image = new Image;
            $path = str_replace('public', 'storage', $request->file('article_image')->store('public/article_imgs'));
            $image->path = $path;
            $image->article_id = $request->article_id;
            $image->save();
        }
        return redirect('/articles');
    }

    public function get_articles_delete($id){
        $image_to_delete = Image::where('article_id', $id)->first();
        Storage::delete($image_to_delete->path);
        $image_to_delete->delete();

        Article::where('id', $id)->first()->delete();

        return redirect('/articles');
    }
}