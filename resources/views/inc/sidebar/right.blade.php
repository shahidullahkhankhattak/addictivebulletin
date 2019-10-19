<div class="ui right vertical sidebar menu icon-sidebar overlay">

    @foreach($sources as $source)
    <a class="item" dir="ltr">
        <div class="ui toggle checkbox">
        <input type="checkbox" name="public" @click="add_remove_source({{$source->id}})" :checked="selected_sources.indexOf({{$source->id}}) > -1">
                <router-link tag="a" :to="'/' + lang + '/source/{{$source->slug}}' + (category ? '/category/' + category : '')" title="{{$source->source}}">{{$source->source}}</router-link>
        </div>
    </a>
    @endforeach
</div>
