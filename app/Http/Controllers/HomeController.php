<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /** Two model search
     *
     */
    public function search(){
        //$search_query = Input::get('search_query');
        //$search_query = $request->query('search_query');
        //$search_query = request()->query('search_query');
       /* $query = "a";
        $blog= Blog::search($query)->get();
        $comment = Comment::with('user')->search($query)->get();
        $collection = collect($blog);
        $collection = $collection->merge($comment);
        dd($collection);*/
       /*
        * History of curl
        * First implementation start 1997
        * Php V4.02 <= PHP
        *
        */
   /*    $ch = Curl_init();
       $url = "https://soundcloud.com/";
       Curl_setopt($ch,CURLOPT_URL,$url);
       Curl_setopt($ch,CURLOPT_POST,true);
       Curl_setopt($ch,CURLOPT_POSTFIELDS,"name=jhone&email=doe&password=12&");
        Curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $body = Curl_exec($ch);
       //Curl_setopt($ch,CURLOPT_GET,true);
       Curl_close($ch);*/

    $raw_html = file_get_contents("https://www.kantipurdaily.com/");
    $dom_document = new \DOMDocument();
    libxml_use_internal_errors(true); //disable xml related errors

     if(!empty($raw_html)){

         libxml_clear_errors(); //remove html errors
         $dom_document->loadHTML($raw_html);
         $domx_path = new \DOMXPath($dom_document);
         $row = $domx_path->query("//article/p");
         $data = [];
         if($row->length >0){
             foreach ($row as $d){
                $val = sprintf("%s %s",$d->nodeValue,"<br/>");
                echo $val;
             }
         }
     }







    }
}
