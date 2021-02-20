<?php

function getTimelineData($params = array()) {

        require_once('TwitterAPI.php');

        if (!empty($params) && !empty($params['settings'])) {
            require ($params['settings']);
        } else {
            require('settings.php');
        }

        $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';

        $getfield = '';

        $requestMethod = 'GET';

        $twitterjson = new TwitterAPI($settings);

        $string = $twitterjson->setGetfield($getfield)

                     ->buildOauth($url, $requestMethod)

                     ->performRequest();



        return $string;

}

function updateStatus($status, $params = array()) {
        require_once('TwitterAPI.php');

        if (!empty($params) && !empty($params['settings'])) {
            require ($params['settings']);
        } else {
            require('settings.php');
        }
        

        $url = 'https://api.twitter.com/1.1/statuses/update.json';

        $postfield = array_merge(array('status' => $status), $params);

        $requestMethod = 'POST';

        $twitterjson = new TwitterAPI($settings);

        $string = $twitterjson->setPostfields($postfield)

                     ->buildOauth($url, $requestMethod)

                     ->performRequest();



        return $string;
}



function getProfile() {

    $string = getTimelineData();



    $datas = json_decode($string, true);



    $data = $datas[0];

    echo "<h2>Utilisateur</h2>";

        $user = $data["user"];

        echo "<b>user : id : </b> ".$user["id"]." ; <b>@nom : </b> ".$user["screen_name"]." ; <b>nom profil :</b> ".$user["name"]." ; <b>Description :</b> ".$user["description"]."<br>";

        echo "<b>followers : </b> ".$user["followers_count"]."<br>";

        echo "<b>amis : </b> ".$user["friends_count"]."<br>";

        echo "<b>a aimé </b> ".$user["favourites_count"]."<br>";

        echo "<b>tweets : </b> ".$user["statuses_count"]."<br>";

        echo "<b>compte créé : </b> ".$user["created_at"]."<br>";

        echo "<b>compte vérifié : </b> ".$user["verified"]."<br>";

        echo "<b>utc_offset : </b> ".$user["utc_offset"]."<br>";

        echo "<b>Image de fond : </b> ".$user["profile_background_image_url"]."<br>";

        echo "<b>Image de profil : </b> ".$user["profile_image_url"]." ; <b>Utilise?</b> ".$user["profile_use_background_image"]."<br>";

        echo "<b>Couleurs liens : </b> ".$user["profile_link_color"]."<br>";

}



function getTweets() {

    $string = getTimelineData();



    $datas = json_decode($string, true);



    echo "<br><br>--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------";

        echo "<br>--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------";



        echo "<h2>Tweets</h2>";

        $i =0;

    foreach ($datas as $data) {

        $i++;



        $date = $data["created_at"];

        $dateformatee = date("d/m/Y à H:i:s", strtotime($date));



        echo "<h3><b>Tweet ".$data["id"]." créé le :</b> ". $dateformatee."</h3>";

        echo '<b>Lien / fera office de bouton repondre :</b> <a href="https://twitter.com/'.$data["user"]["id"].'/status/'.$data["id"].'" target="_blank">Tweet '.$data["id"].'</a><br>';



        $texte = $data["text"];



        //$texte = utf8_decode($texte);

        //$texte = utf8_encode($texte);



        //$randomape = array(chr(194), chr(160));

        //$texte = str_replace(chr(194), '', $texte);

        //$texte = str_replace(chr(160), '', $texte);

        //$texte = ord(substr($texte, 26, 1));



        $esttronque = 'Non';

        if ($data["truncated"] == 1) {

            $esttronque = 'Oui';

        }

        echo "<b>tronqué :</b> ".$esttronque."<br>";

        //echo "<b>texte :</b> ".var_dump($texte)."<br>";

        $entities =  $data["entities"];



        //echo "<br>";



        $tab = array();



        // Les tags

        if (isset($entities["hashtags"]) && sizeof($entities["hashtags"])>0) {

            $hastags = $entities["hashtags"];

            $t = 0;

            //echo "<h4>#tags :</h4> ";

            foreach ($hastags as $hastag) {

                $t++;

                //echo "<b>tag ".$t." :</b> ".$hastag["text"]." ; <b>indices :</b> ";

                $nb = 0;

                foreach ($hastag["indices"] as $indice) {

                    $nb++;

                    //echo $indice;

                    if ($nb == 1) {

                        $indice_depart = $indice;

                        //echo " - ";

                    }

                    else {

                        $taille = $indice - $indice_depart;

                    }

                }



                $lien = 'https://twitter.com/hashtag/'.$hastag["text"];

                $affichage = '#'.$hastag["text"];

                //echo "<br>";

                $donnees = array(

                    'indice_depart' => $indice_depart,

                    'taille' => $taille,

                    'type' => 'hashtag',

                    'affichage' => $affichage,

                    'lien' => $lien,

                );



                $tab[] = $donnees;

        }

        //echo "<br>";

        }



        //symbols - todo maybe



        // Les mentions

        if (isset($entities["user_mentions"]) && sizeof($entities["user_mentions"])>0) {

            $user_mentions = $entities["user_mentions"];

            $t = 0;

            //echo "<h4>mentions :</h4> ";

            foreach ($user_mentions as $mention) {

                $t++;

                //echo "<b>@nom ".$t." :</b> ".$mention["screen_name"]." ; <b>nom profil :</b> ".$mention["name"]." ; <b>id profil :</b> ".$mention["id"]." ; <b>indices :</b> ";

                $nb = 0;

                foreach ($mention["indices"] as $indice) {

                    $nb++;

                    //echo $indice;

                    if ($nb == 1) {

                        $indice_depart = $indice;

                        //echo " - ";

                    }

                    else {

                        $taille = $indice - $indice_depart;

                    }

                }



                $lien = 'https://twitter.com/'.$mention["screen_name"];

                $affichage = '@'.$mention["screen_name"];

                //echo "<br>";

                $donnees = array(

                    'indice_depart' => $indice_depart,

                    'taille' => $taille,

                    'type' => 'mention',

                    'affichage' => $affichage,

                    'lien' => $lien,

                );



                $tab[] = $donnees;

            }

            //echo "<br>";

        }



        // Les urls

        if (isset($entities["urls"]) && sizeof($entities["urls"])>0) {

            $urls = $entities["urls"];

            $t = 0;

            //echo "<h4>urls :</h4> ";

            foreach ($urls as $url) {

                $t++;

                //echo "<b>lien ".$t." :</b> ".$url["display_url"]." ; <b>indices :</b> ";

                $nb = 0;

                foreach ($url["indices"] as $indice) {

                    $nb++;

                    //echo $indice;

                    if ($nb == 1) {

                        $indice_depart = $indice;

                        //echo " - ";

                    }

                    else {

                        $taille = $indice - $indice_depart;

                    }

                }



                $lien = $url["expanded_url"];

                $affichage = $url["display_url"];

                //echo "<br>";

                $donnees = array(

                    'indice_depart' => $indice_depart,

                    'taille' => $taille,

                    'type' => 'url',

                    'affichage' => $affichage,

                    'lien' => $lien,

                );



                $tab[] = $donnees;

            }

            //echo "<br>";

        }



        // Les médias (images ou autres)

        if (isset($entities["media"]) && sizeof($entities["media"])>0) {





            $medias = $entities["media"];

            $t = 0;

            echo "<h4>médias :</h4> ";

                foreach ($medias as $media) {

                    $t++;

                    echo "<b>média ".$t." :</b> ".$media["display_url"]." ; <b>indices :</b> ";

                    $nb = 0;

                foreach ($media["indices"] as $indice) {

                    $nb++;

                    echo $indice;

                    if ($nb == 1) {

                        $indice_depart = $indice;

                        echo " - ";

                    }

                    else {

                        $taille = $indice - $indice_depart;

                    }

                }



                $lien = $media["expanded_url"];

                $affichage = $media["display_url"];

                $src = $media["media_url_https"];

                echo "<br>";

                $donnees = array(

                    'indice_depart' => $indice_depart,

                    'taille' => $taille,

                    'type' => 'media',

                    'affichage' => $affichage,

                    'lien' => $lien,

                    'src' => $src,

                );



                $tab[] = $donnees;

                    //echo "<br>";

                }

                //echo "<br>";

        }



        // RT et Favs

        $avanttexte = '';

        $nbrt = '';

        if ($data["retweet_count"] == 0) {

            $avanttexte = 'Soyez le premier à ';

        }

        else {

            $nbrt = "<b>RT :</b> ".$data["retweet_count"];

        }

        echo $nbrt.' <a href="https://twitter.com/intent/retweet?tweet_id='.$data["id"].'" target="_blank">'.$avanttexte.'retweet</a><br>';



        $avanttextefav = '';

        $nbfav = '';

        if ($data["favorite_count"] == 0) {

            $avanttextefav = 'Soyez le premier à aimer';

        }

        else {

            $avanttextefav = 'J\'aime';

            $nbfav = "<b>♥ :</b> ".$data["favorite_count"];

        }

        echo $nbfav.' <a href="https://twitter.com/intent/favorite?tweet_id='.$data["id"].'" target="_blank">'.$avanttextefav.'</a><br>';







        //echo "<b>texte avant :</b> ".$texte."<br>";



        //echo "Avant traitement :<br>";

        //echo var_dump($tab);

        //echo "Après traitement :<br>";



        //echo "<br><b>Tableau ordonné :</b><br>";

        //echo var_dump(ordonnerTableau($tab));



        //echo "<br><b>Tweet ordonné :</b><br>";

        echo construireTweet($texte, ordonnerTableau($tab), $data);



        // Source, pas intéressant à afficher

        //echo "<br>b>source :</b> ".$data["source"]."<br><br>";



        echo "<br><br>--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------";

    }

}



function debug() {

    echo getTimelineData();

}



function ordonnerTableau($tab) {

    $tab_trie = array();



    $dernier_index_ajoute = -1;



    // Tant qu'on a pas tout trié

    while (sizeof($tab_trie) != sizeof($tab)){



        $index_plus_petit = 999999;

        $nb_entree = -1;

        $entree_a_ajouter = -1;



        // On parcourt le tableau pour chercher la prochaine entrée à ajouter au tableau trié

        //echo "<br>---------------<br>";

        foreach ($tab as $entree) {

            $nb_entree++;

            //echo "dernier index ajouté : $dernier_index_ajoute<br>";

            //echo "entree : $nb_entree<br>";

            //echo "index de l'entrée : ".$entree['indice_depart']."<br><br>";



            // Si c'est le plus petit parmis ceux déjà parcourru

            if ($entree['indice_depart'] < $index_plus_petit && $entree['indice_depart']>$dernier_index_ajoute) {

                $index_plus_petit = $entree['indice_depart'];

                $entree_a_ajouter = $nb_entree;

                //echo "index : $index_plus_petit<br>";

                //echo "entree à ajouter : $entree_a_ajouter<br>----<br>";

            }

        }



        if ($entree_a_ajouter > -1) {

            $tab_trie[] = $tab[$entree_a_ajouter];

            $dernier_index_ajoute = $index_plus_petit;

        }

    }



    return $tab_trie;

}



function construireTweet($texte, $tab, $data) {

    $newtexte = $texte;

    $index_offset = 0;



    // en cas de tweet tronqué on compte le nombre d'url pour pour pouvoir retirer la dernière

    if ($data["truncated"] == 1) {

        $indexurl = 0;

        $nburl = 0;

        foreach ($tab as $inclusion) {

            if ($inclusion['type'] == 'url') {

                $nburl++;

            }

        }



    }

    // on intégre les liens et autres dans le tweet

    foreach ($tab as $inclusion) {

        $index = $inclusion['indice_depart'] + $index_offset;

        $taille = $inclusion['taille'];

        $avant = mb_substr($newtexte, 0, $index);

        $element = mb_substr($newtexte, $index, $taille);

        $apres = mb_substr($newtexte, $index+$taille);

        //echo "<br>Avant : ".$avant."<br>";

        //echo "<br>Element : ".$element."<br>";

        //echo "<br>Apres : ".$apres."<br>";

        //$fin = $element . $apres;

        //echo "<br>el+fin : ".$fin;



        // On modifie les éléments pour rajouter les liens et les classes

        $type = $inclusion['type'];

        $affichage = $inclusion['affichage'];

        $lien = $inclusion['lien'];

        $newelement = $element;

        switch ($type) {

             case 'hashtag':

                $newelement = '<a class="'.$type.'" href="'.$lien.'" target="_blank">'.$affichage.'</a>';

                break;

            case 'mention':

                $rt = mb_substr($newtexte, $index-3, 2);



                // Cas où le tweet est un RT sans commentaire

                if ($rt == 'RT') {



                    // On retire le 'RT '

                    $avant = mb_substr($avant, 0, -3);

                    $index_offset = $index_offset - 3;



                    // Pour ajouter un message custom de retweet qui pourra éventuellement être traduit plus tard.

                    $newelement = 'a retweeté le post de ';

                }

                else {

                    $newelement = '';

                }

                $newelement = $newelement.'<a class="'.$type.'" href="'.$lien.'" target="_blank">'.$affichage.'</a>';

                break;

            case 'url':

                $newelement = '<a class="'.$type.'" href="'.$lien.'" target="_blank">'.$affichage.'</a>';

                if ($data["truncated"] == 1) {

                    $indexurl++;

                    if ($indexurl == $nburl) {

                        //echo 'dernier indice : '.$inclusion['indice_depart'].'; ';

                        // C'est le dernier lien d'un tweet tronqué qui est ajouté par défaut à la fin. On le supprime

                        $newelement = '';

                    }



                }

                break;

            case 'media':

                $src = $inclusion['src'];

                $newelement = '<div class="'.$type.'"><a href="'.$lien.'" target="_blank"><img src="'.$src.'" alt="'.$affichage.'"></a></div>';

                break;

        }



        $index_offset = $index_offset + mb_strlen($newelement) - $taille;

        $newtexte = $avant.$newelement.$apres;



        //echo "<br>-----<br>";

    }



    return $newtexte;

}

