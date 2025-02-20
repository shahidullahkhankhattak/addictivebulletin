<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
      http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    <url>
        <loc>https://www.addictivebulletin.com/english</loc>
        <changefreq>hourly</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>https://www.addictivebulletin.com/urdu</loc>
        <changefreq>hourly</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>https://www.addictivebulletin.com/english/trending</loc>
        <changefreq>daily</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>https://www.addictivebulletin.com/urdu/trending</loc>
        <changefreq>daily</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>https://www.addictivebulletin.com/english/category/world</loc>
        <changefreq>hourly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>https://www.addictivebulletin.com/english/category/national</loc>
        <changefreq>hourly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>https://www.addictivebulletin.com/english/category/sports</loc>
        <changefreq>hourly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>https://www.addictivebulletin.com/english/category/technology</loc>
        <changefreq>hourly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>https://www.addictivebulletin.com/english/category/health</loc>
        <changefreq>hourly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>https://www.addictivebulletin.com/english/category/others</loc>
        <changefreq>hourly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>https://www.addictivebulletin.com/urdu/category/world</loc>
        <changefreq>hourly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>https://www.addictivebulletin.com/urdu/category/national</loc>
        <changefreq>hourly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>https://www.addictivebulletin.com/urdu/category/sports</loc>
        <changefreq>hourly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>https://www.addictivebulletin.com/urdu/category/technology</loc>
        <changefreq>hourly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>https://www.addictivebulletin.com/urdu/category/health</loc>
        <changefreq>hourly</changefreq>
        <priority>0.80</priority>
    </url>
    <url>
        <loc>https://www.addictivebulletin.com/urdu/category/others</loc>
        <changefreq>hourly</changefreq>
        <priority>0.80</priority>
    </url>
    @foreach($news as $story)
    <url>
    <loc>https://www.addictivebulletin.com/{{$story->lang}}/news/{{$story->id}}/{{$story->slug}}</loc>
        <changefreq>daily</changefreq>
        <priority>0.50</priority>
    </url>
    @endforeach
</urlset>
