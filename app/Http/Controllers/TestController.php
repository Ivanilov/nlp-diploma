<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Web64\Nlp\NlpClient;

class TestController extends Controller
{
    public function languageDetect()
    {
        //detecting language from text
        $test_text = 'Hello world!';
        $client = new NlpClient(env('NLP_URL'));
        $detected_lang = $client->language($test_text);
        dd($detected_lang);
    }

    public function articleExtract()
    {
        //parsing html by url or source html (getting text, author and meta-data)
        $client = new NlpClient(env('NLP_URL'));
        $article = $client->newspaper('https://github.com/jamiebuilds/unstated-next');
        dd($article);
    }

    public function sentiment()
    {
        //getting positive or negative sentiment from text
        //if text has positive value -> 1
        //if negative -> -1
        //neutral -> 0
        $client = new NlpClient(env('NLP_URL'));
        $polyglot = $client->polyglot_entities('I love you','en');
        dd($polyglot->getSentiment());
    }
}
