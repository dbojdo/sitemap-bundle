<?php
namespace Webit\Bundle\SitemapBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class SitemapController extends Controller {    
    public function generateSitemapAction() {
        $sitemap = $this->get('webit_sitemap.sitemap_provider')->getSitemap(true);
        
        return $this->getSitemapAction();
    }
    
    public function getSitemapAction() {
        $sitemap = $this->get('webit_sitemap.sitemap_provider')->getSitemap();
        
        $response = new Response();
        
        $response->headers->add('Content-Type','application/xml');
        $response->headers->add('Content-Length',filesize($sitemap->getPathname()));
        $response->setContent(file_get_contents($sitemap->getPathname()));
        
        return $response;
    }
}
