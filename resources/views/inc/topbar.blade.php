<div class="ui sidebar inverted blue top fixed menu overlay centered search-topbar">
    <div class="search-topbar-inner">
        <form v-on:submit.prevent="search()">
            <div class="ui icon input" >
                <input type="text" v-model="searchkeywords" :placeholder="lang == 'english' ? 'Search News ..' : 'خبریں تلاش کریں'">
                <i class="inverted circular search link icon" @click="search()"></i>
                <i class="inverted circular search close link icon icon-close-search search-toggle" @click="searchkeywords = ''; search()"></i>
            </div>
        </form>
    </div>
</div>
<div class="ui fixed inverted main menu" style="margin-top:-1px;">
        <a class="launch-left icon item">
            <i class="content icon"></i>
        </a>
        <div class="ui inverted red left menu" style="width: 175px;left:0;right:0;margin:auto;">
            <a class="ui inverted red lang item" href="/urdu">
                <i class="language icon"></i>
                اردو
            </a>
            <a class="ui inverted red lang item" href="/english" style="font-family: 'sans-serif' !important;">
                <i class="language icon"></i>
                English
            </a>
        </div>

        <div class="right menu" style="width:94px;margin-left:10px !important;">
            <a class="icon item search-toggle">
                <i class="search icon"></i>
            </a>
            <a class="launch-right icon item">
                <i class="settings icon"></i>
            </a>
        </div>
</div>
<nav class="ui fixed inverted blue main menu categories" style="@if($lang == 'ur') margin-top:42px; @else margin-top:40px; @endif overflow-x:auto;">
    <a class="no-show" title="Latest" href="/{{$lang == 'en' ? 'english' : 'urdu'}}/"></a>
    <a class="no-show" title="World" href="/{{$lang == 'en' ? 'english' : 'urdu'}}/category/world"></a>
    <a class="no-show" title="National" href="/{{$lang == 'en' ? 'english' : 'urdu'}}/category/national"></a>
    <a class="no-show" title="Sports" href="/{{$lang == 'en' ? 'english' : 'urdu'}}/category/sports"></a>
    <a class="no-show" title="Technology" href="/{{$lang == 'en' ? 'english' : 'urdu'}}/category/technology"></a>
    <a class="no-show" title="Business" href="/{{$lang == 'en' ? 'english' : 'urdu'}}/category/business"></a>
    <a class="no-show" title="Health" href="/{{$lang == 'en' ? 'english' : 'urdu'}}/category/health"></a>
    <a class="no-show" title="Others" href="/{{$lang == 'en' ? 'english' : 'urdu'}}/category/others"></a>

    <router-link class="item" :to="'/'+lang" :class="{active: (!category && !source)}" title="World">
        <i class="globe icon"></i>
        {{__trans('Latest', $lang)}}
    </router-link>
    <router-link class="item" :to="'/'+lang+(source ? '/source/' + source : '')+'/category/world'" :class="{active: category === 'world'}" title="World">
        <i class="globe icon"></i>
        {{__trans('World', $lang)}}
    </router-link>
    <router-link class="item" :to="'/'+lang+(source ? '/source/' + source : '')+'/category/national'" :class="{active: category === 'national'}" title="National">
        <i class="flag icon"></i>
        {{__trans('National', $lang)}}
    </router-link>
    <router-link class="item" :to="'/'+lang+(source ? '/source/' + source : '')+'/category/sports'" :class="{active: category === 'sports'}" title="Sports">
        <i class="baseball ball icon"></i>
        {{__trans('Sports', $lang)}}
    </router-link>
    <router-link class="item" :to="'/'+lang+(source ? '/source/' + source : '')+'/category/technology'"  :class="{active: category === 'technology'}"title="Technology">
        <i class="desktop icon"></i>
        {{__trans('Technology', $lang)}}
    </router-link>
    <router-link class="item" :to="'/'+lang+(source ? '/source/' + source : '')+'/category/business'" :class="{active: category === 'business'}" title="Business">
        <i class="building icon"></i>
        {{__trans('Business', $lang)}}
    </router-link>
    <router-link class="item" :to="'/'+lang+(source ? '/source/' + source : '')+'/category/health'" :class="{active: category === 'health'}" title="Health">
        <i class="stethoscope icon"></i>
        {{__trans('Health', $lang)}}
    </router-link>
    <router-link class="item" :to="'/'+lang+(source ? '/source/' + source : '')+'/category/others'" :class="{active: category === 'others'}" title="Others">
        <i class="asterisk icon"></i>
        {{__trans('Others', $lang)}}
    </router-link>
</nav>

