<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    {{-- Üniversiteler --}}
    @foreach ($universities as $university)
        <url>
            <loc>{{ url('/universite-yorumlari/' . $university->slug) }}</loc>
            <lastmod>{{ now() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    {{-- Şehirler --}}
    @foreach ($cities as $city)
        <url>
            <loc>{{ url('forum/sehir/' . $city->slug) }}</loc>
            <lastmod>{{ now() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.5</priority>
        </url>
    @endforeach

</urlset>
