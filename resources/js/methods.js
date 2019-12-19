import { showNewsArticle } from "./helpers";

export function isLiked (newsid) {
  return parseInt(this.stories.filter(s => s.id == newsid)[0].liked);
}

export function search () {
  this.$router.push({
    path: this.$route.path,
    query: this.searchkeywords == "" ? "" : { search: this.searchkeywords }
  });
}

export function likeNews (id) {
  let story = this.stories.filter(s => s.id == id)[0];
  if (story && story.liked == 0) {
    story.liked = 1;
    story.likes = parseInt(story.likes) + 1;
  } else {
    story.liked = 0;
    story.likes = parseInt(story.likes) - 1;
  }
  axios.post("/api/like-news/" + id).then(() => {});
}

export function add_remove_source (id) {
  if (this.selected_sources.indexOf(id) > -1) {
    this.selected_sources.splice(this.selected_sources.indexOf(id), 1);
  } else {
    this.selected_sources.push(id);
  }
}


export function getNews (type) {
  this.page = this.page + 1;
  let link = "/api/" + this.lang + "/";
  if (type == "c") {
    link += "category/" + this.category;
  } else if (type == "s") {
    link += "source/" + this.source;
  } else if (type == "sc") {
    link += "source/" + this.source + "/category/" + this.category;
  } else if (type == "tr") {
    link += "trending";
  }
  link += "?sources=" + JSON.stringify(this.selected_sources);
  link += "&page=" + this.page;
  link += "&search=" + (this.$route.query.search ? this.$route.query.search : "");
  axios.get(link + "&tid=" + Date.now()).then(res => {
    this.loading = false;
    this.stories.push(...res.data.data);
  });
}

export function handleScroll () {
  let min = $(".pusher").height() - $("body").height() - $("html").scrollTop();
  if (min < 1200 && !this.loading && this.stories.length % 24 == 0) {
    this.directLoad = false;
    this.loading = true;
    if (this.$route.name == "home-en") {
      this.getNews("h");
    } else if (this.$route.name == "category") {
      this.getNews("c");
    } else if (this.$route.name == "source") {
      this.getNews("s");
    } else if (this.$route.name == "source-category") {
      this.getNews("sc");
    } else if (this.$route.name == "trending") {
      this.getNews("tr");
    }
  }
}

export function closeNews () {
  this.$router.push(this.last_route);
}

export function openNews () {
  showNewsArticle();
}

export function getStory () {
  let news_filter = this.stories.filter(s => s.id == this.$route.params.id);
  if (news_filter.length > 0) {
    this.story = news_filter[0];
    if (!$(".news-article").hasClass("visible")) this.openNews();
    let scr = document.querySelector("script[src='https://static.addtoany.com/menu/page.js']");
    if (scr) document.body.removeChild(scr);
    let script = document.createElement("script");
    script.src = "https://static.addtoany.com/menu/page.js";
    document.body.appendChild(script);
  }
  axios.get("/api/" + this.lang + "/get-story/" + this.id + "?tid=" + Date.now()).then(res => {
    this.story = res.data;
    if (news_filter.length == 0) {
      if (!$(".news-article").hasClass("visible")) this.openNews();
    }
    let scr = document.querySelector("script[src='https://static.addtoany.com/menu/page.js']");
    if (scr) document.body.removeChild(scr);
    let script = document.createElement("script");
    script.src = "https://static.addtoany.com/menu/page.js";
    document.body.appendChild(script);
  });
}
