require('./bootstrap');

$("body").on('click', '.launch-left.icon.item', () => {
    $('.main-sidebar')
        .toggleClass('visible');
        $(".pusher").addClass("dimmed");
})

$("body").on('click', '.search-toggle', function(){
    $(".search-topbar").toggleClass("visible");
    $(".pusher").toggleClass("dimmed");
});

function hideNewsArticle(){
    $(".news-article").scrollTop(0);
    $("body").removeClass("no-scroll");
    $(".news-article").addClass("closed");
}
function showNewsArticle(){
    $(".news-article").removeClass("closed");
    $("body").addClass("no-scroll");
}
window.Vue = require('vue');

import VueRouter from 'vue-router'

Vue.use(VueRouter)

const routes = [
    { path: '/:lang', name: 'home-en' },
    { path: '/:lang/trending', name: "trending"},
    { path: '/:lang/category/:category', name: 'category'},
    { path: '/:lang/source/:source', name: 'source'},
    { path: '/:lang/source/:source/category/:category', name: 'source-category'},
    { path: '/:lang/news/:id/:slug?', name: "news"},
]

const router = new VueRouter({
    mode: 'history',
    routes: routes
})


Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
    router: router,
    data: function(){
        return {
            last_route: '/urdu',
            page: 1,
            story: window.story ? window.story: null,
            lang: 'urdu',
            loading: false,
            directLoad: 1,
            id: null,
            category: null,
            source: null,
            news: [],
            searchkeywords: '',
            sources: window.sources,
            selected_sources: [],
            stories: window.stories ? stories : [],
            min_scroll: 0
        }
    },
    watch: {
        $route: function(to, from){
            if(from.name != "news" && to.name != "news"){
                this.directLoad = false;
                this.loading = true;
                this.last_route = {name: this.$route.name, query: this.$route.query};
                this.page = 0;
                this.stories = [];
                this.source = this.category = null;
            }
            if(this.$route.name == "home-en" && from.name != "news"){
                document.title = "SNEWS | Home"
                this.getNews('h');
            }else if(this.$route.name == "category"){
                this.category = this.$route.params.category;
                document.title = "SNEWS | Category - " + this.$route.params.category;
                this.getNews('c');
            }else if(this.$route.name == "source"){
                this.source = this.$route.params.source;
                document.title = "SNEWS | Source - " + this.source;
                this.getNews('s')
            }else if(this.$route.name == "source-category"){
                this.source = this.$route.params.source;
                this.category = this.$route.params.category;
                document.title = "SNEWS | Source | Category - " + this.source + " - " + this.category;
                this.getNews('sc');
            }else if(this.$route.name == "trending"){
                document.title = "SNEWS | Trending - Trending news on top";
                this.getNews("tr");
            }else if(this.$route.name == "news"){
                this.id = this.$route.params.id;
                this.getStory();
            }
        }
    },
    methods: {
        search: function(){
            this.$router.push({
                path: this.$route.path,
                query: this.searchkeywords == "" ? '' : {search: this.searchkeywords}
            })
        },
        likeNews: function(id){
            let story = this.stories.filter(s => s.id == id)[0];
                axios.post("/api/like-news/"+id).then(res => {
                    if(story && story.liked == 0){
                        story.liked = 1;
                        story.likes += 1;
                    }else{
                        story.liked = 0;
                        story.likes -= 1;
                    }
                });
        },
        add_remove_source: function(id){
            if(this.selected_sources.indexOf(id) > -1){
                this.selected_sources.splice(this.selected_sources.indexOf(id), 1);
            }else{
                this.selected_sources.push(id);
            }
        },
        handleScroll: function(){
           var min =  $(".pusher").height() - $("body").height() - $("html").scrollTop();
           if(min < 0 && !this.loading && (this.stories.length % 20 == 0)){
                this.directLoad = false;
                this.loading = true;
                if(this.$route.name == "home-en"){
                    this.getNews('h');
                }else if(this.$route.name == "category"){
                    this.getNews('c');
                }else if(this.$route.name == "source"){
                    this.getNews('s')
                }else if(this.$route.name == "source-category"){
                    this.getNews('sc');
                }else if(this.$route.name == "trending"){
                    this.getNews("tr");
                }
           }
        },
        closeNews: function(){
            this.$router.push(this.last_route);
            hideNewsArticle();
        },
        openNews: function(){
            showNewsArticle();
        },
        getNews: function(type){
            this.page = this.page + 1;
            var link = "/api/" + this.lang + "/";
            if(type == 'c'){
                link += "category/"+this.category;
            }else if(type == "s"){
                link += "source/"+this.source;
            }else if(type == "sc"){
                link += "source/"+this.source+"/category/"+this.category;
            }else if(type == "tr"){
                link += "trending";
            }
            link += "?page="+this.page;
            link += "&search="+(this.$route.query.search ? this.$route.query.search : '');
            axios.get(link).then(res => {
                this.loading = false;
                this.stories.push(...res.data.data);
            });
        },
        getStory: function(){
            axios.get('/api/'+this.lang+'/get-story/'+this.id).then((res) => {
                this.story = res.data;
                this.openNews();
                let scr = document.querySelector("script[src='https://static.addtoany.com/menu/page.js']");
                if(scr)
                    document.body.removeChild(scr);
                var script = document.createElement("script");
                script.src = "https://static.addtoany.com/menu/page.js";
                document.body.appendChild(script);
            });
        }
    },
    beforeRouteEnter: function(to, from, next){
        this.prevRoute = from;
    },
    mounted: function(){
        this.lang = this.$route.params.lang;
        this.source = this.$route.params.source;
        this.category = this.$route.params.category;
        this.id = this.$route.params.id;
        if(this.$route.name != "news"){
            this.last_route = {name: this.$route.name, query: this.$route.query};
        }else{
            this.last_route = {path: '/' + this.$route.params.lang, query: {}};
        }
        if(this.$route.query.search && this.$route.query.search != ""){
            this.searchkeywords = this.$route.query.search;
        }
        this.selected_sources = localStorage.getItem("snews_sources") ? JSON.parse(localStorage.getItem("snews_sources")) : this.sources.map(s => s.id);
        window.addEventListener('scroll', this.handleScroll);
        let _this = this;
        $("body").on('click', '.pusher.dimmed', ()=>{
            if($(".icon-sidebar").hasClass('visible') && (JSON.stringify(_this.selected_sources) != localStorage.getItem("snews_sources"))){
                localStorage.setItem("snews_sources", JSON.stringify(_this.selected_sources));
                axios.put('/api/select-sources', {ids: _this.selected_sources}).then(res => {
                    if(this.$route.name == "home-en"){
                        _this.directLoad = false;
                        _this.loading = true;
                        _this.last_route = {name: this.$route.name, query: this.$route.query};
                        _this.page = 0;
                        _this.stories = [];
                        _this.source = this.category = null;
                        _this.getNews('home');
                    }
                    _this.$router.push('/' + _this.lang);
                });
            }
            $(".pusher").removeClass("dimmed");
            $(".main-sidebar").removeClass('visible');
            $(".icon-sidebar").removeClass('visible');
            $(".search-topbar").removeClass('visible');
        });

        $("body").on('click', '.launch-right.icon.item', () => {
            _this.selected_sources_match = this.selected_sources;
            $('.icon-sidebar')
                .toggleClass('visible');
            $(".pusher").addClass("dimmed");
        })
    }
});
