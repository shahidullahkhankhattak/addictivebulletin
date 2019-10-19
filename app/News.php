<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
class News extends Model
{
    protected $table = "news";
    protected $fillable = ['title', 'slug', 'description', 'body', 'media', 'url', 'pub_date', 'tags', 'source_id', 'category_id', 'sub_category'];

    public static function getNews($request, $lang, $source = null, $category = null, $session_ids = null, $order = null, $search = null){
        $instance = new static;
        $ip = $request->ip();
        $instance = $instance->select(
                                ['news.*', 'source.source', 'source.slug as source_slug', 'source.website', 'source.lang',
                                 'source.color', 'source.default', 'category.slug as category_slug', 'category.category'
                                ]
                            )
                    ->selectRaw('(SELECT COUNT(*) FROM likes WHERE news_id=news.id) AS likes,
                                 (SELECT EXISTS(SELECT * from likes WHERE ip = ? AND news_id=news.id)) AS liked',
                                 [$ip])
                    ->join('source', 'source.id', 'news.source_id')
                    ->join('category', 'category.id', 'news.category_id');
                    if(!empty($source))
                        $instance->where('source.slug', $source);
                    if(!empty($category))
                        $instance->where('category.slug', $category);
                    if(!empty($session_ids)){
                        $instance->whereIn('source.id', $session_ids);
                    }
                    if(!empty($search)){
                        $instance->where(function($q) use ($search){
                            $q->where('news.title', 'like', '%'.$search.'%')
                              ->orWhere('news.description', 'like', '%'.$search.'%');
                        });
                    }
                    if(!empty($order)){
                        if($order === "t"){
                            $instance->orderBy('likes', 'DESC');
                        }else{
                            $instance->orderBy('news.id', 'DESC');
                        }
                    }
                    $instance->where('lang', $lang);
        return $instance;
    }

    public static function getRelatedNews($request, $lang, $source = null, $category = null){
        $instance = new static;
        $ip = $request->ip();
        $instance = $instance->select(
                                ['news.id', 'news.slug', 'news.title', 'source.source', 'source.slug as source_slug', 'source.website', 'source.lang',
                                 'source.color', 'source.default', 'category.slug as category_slug', 'category.category'
                                ]
                            )
                    ->selectRaw('(SELECT COUNT(*) FROM likes WHERE news_id=news.id) AS likes,
                                 (SELECT EXISTS(SELECT * from likes WHERE ip = ? AND news_id=news.id)) AS liked',
                                 [$ip])
                    ->join('source', 'source.id', 'news.source_id')
                    ->join('category', 'category.id', 'news.category_id');
                    if(!empty($source))
                        $instance->where('source.slug', $source);
                    if(!empty($category))
                        $instance->where('category.slug', $category);
                    $instance->where('lang', $lang);
        return $instance;
    }

    public static function getStory($newsid){
        $instance = new static;
        $instance = $instance->select(
                                ['news.*', 'source.source', 'source.slug as source_slug', 'source.website', 'source.lang',
                                 'source.color', 'source.default', 'category.slug as category_slug', 'category.category'
                                ]
                            )
                    // ->join('author', 'author.news_id', 'news.id')
                    ->join('source', 'source.id', 'news.source_id')
                    ->join('category', 'category.id', 'news.category_id')
                    ->where('news.id', $newsid);
        return $instance;
    }
    
    public static function getQueries($builder)
    {
        $addSlashes = str_replace('?', "'?'", $builder->toSql());
        return vsprintf(str_replace('?', '%s', $addSlashes), $builder->getBindings());
    }
}
