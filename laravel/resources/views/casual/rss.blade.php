<?php $tab="RSS"; ?>
@extends('layouts.master')

@section('box1')
    <header class="intro-header">
    </header>
@endsection

@section('box2')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <h1>NASDAQ - Stocks</h1>
                <br />
                <div class="panel-body">
                    <ul>
<?php
                        $rss = new DOMDocument();
                        //    	$rss->load('http://wordpress.org/news/feed/');
                        //      $rss->load("http://feeds2.feedburner.com/InvestingRss");
                        $rss->load("http://articlefeeds.nasdaq.com/nasdaq/categories?category=Stocks");

                        $feed = array();
                        foreach ($rss->getElementsByTagName('item') as $node) {
                            $item = array ( 
                                'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
                                'desc'  => $node->getElementsByTagName('description')->item(0)->nodeValue,
                                'link'  => $node->getElementsByTagName('link')->item(0)->nodeValue,
                                'date'  => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
                            );
                            array_push($feed, $item);
                        }
                        $limit = 6;
                        for($x=0;$x<$limit;$x++) {
                            $article = $feed[$x];
                            $title = str_replace(' & ', ' &amp; ', $article['title']);
                            $link = $article['link'];
                            $description = $article['desc'];
                            $date = date('l F d, Y', strtotime($article['date']));
                            echo "<li>\n";
                            echo '<p><strong><a href="'.$link.'" title="'.$title.'">'.$title.'</a></strong><br />';
                            echo '<small><em>Posted on '.$date.'</em></small></p>';
                            echo '<p>'.$description.'</p>';
                            echo "</li>\n";
                        }
?>                  </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection