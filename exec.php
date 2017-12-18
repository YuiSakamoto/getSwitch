<?php
require 'vendor/autoload.php';

use Goose\Client as GooseClient;
use Sunra\PhpSimple\HtmlDomParser as HtmlDomParser;

$goose = new GooseClient();
$parser = new HtmlDomParser();
$expect = '予定数の販売を終了しました';
$url = 'http://www.yodobashi.com/product/100000001003431566/';

$article = $goose->extractContent($url);
$doms = $parser->str_get_html($article->getRawHtml())->find('.buyBoxMain');
foreach($doms as $dom) {
    $text = $dom->last_child()->last_child()->last_child()->last_child()->innertext;
    continue;
}

if ($expect !== $text) {
    exec('/usr/bin/open -a /Applications/Google\ Chrome.app/Contents/MacOS/Google\ Chrome ' . $url);
    exec('/usr/bin/say "now on sale!"');
}

