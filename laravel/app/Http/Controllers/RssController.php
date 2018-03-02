<?php

namespace feeduciary\Http\Controllers;

use Illuminate\Http\Request;

class RssController extends Controller
{

    public function curl($url, $ua = FALSE) {
        if($ua == false){
            $ua = $_SERVER['HTTP_USER_AGENT'];
        }
        $ch = curl_init();
        curl_setopt($ch , CURLOPT_URL , $url);
        curl_setopt($ch , CURLOPT_RETURNTRANSFER , true);
        curl_setopt($ch , CURLOPT_FOLLOWLOCATION , true);
        curl_setopt($ch , CURLOPT_USERAGENT , $ua);
        curl_setopt($ch , CURLOPT_SSL_VERIFYPEER, false); 
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $url = 'https://www.fa-mag.com/fa-online/online-articles/rss'; // godaddy is blocking this address
        $url = "https://www.gfsc.gg/news/rss";
        $output = $this->curl($url);
        $xml = new \SimpleXMLElement($output);

        $msg = "<ul>\n";
        foreach ($xml->channel->item as $item) {
            $msg .= "<li>\n";
            $msg .= '<p><strong>';
            $msg .= '<a href="'.$item->link.'" title="'.$item->title.'">'.$item->title.'</a>';
            $msg .= '</strong><br />';
            $msg .= '<small><em>Posted on '.$item->pubDate.'</em></small></p>';
            $msg .= '<p>'.$item->description.'</p>';
            $msg .= "</li>";
        }
        $msg .= "</ul>\n";

        return view('casual.rss', compact('result','msg'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
