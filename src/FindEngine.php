<?php

namespace Alura\FindCourses;

use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class FindEngine
{
    private ClientInterface $httpClient;
    private Crawler $crawler;

    public function __construct($httpClient, $crawler)
    {
        $this->httpClient = $httpClient;
        $this->crawler = $crawler;
    }

    public function find(string $url): array
    {
        $response = $this->httpClient->request('GET', $url);

        $html = $response->getBody();
        $this->crawler->addHtmlContent($html);

        $elements = $this->crawler->filter('span.card-curso__nome');
        $courses = [];

        foreach ($elements as $element) {
            $courses[] = $element->textContent;
        }

        return $courses;
    }
}
