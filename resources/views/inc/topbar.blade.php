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
<div class="ui fixed inverted main menu">
    <div class="top-bar">
        <a class="item" href="/urdu">
            <i class="language icon"></i>
            اردو
        </a>
        <a class="item" href="/english" style="font-family: 'sans-serif' !important;">
            <i class="language icon"></i>
            English
        </a>
    </div>
</div>

<div class="ui fixed inverted main menu" style="margin-top:40px;@php if($lang == 'ur') { @endphp padding-bottom:10px; @php } @endphp">
        <a class="launch-left icon item">
            <i class="content icon"></i>
        </a>

        <div class="no border logo" style="@php if($lang == 'ur') { @endphp font-size:18px; @php } @endphp">
            <b>{{__trans('Addictive Bulletin', $lang)}}</b>
        </div>

        <div class="right menu">
            <a class="icon item search-toggle">
                <i class="search icon"></i>
            </a>
            <a class="launch-right icon item">
                <i class="newspaper icon"></i>
            </a>
        </div>
</div>

