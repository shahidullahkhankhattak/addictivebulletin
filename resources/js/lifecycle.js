export const MountLifecycle = function () {
  this.lang = this.$route.params.lang;
  this.source = this.$route.params.source;
  this.category = this.$route.params.category;
  this.directLoad = false;
  this.id = this.$route.params.id;
  if (this.$route.name != "news") {
    this.last_route = { name: this.$route.name, query: this.$route.query };
  } else {
    this.last_route = { path: "/" + this.lang, query: {} };
    $(".bottom.sidebar").removeClass("visible");
  }
  if (this.$route.query.search && this.$route.query.search != "") {
    this.searchkeywords = this.$route.query.search;
  }
  if (JSON.parse(localStorage.getItem("snews_sources_" + this.lang)) == null) {
    localStorage.setItem(
      "snews_sources_" + this.lang,
      JSON.stringify(this.sources.map(s => s.id))
    );
  }
  this.selected_sources = localStorage.getItem("snews_sources_" + this.lang)
    ? JSON.parse(localStorage.getItem("snews_sources_" + this.lang))
    : this.sources.map(s => s.id);
  window.addEventListener("scroll", this.handleScroll);
  let _this = this;
  $("body").on("click", ".pusher.dimmed", () => {
    if (
      $(".icon-sidebar").hasClass("visible") &&
      JSON.stringify(_this.selected_sources) !=
        localStorage.getItem("snews_sources_" + _this.lang)
    ) {
      localStorage.setItem("snews_sources_" + _this.lang, JSON.stringify(_this.selected_sources));
      axios.put("/api/select-sources/" + _this.lang, { ids: _this.selected_sources }).then(() => {
        if (this.$route.name == "home-en") {
          _this.directLoad = false;
          _this.loading = true;
          _this.last_route = { name: this.$route.name, query: this.$route.query };
          _this.page = 0;
          _this.stories = [];
          _this.source = this.category = null;
          _this.getNews("h");
        }
        _this.$router.push({
          path: "/" + _this.lang,
          query: { tid: Math.ceil(Math.random() * 9999999999) }
        });
      });
    }
    $(".pusher").removeClass("dimmed");
    $(".main-sidebar").removeClass("visible");
    $(".icon-sidebar").removeClass("visible");
    $(".search-topbar").removeClass("visible");
  });

  $("body").on("click", ".launch-right.icon.item", () => {
    _this.selected_sources_match = this.selected_sources;
    $(".icon-sidebar").toggleClass("visible");
    $(".pusher").addClass("dimmed");
  });
}
