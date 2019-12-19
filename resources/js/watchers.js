import {hideNewsArticle, ucwords} from './helpers'

export function $route (to, from) {
  $(".story_media img").hide();
  if (from.name != "news" && to.name != "news") {
    this.directLoad = false;
    this.loading = true;
    this.last_route = { name: this.$route.name, query: this.$route.query };
    this.page = 0;
    this.stories = [];
    this.source = this.category = null;
  }
  if (from.name == "news" && to.name != "news") {
    $(".bottom.sidebar").addClass("visible");
    hideNewsArticle();
  }
  if (this.$route.name == "home-en" && from.name != "news") {
    document.title = "Addictive Bulletin | Home";
    this.getNews("h");
  } else if (this.$route.name == "category") {
    this.category = this.$route.params.category;
    document.title = "Addictive Bulletin | Category - " + ucwords(this.$route.params.category);
    this.getNews("c");
  } else if (this.$route.name == "source") {
    this.source = this.$route.params.source;
    document.title = "Addictive Bulletin | Source - " + ucwords(this.source);
    this.getNews("s");
  } else if (this.$route.name == "source-category") {
    this.source = this.$route.params.source;
    this.category = this.$route.params.category;
    document.title =
      "Addictive Bulletin | Source | Category - " +
      ucwords(this.source) +
      " - " +
      this.category;
    this.getNews("sc");
  } else if (this.$route.name == "trending") {
    document.title = "Addictive Bulletin | Trending - Trending news on top";
    this.getNews("tr");
  } else if (this.$route.name == "news") {
    $(".bottom.sidebar").removeClass("visible");
    this.id = this.$route.params.id;
    this.getStory();
  }
}
