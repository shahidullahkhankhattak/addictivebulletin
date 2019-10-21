<div class="ui left vertical sidebar inverted menu main-sidebar overlay">
    <div class="logoSidebar">
        <img src="/public/images/addictive_bulletin_logo_new.png" alt="addictive bulletin logo">
    </div>
    
    
    <a class="no-show" title="Latest" href="/{{$lang == 'en' ? 'english' : 'urdu'}}/"></a>
    <a class="no-show" title="Trending" href="/{{$lang == 'en' ? 'english' : 'urdu'}}/trending"></a>
    
    <router-link class="item" :to="'/'+lang" title="Latest">
        <i class="globe icon"></i>
        {{__trans('Latest', $lang)}}
    </router-link>
    <router-link class="item" :to="'/'+lang+'/trending'" title="Trending">
        <i class="smile icon"></i>
        {{__trans('Trending', $lang)}}
    </router-link>
</div>
