<div class="logoSidebar">
        <img src="/public/images/addictive_bulletin_logo_new.png" alt="addictive bulletin logo">
</div>

<a class="no-show" title="Latest" href="/{{$lang == 'en' ? 'english' : 'urdu'}}/"></a>
<a class="no-show" title="Trending" href="/{{$lang == 'en' ? 'english' : 'urdu'}}/trending"></a>

<div class="ui left vertical inverted menu left-menu">
    <router-link class="item" :to="'/'+lang">
        <i class="newspaper outline icon"></i>
        {{__trans('Latest', $lang)}}
    </router-link>
    <router-link class="item" :to="'/'+lang+'/trending'">
        <i class="chart line icon"></i>
        {{__trans('Trending', $lang)}}
    </router-link>
    <br><br>
    <div class="item" style="width:100%;padding:0;margin-left:5px;max-width:100%;">
        <div class="fb-page" data-href="https://www.facebook.com/addictivebulletin" data-tabs="" data-width="250" data-height="300" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/addictivebulletin" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/addictivebulletin">Addictive Bulletin</a></blockquote></div>
    </div>
    </div>
