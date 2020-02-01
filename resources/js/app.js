require("./bootstrap");
window.Vue = require("vue");
import VueRouter from "vue-router";
import { initJQueryFns } from "./helpers";
import { $route } from './watchers'
import { MountLifecycle } from './lifecycle'
import { isLiked, search, likeNews, getNews, add_remove_source, handleScroll, closeNews, openNews, getStory } from './methods'
import VueAnalytics from 'vue-analytics';

initJQueryFns();
Vue.use(VueRouter);

const routes = [
  { path: "/:lang", name: "home-en" },
  { path: "/:lang/trending", name: "trending" },
  { path: "/:lang/category/:category", name: "category" },
  { path: "/:lang/source/:source", name: "source" },
  { path: "/:lang/source/:source/category/:category", name: "source-category" },
  { path: "/:lang/news/:id/:slug?", name: "news" }
];

const router = new VueRouter({
  mode: "history",
  routes: routes
});

Vue.use(VueAnalytics, {
  id: 'UA-106912900-3',
  router
});

new Vue({
  el: "#app",
  router: router,
  data: function() {
    return {
      last_route: "/urdu",
      page: 1,
      story: window.story || null,
      lang: "urdu",
      loading: false,
      directLoad: 1,
      id: null,
      category: null,
      source: null,
      news: [],
      searchkeywords: "",
      sources: window.sources,
      selected_sources: [],
      stories: window.stories || [],
      min_scroll: 0
    };
  },
  watch: {
    $route
  },
  mounted: MountLifecycle,
  methods: {
    isLiked,
    search,
    likeNews,
    getNews,
    add_remove_source,
    handleScroll,
    closeNews,
    openNews,
    getStory
  }
});
