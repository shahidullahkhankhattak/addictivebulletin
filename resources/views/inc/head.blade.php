<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-106912900-3"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'UA-106912900-3');
    </script>
    <meta charset="UTF-8">
    <base href="/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="manifest" href="/superpwa-manifest.json">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Seaweed+Script" rel="stylesheet">
    <link rel="stylesheet" href="//fonts.googleapis.com/earlyaccess/notonastaliqurdudraft.css">
    <link rel="stylesheet" href="/public/css/semantic.min.css">
    <link rel="stylesheet" href="/public{{mix('css/app.css')}}">
    <link rel="shortcut icon" href="/public/images/favicon.png" >
    <title>@if($page != 'News') Addictive Bulletin |@endif {{$page}} - {{$title}}</title>
    <?php if ($story): ?>
    <meta name="robots" content="index,follow">
    <meta name="description" content="{{ $story->description}}" />
    <meta name="keywords" content="{{empty($story->tags) ? implode(',', explode(" ", $title)) : $story->tags }}" />
    <meta name="DC.title" content="Addictive Bulletin | {{$page}} - {{$title}}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@AddictiveNews">
    <meta property="og:url" content="{{ Request::url() }}" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{ $story->title }}" />
    <meta property="og:description" content="{{ $story->description}}" />
    <meta property="og:image" content="{{ $story->media }}" />
    <?php else: ?>
    <meta name="robots" content="index,follow">
    <meta name="author" content="Addictive Bulletin">
    <?php if($page == "trending"): ?>
    <meta name="description" content="Addictive Bulletin can show the most trending news on top within different categories and extensive collection of news." />
    <?php elseif($page == "Category"): ?>
    <meta name="description" content="Addictive Bulletin has news from <?php echo $title ?> category and also extensive collection of news." />
    <?php else: ?>
    <meta name="description" content="Addictive Bulletin is a news aggregater where you can explore and search within all categories and extensive collection of news." />
    <?php endif; ?>
    <meta name="keywords" content="addictive,news,paltform,aggregator,wwebsite,latest,trending,aggregate,news,bulletin,great,awesome" />
    <meta name="DC.title" content="Addictive Bulletin | Your only source of extensive collection of news.">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@AddictiveNews">
    <meta property="og:url" content="{{ Request::url() }}" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Addictive Bulletin" />
    <meta property="og:description" content="Your only single source of extensive collection of news, where you can search and explore all type of news." />
    <meta property="og:image" content="https://www.addictivebulletin.com/public/images/addictive_bulletin_logo.png" />
    <?php endif; ?>
    <script src="/public/js/jquery.min.js"></script>
    <script src="/public/js/semantic.min.js"></script>
    <script type='text/javascript'>
        /* <![CDATA[ */
        var superpwa_sw = {"url":"\/superpwa-sw.js"};
        /* ]]> */
    </script>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
      (adsbygoogle = window.adsbygoogle || []).push({
        google_ad_client: "ca-pub-9020858645765106",
        enable_page_level_ads: true
      });
    </script>
    <script type='text/javascript' src='/public/js/register-sw.js'></script>
    <?php if ($story): ?>
    <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "NewsArticle",
          "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": "{{ Request::url() }}"
          },
          "headline": "{{$title}}",
          "image": [
            "{{ $story->media }}"
           ],
          "datePublished": "{{ $story->pub_date }}",
          "dateModified": "{{ $story->pub_date }}",
          "author": {
            "@type": "Person",
            "name": "{{ $story->source }}"
          },
           "publisher": {
            "@type": "Organization",
            "name": "Addictive Bulletin",
            "logo": {
              "@type": "ImageObject",
              "url": "https://www.addictivebulletin.com/public/images/addictive_bulletin_logo_new.png"
            }
          },
          "description": "{{ $story->description }}"
        }
    </script>
    <?php endif; ?>
    <script>
        window.story = {!! $story ? $story : 'null' !!};
        window.stories = {!! json_encode($news) !!};
        window.sources = {!! $sources !!};
        window.page = 1;
        function fadeIn(obj) {
            $(obj).fadeIn(800, function(){
                $(obj).css({opacity: 1});
            });
        }
    </script>
    <style>
        .news-article .story_wrapper{
            overflow-x:hidden;
            padding-bottom:100px;
        }
        .story_wrapper .story_media{
            text-align:center;
        }
        .no-show{
            display:none;
        }

        ui.card>.image>img, .ui.cards>.card>.image>a>img {
            display: none;
            width: 100%;
        }
        .news-article .full.height .toc{
            width:300px;
        }
        .news-sidebar{
            height:auto;
            padding:30px;
        }
        .news-article .full.height .article{
            margin-left:300px;
        }
        html[dir=rtl] .news-article .full.height .article{
            margin-right:300px;
        }
        .top_bar{
            width:calc(100% - 300px);
        }
        .news-article .ui.left.vertical.inverted.menu.left-menu{
            width:285px;
            margin-left:15px;
        }
        .source-title {
            font-size: 40px;
            line-height: 45px;
        }
        html[dir=rtl] .source-title{
            font-size:50px;
            line-height:70px;
        }
        .news-article .ui.left.vertical.inverted.menu.left-menu{
            max-height:430px;
        }
        @media (min-height: 900px){
            .news-article .ui.left.vertical.inverted.menu.left-menu{
                max-height:575px;
            }
        }
    </style>
</head>
