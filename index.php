<?php
require 'vendor/autoload.php';

use Alura\FindCourses\FindEngine;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

$client = new Client(['base_uri' => 'https://www.alura.com.br/']);
$crawler = new Crawler();

$search_engine = new FindEngine($client, $crawler);
$courses = $search_engine->find('/cursos-online-programacao/php');

foreach ($courses as $curse) {
    echo $curse . PHP_EOL;
}
