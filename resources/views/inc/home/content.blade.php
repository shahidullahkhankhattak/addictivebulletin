<div class="pusher">
    <div class="full height">
        <div class="toc">
            @include('inc.sidebar.left-main')
        </div>
        <div class="article desc" v-if="source" style="padding-top:100px;padding-top: 100px;box-shadow: 0px 0px 10px lightgrey;margin-bottom:-70px;display:none" v-show="source">
                <div class="loader slideDown" @click="$router.push('/'+lang)">
                    <h3 v-html="sources.filter(s => s.slug == source)[0].source"></h3>
                    <span v-if="lang == 'english'" v-html="'view all sources'"></span>
                    <span v-else v-html="'سب زرائے سے خبریں دکھا یں'"></span>
                </div>
        </div>
        <div class="article" v-if="directLoad" style="margin-bottom:30px; !important;display:none">
            <div class="ui link auto cards">
                @if(sizeof($news) == 0)
                <div class="no-news">{{__trans('No news found within selected filter.', $lang)}}</div>
                @endif
                @foreach($news as $article)
                <article class="card">
                    <div class="image">
                        <router-link
                            to="/{{$lang == "en" ? 'english' : 'urdu' }}/news/{{$article->id}}/{{$article->slug ? $article->slug : ''}}">
                            <img onload="fadeIn(this)" alt="{{$article->title}}"
                                src="/thumb.php?w=200&h=150&src={{$article->media}}" onerror="this.src = '/public/images/no_image.jpg'">
                        </router-link>
                    </div>
                    <div class="content">
                        <header class="header">
                            <a class="no-show" title="{{$article->title}}" href="/{{$lang == 'en' ? 'english' : 'urdu' }}/news/{{$article->id}}/{{$article->slug ? $article->slug : ''}}"></a>
                            <router-link
                                to="/{{$lang == "en" ? 'english' : 'urdu' }}/news/{{$article->id}}/{{$article->slug ? $article->slug : ''}}">
                                {{$article->title}}</router-link>
                        </header>
                        <div class="meta">
                            <a><time>{{$article->pub_date}}</time> - {{$article->source}}</a>
                        </div>
                        <p class="description">
                            {!! $article->description !!}
                        </p>
                    </div>
                    <div class="extra content">
                        <span @click="likeNews({{$article->id}})">
                            <i :class="isLiked({{$article->id}}) ? 'heart like icon' : 'heart like icon outline'" :style="{color: isLiked({{$article->id}}) ? 'red' : ''}"></i>
                            <span v-html="stories.filter(s => s.id == {{$article->id}})[0].likes"></span>
                        </span>

                    </div>
                </article>
                @endforeach
            </div>
        </div>
        <div class="article" v-if="stories && !directLoad" style="margin-bottom:30px; !important;display:none;" v-show="stories">
            <div class="ui link auto cards">
                <div class="no-news" v-if="lang == 'english' && stories.length == 0 && !loading">No news found within selected filter.</div>
                <div class="no-news" v-else-if="lang == 'urdu' && stories.length == 0 && !loading">منتخب فلٹر میں کوی خبر نہی ملی.</div>
                <article class="card" v-for="story in stories">
                    <div class="image">
                        <router-link
                            :to="'/'+lang+'/news/'+story.id+'/'+(story.slug ? story.slug : '')">
                            <img onload="fadeIn(this)"
                                :src="'/thumb.php?w=200&h=150&src=' + story.media" onerror="this.src = '/public/images/no_image.jpg'">
                        </router-link>
                    </div>
                    <div class="content">
                        <header class="header">
                            <router-link
                                :to="'/'+lang+'/news/'+story.id+'/'+(story.slug ? story.slug : '')">
                                @{{story.title}}</router-link>
                        </header>
                        <div class="meta">
                            <a><time>@{{story.pub_date}}</time> - @{{story.source}}</a>
                        </div>
                        <p class="description" v-html="story.description">
                        </p>
                    </div>
                    <div class="extra content">
                        <span @click="likeNews(story.id)">
                            <i :class="isLiked(story.id) ? 'heart like icon' : 'heart like icon outline'" :style="{color: isLiked(story.id) ? 'red' : ''}"></i>
                            <span>@{{story.likes}}</span>
                        </span>
                    </div>
                </article>
            </div>
        </div>
        <div class="article slideDown" v-if="loading" :style="{'padding': '20px', 'margin-top': '-60px', 'margin-bottom': '0px'}">
                <div class="loader">
                        <img src="https://loading.io/spinners/coolors/lg.palette-rotating-ring-loader.gif" alt="">
                </div>
        </div>
    </div>
</div>
@include('inc.home.news')
