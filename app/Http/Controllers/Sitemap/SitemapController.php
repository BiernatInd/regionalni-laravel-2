<?php

namespace App\Http\Controllers\Sitemap;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog\BlogList;

class SitemapController extends Controller
{
    public function generate()
    {
        $xml = new \XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->startDocument('1.0', 'UTF-8');
        $xml->startElement('urlset');
        $xml->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

        $staticRoutes = [
            '/dokumenty' => 'monthly',
            '/polityka-prywatnosci' => 'monthly',
            '/blog' => 'monthly',
            '/galeria' => 'monthly',
            '/logowanie' => 'monthly',
            '/rejestracja' => 'monthly',
            '/odzyskiwanie-hasla' => 'monthly',
        ];

        foreach ($staticRoutes as $path => $changefreq) {
            $this->addUrl($xml, 'https://regionalnisandomierz.com.pl' . $path, '2023-10-10T00:00:00+00:00', $changefreq, 0.8);
        }

        $entries = BlogList::all();

        foreach ($entries as $entry) {
            $url = 'https://regionalnisandomierz.com.pl/artykul/' . $entry->id;
            $lastmod = $entry->updated_at->toIso8601String();
            $this->addUrl($xml, $url, $lastmod, 'weekly', 0.6);
        }

        $xml->endElement();
        $xmlContent = $xml->outputMemory();

        return response($xmlContent)->header('Content-Type', 'text/xml');
    }

    private function addUrl(\XMLWriter $xml, $loc, $lastmod, $changefreq, $priority)
    {
        $xml->startElement('url');
        $xml->writeElement('loc', $loc);
        $xml->writeElement('lastmod', $lastmod);
        $xml->writeElement('changefreq', $changefreq);
        $xml->writeElement('priority', $priority);
        $xml->endElement();
    }
}
