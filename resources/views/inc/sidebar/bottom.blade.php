<nav class="ui bottom sidebar overlay inverted menu visible">
    <a class="no-show" title="World" href="/{{$lang == 'en' ? 'english' : 'urdu'}}/category/world"></a>
    <a class="no-show" title="National" href="/{{$lang == 'en' ? 'english' : 'urdu'}}/category/national"></a>
    <a class="no-show" title="Sports" href="/{{$lang == 'en' ? 'english' : 'urdu'}}/category/sports"></a>
    <a class="no-show" title="Technology" href="/{{$lang == 'en' ? 'english' : 'urdu'}}/category/technology"></a>
    <a class="no-show" title="Business" href="/{{$lang == 'en' ? 'english' : 'urdu'}}/category/business"></a>
    <a class="no-show" title="Health" href="/{{$lang == 'en' ? 'english' : 'urdu'}}/category/health"></a>
    <a class="no-show" title="Others" href="/{{$lang == 'en' ? 'english' : 'urdu'}}/category/others"></a>
    
    <router-link class="item" :to="'/'+lang+(source ? '/source/' + source : '')+'/category/world'" title="World">
        <i class="globe icon"></i>
        {{__trans('World', $lang)}}
    </router-link>
    <router-link class="item" :to="'/'+lang+(source ? '/source/' + source : '')+'/category/national'" title="National">
        <i class="flag icon"></i>
        {{__trans('National', $lang)}}
    </router-link>
    <router-link class="item" :to="'/'+lang+(source ? '/source/' + source : '')+'/category/sports'" title="Sports">
        <i class="baseball ball icon"></i>
        {{__trans('Sports', $lang)}}
    </router-link>
    <router-link class="item" :to="'/'+lang+(source ? '/source/' + source : '')+'/category/technology'" title="Technology">
        <i class="desktop icon"></i>
        {{__trans('Technology', $lang)}}
    </router-link>
    <router-link class="item" :to="'/'+lang+(source ? '/source/' + source : '')+'/category/business'" title="Business">
        <i class="building icon"></i>
        {{__trans('Business', $lang)}}
    </router-link>
    <router-link class="item" :to="'/'+lang+(source ? '/source/' + source : '')+'/category/health'" title="Health">
        <i class="stethoscope icon"></i>
        {{__trans('Health', $lang)}}
    </router-link>
    <router-link class="item" :to="'/'+lang+(source ? '/source/' + source : '')+'/category/others'" title="Others">
        <i class="asterisk icon"></i>
        {{__trans('Others', $lang)}}
    </router-link>
</nav>
