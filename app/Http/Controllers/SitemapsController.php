<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\News;
class SitemapsController extends Controller
{
    public function genSitemap(Request $request, $lang){
        $news = News::select('news.*', 'source.lang')
                    ->join('source', 'source.id', '=', 'news.source_id')
                    ->orderBy('news.id', 'DESC')
                    ->limit(30000)->get();
        return (new Response(view('sitemap', ['news' => $news]), 200))
              ->header('Content-Type', "application/xml; charset=utf-8");
    }
}
