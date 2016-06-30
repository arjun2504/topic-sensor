<?php
function getIndex() {
        $collection = array(
                1 => "Python is a 2000 made-for-TV horror movie directed by Richard
Clabaugh. The film features several cult favorite actors, including William
Zabka of The Karate Kid fame, Wil Wheaton, Casper Van Dien, Jenny McCarthy,
Keith Coogan, Robert Englund (best known for his role as Freddy Krueger in the
A Nightmare on Elm Street series of films), Dana Barron, David Bowe, and Sean
Whalen. The film concerns a genetically engineered snake, a python, that
escapes and unleashes itself on a small town. It includes the classic final
girl scenario evident in films like Friday the 13th. It was filmed in Los Angeles,
 California and Malibu, California. Python was followed by two sequels: Python
 II (2002) and Boa vs. Python (2004), both also made-for-TV films.",
                2 => "Python, from the Greek word (πύθων/πύθωνας), is a genus of
nonvenomous pythons[2] found in Africa and Asia. Currently, 7 species are
recognised.[2] A member of this genus, P. reticulatus, is among the longest
snakes known.",
                3 => "The Colt Python is a .357 Magnum caliber revolver formerly
manufactured by Colt's Manufacturing Company of Hartford, Connecticut.
It is sometimes referred to as a 'Combat Magnum'.[1] It was first introduced
in 1955, the same year as Smith & Wesson's M29 .44 Magnum. The now discontinued
Colt Python targeted the premium revolver market segment. Some firearm
collectors and writers such as Jeff Cooper, Ian V. Hogg, Chuck Hawks, Leroy
Thompson, Renee Smeets and Martin Dougherty have described the Python as the
finest production revolver ever made."
        );

        $collection = array_map('strtolower', $collection);

        $dictionary = array();
        $docCount = array();

        foreach($collection as $docID => $doc) {
                $terms = explode(' ', $doc);
                $docCount[$docID] = count($terms);

                foreach($terms as $term) {
                        if(!isset($dictionary[$term])) {
                                $dictionary[$term] = array('df' => 0, 'postings' => array());
                        }
                        if(!isset($dictionary[$term]['postings'][$docID])) {
                                $dictionary[$term]['df']++;
                                $dictionary[$term]['postings'][$docID] = array('tf' => 0);
                        }

                        $dictionary[$term]['postings'][$docID]['tf']++;
                }
        }

        return array('docCount' => $docCount, 'dictionary' => $dictionary);
}
function getTfidf($term) {
        $index = getIndex();
        $docCount = count($index['docCount']);
        $entry = $index['dictionary'][$term];
        foreach($entry['postings'] as  $docID => $postings) {
                echo "Document $docID and term $term give TFIDF: " .
                        ($postings['tf'] * log($docCount / $entry['df'], 2));
                echo "<br/>";
        }
}



function removeStopWords($str) {

        $handle = fopen("stop-words.txt", "r");
        $stopwords = array();
        while($words = fgets($handle)) {
                $words = trim($words);
                $stopwords = array_merge($stopwords, array($words => 1));
        }        

        // 1.) break string into words
        // [^-\w\'] matches characters, that are not [0-9a-zA-Z_-']
        // if input is unicode/utf-8, the u flag is needed: /pattern/u
        $words = preg_split('/[^-\w\']+/', $str, -1, PREG_SPLIT_NO_EMPTY);

        // 2.) if we have at least 2 words, remove stopwords
        if(count($words) > 1)
        {
        $words = array_filter($words, function ($w) use (&$stopwords) {
        return !isset($stopwords[strtolower($w)]);
        # if utf-8: mb_strtolower($w, "utf-8")
        });
        }

        // check if not too much was removed such as "the the" would return empty
        if(!empty($words))
        return implode(" ", $words);
        return $str;
}
echo removeStopWords("We just havent a quarrel with people around.");

?>