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

    public function neighbouring()
    {
        //get synonyms to word
        $client = new NlpClient(env('NLP_URL'));
        $neighbours = $client->neighbours('president','en');
        dd($neighbours);
    }

    public function summarization()
    {
        //get short summarize for long text
        $client = new NlpClient(env('NLP_URL'));
        $text = 'Lovecraft immersed himself in the world of amateur journalism for most of the following decade.[4]:159 During this period, he was an advocate for amateurism versus commercialism.[4]:164 Lovecraft\'s definition of commercialism, though, was specific to writing for, what he considered, low-brow publications for pay. He contrasted this with his view of "professional publication," which he termed as writing for journals and publishers he considered respectable. He thought of amateur journalism as training and practice for a professional career.[4]:165 Lovecraft was appointed to chairman of the Department of Public Criticism of the UAPA in late 1914.[4]:168 He used this position to advocate for his, what many considered peculiar, insistence on the superiority of English language usage that most writers already considered archaic. Emblematic of the Anglophile opinions he maintained throughout his life, he openly criticized other UAPA contributors for their "Americanisms" and "slang." Often these criticisms were couched in xenophobic and racist arguments bemoaning the "bastardization" of the "national language" by immigrants.[4]:169 In mid-1915, Lovecraft was elected to the position of first vice-president of the UAPA.[4]:180 Two years later, he was elected president and appointed other board members that mostly shared his view on the supremacy of classical English over modern American English.[4]:182 Another significant event of this time was the beginning of World War I. Lovecraft published multiple criticisms of the U.S. government\'s and the American public\'s reluctance to join the war to protect England, which he viewed as America\'s homeland.';
        $summarization = $client->summarize($text);
        dd($summarization);
    }
}
