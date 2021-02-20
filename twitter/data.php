<?php





// récupérer le json de la timeline d'un compte twitter

function d_get_timeline_data($settings) {

        require_once('TwitterAPI.php');

        $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';

        $getfield = '';

        $requestMethod = 'GET';

        $twitterjson = new TwitterAPI($settings);

        $string = $twitterjson->setGetfield($getfield)

                     ->buildOauth($url, $requestMethod)

                     ->performRequest();



        return $string;

}



/**

 * Récupération de tous les posts d'un compte twitter

 */

function d_get_posts()
    {
    // SAME AS test/twitter/settings.php
    $config = require
        __DIR__
        . DIRECTORY_SEPARATOR
        . '..'
        . DIRECTORY_SEPARATOR
        . 'config.php'
    ;
    $settings = $config['twitter-api']['pierreminiggio'];

    $string = d_get_timeline_data($settings);

    $tweets = json_decode($string, true);


    foreach ($tweets as $tweet){

        $idsrc = $tweet['id_str'];

        echo 'check du post : '.$idsrc.'<br>';

        d_insert_post($tweet, $idsrc);

    }



    return $tweets;
}





function d_insert_post($post, $idsrc){

    $id = $idsrc;

    $json = json_encode($post);

    $texte_brut = $post['text'];
    // on va construire le $texte_html



    $date = $post["created_at"];

    $date_publication = date("Y-m-d H:i:s", strtotime($date));



    // On récupère les divers éléments des tweets pour pouvoir changer l'html.

    $entities =  $post["entities"];

    $tab = d_generer_tab_entities($entities, $id);



    $texte_html = d_construire_tweet($texte_brut, d_ordonner_tableau($tab), $post);


    // On modifie le texte_brut APRES avoir créé l'html, pour ne pas fuck up les offsets
    $texte_brut = str_replace("J'ai ???? la vidéo", "J'ai aimé la vidéo", $texte_brut);
    $texte_brut = str_replace("J'ai 👍 la vidéo", "J'ai aimé la vidéo", $texte_brut);


    //On vérifie que l'ID du post n'est pas présent dans la base

    include_once 'utils.php';

    $conn = Utils::connecter();

    $sql="SELECT * FROM social__publication WHERE id_publication_source ='".$id."'";

    $result = Utils::querySQL($sql, $conn);

    $counter = 0;

    foreach ($result-> fetchAll() as $a) {

        $counter++;

    }

    Utils::deconnecter($conn);

    if($counter==0){

        //On insère un post

        include_once 'utils.php';

        $conn = Utils::connecter();

        $sql = "INSERT INTO social__publication (json, texte_brut, texte_html, id_publication_source, date_publication) VALUES (".$conn->quote($json).", ".$conn->quote($texte_brut).", ".$conn->quote($texte_html).", '".$id."', '".$date_publication."')";

        Utils::execSQL($sql, $conn);

        Utils::deconnecter($conn);

        echo "Post inséré<br>";

    }

    else {

        echo "Post déjà présent<br>";

    }

}

// générer un tableau répertoriant la liste des modifications à effectuer sur le tweet

function d_generer_tab_entities($entities, $id) {



    // Le tableau où seront répertoriées les entités

    $tab = array();



    // Les tags

    if (isset($entities["hashtags"]) && sizeof($entities["hashtags"])>0) {

        $hastags = $entities["hashtags"];

        $t = 0;

        foreach ($hastags as $hastag) {

            $t++;

            $nb = 0;

            foreach ($hastag["indices"] as $indice) {

                $nb++;

                if ($nb == 1) {

                    $indice_depart = $indice;

                }

                else {

                    $taille = $indice - $indice_depart;

                }

            }



            $lien = 'https://twitter.com/hashtag/'.$hastag["text"];

            $affichage = '#'.$hastag["text"];

            $donnees = array(

                'indice_depart' => $indice_depart,

                'taille' => $taille,

                'type' => 'hashtag',

                'affichage' => $affichage,

                'lien' => $lien,

            );



            $tab[] = $donnees;

        }

    }



    //symbols - todo maybe



    // Les mentions

    if (isset($entities["user_mentions"]) && sizeof($entities["user_mentions"])>0) {

        $user_mentions = $entities["user_mentions"];

        $t = 0;

        foreach ($user_mentions as $mention) {

            $t++;

            $nb = 0;

            foreach ($mention["indices"] as $indice) {

                $nb++;

                if ($nb == 1) {

                    $indice_depart = $indice;

                }

                else {

                    $taille = $indice - $indice_depart;

                }

            }



            $lien = 'https://twitter.com/'.$mention["screen_name"];

            $affichage = '@'.$mention["screen_name"];

            $donnees = array(

                'indice_depart' => $indice_depart,

                'taille' => $taille,

                'type' => 'mention',

                'affichage' => $affichage,

                'lien' => $lien,

            );



            $tab[] = $donnees;

        }

    }



    // Les urls

    if (isset($entities["urls"]) && sizeof($entities["urls"])>0) {

        $urls = $entities["urls"];

        $t = 0;

        foreach ($urls as $url) {

            $t++;

            $nb = 0;

            foreach ($url["indices"] as $indice) {

                $nb++;

                if ($nb == 1) {

                    $indice_depart = $indice;

                }

                else {

                    $taille = $indice - $indice_depart;

                }

            }



            $lien = $url["expanded_url"];

            $affichage = $url["display_url"];

            $donnees = array(

                'indice_depart' => $indice_depart,

                'taille' => $taille,

                'type' => 'url',

                'affichage' => $affichage,

                'lien' => $lien,

            );



            $tab[] = $donnees;

        }

    }



    // Les médias (images ou autres)

    if (isset($entities["media"]) && sizeof($entities["media"])>0) {





        $medias = $entities["media"];

        $t = 0;

            foreach ($medias as $media) {

                $t++;

                $nb = 0;

            foreach ($media["indices"] as $indice) {

                $nb++;

                if ($nb == 1) {

                    $indice_depart = $indice;

                }

                else {

                    $taille = $indice - $indice_depart;

                }

            }



            $lien = $media["expanded_url"];

            $affichage = $media["display_url"];

            $src = $media["media_url_https"];

            $donnees = array(

                'indice_depart' => $indice_depart,

                'taille' => $taille,

                'type' => 'media',

                'affichage' => $affichage,

                'lien' => $lien,

                'src' => $src,

            );



            $tab[] = $donnees;

        }

    }



    // on a récupéré tous les éléments

    return $tab;

}





// On remets les entities dans l'ordre pour pouvoir les remplacer convenablement

function d_ordonner_tableau($tab) {

    $tab_trie = array();



    $dernier_index_ajoute = -1;



    // Tant qu'on a pas tout trié

    while (sizeof($tab_trie) != sizeof($tab)){



        $index_plus_petit = 999999;

        $nb_entree = -1;

        $entree_a_ajouter = -1;



        // On parcourt le tableau pour chercher la prochaine entrée à ajouter au tableau trié

        foreach ($tab as $entree) {

            $nb_entree++;



            // Si c'est le plus petit parmis ceux déjà parcourru

            if ($entree['indice_depart'] < $index_plus_petit && $entree['indice_depart']>$dernier_index_ajoute) {

                $index_plus_petit = $entree['indice_depart'];

                $entree_a_ajouter = $nb_entree;

            }

        }



        if ($entree_a_ajouter > -1) {

            $tab_trie[] = $tab[$entree_a_ajouter];

            $dernier_index_ajoute = $index_plus_petit;

        }

    }



    return $tab_trie;

}



// On construit le tweet grâce aux entities

function d_construire_tweet($texte, $tab, $data) {

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

    }


    $newtexte = str_replace("J'ai ???? la vidéo", "J'ai aimé la vidéo", $newtexte);
    $newtexte = str_replace("J'ai 👍 la vidéo", "J'ai aimé la vidéo", $newtexte);
    return $newtexte;

}

