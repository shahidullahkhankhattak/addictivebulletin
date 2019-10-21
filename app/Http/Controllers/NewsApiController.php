<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Source;
use App\Category;
use App\News;
use Session;
use App\Likes;
session_start();
class NewsApiController extends Controller
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
        $offset = ((int)$request->get('page') - 1) * 24;
        $search = null;
        if($request->get('search')){
            $search = $request->get('search');
        }
        $language = $lang == "english" ? 'en' : 'ur';
        $source_ids =  isset($_SESSION['selected_sources_'.$lang]) ? $_SESSION['selected_sources_'.$lang] : null;
        if($request->get('sources')){
            $source_ids = json_decode($request->get('sources'));
        }
        if(!empty($source)){
            $source_ids = null;
        }
        $news = News::getNews($request, $lang, $source, $category, $source_ids, $order, $search)->offset($offset)->limit(24)->get();
        foreach($news as $story){
            if($language == "english"){
                $story['pub_date'] = human_date($story['pub_date']);
            }else{
                $story['pub_date'] =  transDate(human_date($story['pub_date']), $language);
            }
        }

        return array('data' => $news);
    }

    public function getStory(Request $request, $lang, $newsid){
        $story = News::getStory($newsid)->first();
        $recommended = News::getRelatedNews($request, $lang, null, $story->category_slug)->orderByRaw("RAND()")->limit(10)->get();
        $story->related = $recommended;
        if($lang == "english"){
            $story->pub_date = format_story_date($story->pub_date);
        }else{
            $story->pub_date = format_date_urdu($story->pub_date);
        }

        if(empty($story)){
            abort(404, "News not found");
        }
        return $story;
    }

    public function setSources(Request $request, $lang){
        $_SESSION['selected_sources_'.$lang] = $request->get('ids');
        return "updated";
    }

    public function likeNews(Request $request, $id){
        $exists = Likes::where(['ip' => $request->ip(), 'news_id' => $id])->first();
        if($exists){
            $exists->delete();
            return "deleted";
        }else{
            Likes::create([
                'news_id' => $id,
                'ip' => $request->ip()
            ]);
            return "liked";
        }
        return "done";
    }
}
