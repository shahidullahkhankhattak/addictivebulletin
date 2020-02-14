<div class="news-article @if(!$story) transition hidden @else transition visible @endif" >
    <div class="full height" v-if="story" style="display:none;" v-show="story">
        <div class="toc">
            <div class="news-sidebar" :style="{background: story ? story.color : 'teal'}">
                <div class="source-title" v-html="story.source">
                    {{$story ? $story->source : ''}}
                </div>
                @if($story)
                <a class="original-news" v-if="!story" target="_blank" href="{{$story->url}}">
                    @if($lang == "en") View News On @endif {{$story->source}} @if($lang == "ur") "پہ دکھایں" @endif</a>
                @endif
                <a class="original-news" v-if="story" target="_blank" :href="story.url">@{{lang == 'english' ? 'View News On' : ''}} @{{story ? story.source : ''}} @{{lang == 'urdu' ? 'پہ دکھایں' : ''}}</a>
            </div>
            @if($story)
            <div class="ui left vertical inverted menu left-menu" v-if="!story.related">
                @foreach($story->related as $related)
                <router-link class="item" to="/{{$lang == "en" ? 'english' : 'urdu' }}/news/{{$related->id}}/{{$related->slug}}" title="{{$related->title}}">
                    <span class="source">{{$related->source}}</span>
                    <header class="sidebar-heading">{{$related->title}}</header>
                </router-link>
                @endforeach
            </div>
            @endif
            <div class="ui left vertical inverted menu left-menu">
                    <router-link class="item" v-for="related in story.related" :to="'/'+lang+'/news/'+related.id+'/'+(related.slug ? related.slug : '' )" :title="related.title">
                        <span class="source">@{{related.source}}</span>
                        <header class="sidebar-heading">@{{related.title}}</header>
                    </router-link>
            </div>
        </div>
        <article class="article">
            <div class="top_bar_wrapper">
                <div class="top_bar">
                    <a class="icon btn_close" @click="closeNews()"><i class="close icon"></i></a>
                    <ul class="actions">
                        <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                            <a class="a2a_button_facebook"></a>
                            <a class="a2a_button_twitter"></a>
                            <a class="a2a_button_pinterest"></a>
                            <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                        </div>
                    </ul>
                </div>
            </div>
            <div class="story_wrapper">

                <div class="story_media">
                    <img style="display:none;" @if($story) src="{{$story ? $story->media : ''}}" alt="{{$story->title}}" @endif :src="story.media" onload="fadeIn(this)">
                </div>
                <header>
                    <h1 class="story_title" v-html="story.title">{{$story ? $story->title : ''}}</h1>
                </header>

                <div class="story_meta">
                    <span class="authors" v-html="story.author">{{$story ? $story->author : ''}}</span>
                    <time class="pub_date" v-html="story.pub_date">{!! $story ? $story->pub_date : '' !!}</time>
                </div>

                <div class="story_content">
                    <div class="normal" v-html="story.body == '' ? story.description : story.body">
                        {{$story ? $story->body : ''}}
                    </div>
                </div>
            </div>
        </article>
    </div>
</div>
