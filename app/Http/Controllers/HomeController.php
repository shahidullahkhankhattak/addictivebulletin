<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Source;
use App\Category;
use App\News;
use Session;
session_start();
class HomeController extends Controller
{
    public function home(Request $request, $lang){
        $source = $request->route('source');
        $category = $request->route('category');
        $page = $request->route()->getName();
        $order = null;
        if($page == "trending"){
            $order = "t"; // order t for trending
        }else{
            $order = "l"; // order l for latest
        }
        $search = null;
        if($request->get('search')){
            $search = $request->get('search');
        }
        $language = $lang == "english" ? 'en' : 'ur';
        $sources = Source::where('lang', $lang)->get();
        if(!isset($_SESSION['selected_sources_'.$lang])){
            $_SESSION['selected_sources_'.$lang] = array_map(function($a){
                return $a->id;
            }, get_object_vars($sources));
        }
        $categories = Category::all();
        $source_ids =  isset($_SESSION['selected_sources_'.$lang]) ? $_SESSION['selected_sources_'.$lang] : null;
        $news = News::getNews($request, $lang, $source, $category, $source_ids, $order, $search)->offset(0)->limit(20)->get();
        foreach($news as $story){
            if($language == "english"){
                $story['pub_date'] = human_date($story['pub_date']);
            }else{
                $story['pub_date'] =  transDate(human_date($story['pub_date']), $language);
            }
        }
        $title = 'Your only source of extensive collection of news.';
        if($source){
            $title = titlify($source);
            if($category)
                $title .= " - ".titlify($category);
        }else if($category)
            $title = titlify($category);
        else if($page == "trending")
            $title = " Trending news on top";

        return view('home', ['lang' => $language, 'sources' => $sources, 'categories' => $categories, 'news' => $news, 'page' => $page, 'title' => $title, 'story'=> null]);
    }

    public function showNews(Request $request, $lang, $newsid, $slug = null){
        $language = $lang == "english" ? 'en' : 'ur';
        $sources = Source::where('lang', $lang)->get();
        $categories = Category::all();
        $allnews = News::getNews($request, $lang, null, null, null, 'l')->offset(0)->limit(20)->get();
        foreach($allnews as $story){
            if($lang == "english"){
                $story['pub_date'] = human_date($story['pub_date']);
            }else{
                $story['pub_date'] =  transDate(human_date($story['pub_date']), $language);
            }
        }
        $story = News::getStory($newsid)->first();
        $recommended = News::getRelatedNews($request, $lang, null, $story->category_slug)->orderByRaw("RAND()")->take(10)->get();
        $story->related = $recommended;
        $page = \Request::route()->getName();
        $title = $story->title;
        if($lang == "english"){
            $story->pub_date = format_story_date($story->pub_date);
        }else{
            $story->pub_date = format_date_urdu($story->pub_date);
        }
        return view('home', ['lang' => $language, 'sources' => $sources, 'categories' => $categories, 'news' => $allnews, 'page' => $page, 'title' => $title, 'story' => $story]);
    }
}
