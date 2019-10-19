<div class="logoSidebar">
        <img src="/images/addictive_bulletin_logo_new.png" alt="addictive bulletin logo">
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
</div>
