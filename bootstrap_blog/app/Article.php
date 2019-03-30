<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Parsedown;

class Article extends Model
{
    protected $fillable = ['article_title', 'article_slug', 'article_subject', 'article_body'];

    public function snippet($text){
        $parsedown = new Parsedown();
        $text = $parsedown->text($text);
        $text = strip_tags($text);
        if(strlen($text) > 500){
            return substr($text, 0, 500) .'...';
        }
        else{
            return $text;
        }
    }
}
