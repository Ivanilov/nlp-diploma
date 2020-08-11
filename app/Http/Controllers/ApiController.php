<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Web64\Nlp\MsConceptGraph;
use Web64\Nlp\NlpClient;

class ApiController extends Controller
{
    public function languageDetect(Request $request)
    {
        //detecting language from text
        $client = new NlpClient(env('NLP_URL'));
        $detected_lang = $client->language($request->input('text'));
        return response([
            'language' => $detected_lang
        ]);
    }

    public function articleExtract()
    {
        //parsing html by url or source html (getting text, author and meta-data)
        $client = new NlpClient(env('NLP_URL'));
        $article = $client->newspaper('https://github.com/jamiebuilds/unstated-next');
        dd($article);
    }

    public function sentiment(Request $request)
    {
        //getting positive or negative sentiment from text
        //if text has positive value -> 1
        //if negative -> -1
        //neutral -> 0
        $client = new NlpClient(env('NLP_URL'));
        $polyglot = $client->polyglot_entities($request->input('text', null),$request->input('language','en'));
        return response([
            'sentiment' => $polyglot->getSentiment()
        ]);
    }

    public function entityExtraction()
    {
        //gets entities (locations, organizations & persons ) from text
        $client = new NlpClient(env('NLP_URL'));
        $polyglot = $client->polyglot_entities('We live in Ukraine.
        It is a beautiful country with wide opportunities and great people.
        Especially I live in Kiev.
        Our major is Vladimir Klitschko.
        Did you hear of him?
        He is a former boxer.','en');
        dd($polyglot->getEntityTypes());
    }

    public function neighbouring(Request $request)
    {
        //get synonyms to word
        $client = new NlpClient(env('NLP_URL'));
        $neighbours = $client->neighbours($request->input('text', null),$request->input('language','en'));
        return response([
            'neighbours' => $neighbours
        ]);
    }

    public function summarization(Request $request)
    {
        //get short summarize for long text
        $client = new NlpClient(env('NLP_URL'));
        $summarization = $client->summarize($request->input('text',null));
        return response([
            'summarize' => $summarization
        ]);
    }

    public function concept(Request $request)
    {
        //returns graph weights of concepts of word
        $concept = new MsConceptGraph;
        $res = $concept->get($request->input('text',null));
        return response([
            'concept' => $res
        ]);
    }
}
