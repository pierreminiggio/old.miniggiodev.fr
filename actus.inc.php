<?php include 'fb-share/script.inc.php'; ?>

<?php include 'tw-share/script.inc.php'; ?>

<?php include 'actu_style.inc.php'; ?>

<?php include 'chat.inc.php'; ?>

<p>J'ai toujours eu envie d'écrire une sorte de journal, au minimum pour me souvenir de ce que je fais.</p>

<p>Mais bon, ce qui est probable, c'est qu'il ne sera jamais alimenté quotidiennement. Donc il y a plus de chance que ce "Journal" devienne un "Moisnal" ou encore un "Ann...</p>

<p>Mouais, on va rester sur le nom "Journal"! Par contre sur cette page on peut également <span class="hide-on-med-and-down">mon flux Twitter</span><a href="javascript:void(0)" class="hide-on-large-only" onclick="articles('le-flux', 'les-articles')">mon flux Twitter</a> si vous voulez savoir les vidéos que je regarde on a daily basis.</p>

<?php include 'chat2.inc.php'; ?>



<script>

    function articles(afficher, masquer) {

        document.querySelector('style').textContent +=

    '@media screen and (max-width:992px) { #'+afficher+' { display: block; } #'+masquer+' { display: none; }}'

        // Autre methode non responsive

        //$('#'+afficher).css('display', 'block');

        //$('#'+masquer).css('display', 'none');

    }

</script>

<?php include 'script-recherche.inc.php'; ?>





<div class="row hide-on-large-only">

    <button id="btn-art" class="col s6 m4 offset-m1 btn orange darken-2" onclick="articles('les-articles', 'le-flux')">Articles</button>

    <button id="btn-tw" class="col s6 m4 offset-m2 btn blue ligthen-2" onclick="articles('le-flux', 'les-articles')">Flux Twitter</button>

</div>



<div class="row">

<div class="col s12 l8" id="les-articles">

<h2>Articles</h2>

<?php include 'bouton-recherche.inc.php'; ?>

<div class="row">

<div class="row col s12 l10 offset-l1 xl8 offset-xl2">

<?php include_once 'utils.php';

$conn = Utils::connecter();

$sql = 'SELECT titre FROM actualites WHERE statut = 1 ORDER BY date_actu DESC;';

$result = Utils::querySQL($sql, $conn);

$tags_array = array();

foreach ($result-> fetchAll() as $a) {

    // La liste des #tags

    $titretags = explode(']', $a['titre']);

    $tailletags = sizeof($titretags);

    if ($tailletags > 1) {

        for ($i=0; $i<$tailletags-1; $i++) {

            $tag = substr($titretags[$i],1);

            $estpresent = false;

            foreach($tags_array as $tagpresent) {

                if ($tag == $tagpresent) {

                    $estpresent = true;

                }

            }

            if (!$estpresent) {

                $tags_array[] = $tag;

            }

        }

    }

}

sort($tags_array);



// Les tableaux de classes dispo

$colors = array('red', 'pink', 'purple', 'deep-purple', 'indigo', 'blue', 'light-blue', 'cyan', 'teal', 'green', 'light-green', 'lime', 'yellow', 'amber', 'orange', 'deep-orange', 'brown', 'grey', 'blue-grey');

$colors_no_accent = array('brown', 'grey', 'blue-grey');

$lights = array('darken', 'lighten', 'accent');

$numbers = array(1, 2, 3, 4);

//$numbers_ligthen = array(1, 2, 3, 4, 5);



// Le tableau qui listera toutes les classes de chaque tag

$tags_classes = array();



// Les couleurs déjà pick

$picked_colors = array();



// C'est parti pour la lotterie!

foreach ($tags_array as $tag) {



    // On choisit la couleur random

    $picked_color = $colors[array_rand($colors)];

    if (sizeof($colors) > sizeof($picked_colors)) {

        $already_picked_color = true;

        while ($already_picked_color) {

            $already_picked_color = false;

            foreach ($picked_colors as $p_color) {

                if ($picked_color == $p_color) {

                    $already_picked_color = true;

                }

            }

            if ($already_picked_color) {

                $picked_color = $colors[array_rand($colors)];

            }

        }

    }

    else {

        $picked_colors = array();

    }

    $picked_colors[] = $picked_color;

    $can_be_accent = true;

    foreach ($colors_no_accent as $color) {

        if ($picked_color == $color) {

            $can_be_accent = false;

        }

    }



    // On choisit la lumière

    $picked_light = 'darken';

    /*$picked_light = $lights[array_rand($lights)];

    if (!$can_be_accent) {

        while ($picked_color == 'accent') {

            $picked_light = $lights[array_rand($lights)];

        }

    }*/



    /*if ($picked_light == 'lighten') {

        $picked_number = $numbers_ligthen[array_rand($numbers_ligthen)];

    }*/

    //else {

    $picked_number = $numbers[array_rand($numbers)];

    //}

    $tag_classes = $picked_color.' '.$picked_light.'-'.$picked_number;

    echo '<span class="col s4 m3 l2 new badge tagcursor '.$tag_classes.'" data-badge-caption="" title="'.$tag.'" onclick="filterTags(\''.$tag.'\')">#'.$tag.'</span>';

    $tag_class_list = array('tag' => $tag, 'tag_classes' => $tag_classes);

    $tags_classes[] = $tag_class_list;

}

Utils::deconnecter($conn); ?>

</div>

</div>



<?php include_once 'utils.php';

$conn = Utils::connecter();

$sql = 'SELECT * FROM actualites WHERE statut = 1 ORDER BY date_actu DESC;';

$result = Utils::querySQL($sql, $conn);

foreach ($result-> fetchAll() as $a) {



    // La date

    $timeajd = time();

    $timepubli = strtotime($a['date_actu']);

    $datepubli = date( 'd/m/Y à H:i:s', $timepubli);

    include_once 'datefx.inc.php';

    $ilya = dateDiff($timeajd, $timepubli);



    // Le titre et les #tags

    $titretags = explode(']', $a['titre']);

    $titre = $titretags[(sizeof($titretags)-1)];

    $tags = '';

    $classtags = '';

    $tailletags = sizeof($titretags);

    if ($tailletags > 1) {

        for ($i=0; $i<$tailletags-1; $i++) {

            $tag = substr($titretags[$i],1);

            foreach ($tags_classes as $tag_classes) {

                if($tag == $tag_classes['tag']) {

                    $tag_class_list = $tag_classes['tag_classes'];

                }

            }



            $tags = $tags.'<span class="new badge '.$tag_class_list.'" data-badge-caption="">#'.$tag.'</span>';

            $classtags = $classtags.' '.$tag;

        }

    }



    // Les contenu emmbed

    $contenu = $a['contenu'];

    include 'embeds.inc.php';



    echo'<div class="row arechercher'.$classtags.'">

        <div class="col s12 m12 l10 offset-l1">

            <div class="card-panel grey lighten-5 z-depth-1 hoverable">

                <div class="row valign-wrapper">

                    <div class="col s12">

                        <div class="row">

                            <div class="datepubli col s12 m6 left-align" title="Le '.$datepubli.'">';

                                echo 'Il y a ';

                                if ($ilya['day'] > 0) {

                                    if ($ilya['day'] > 365) {

                                        $annee = floor($ilya['day']/365);

                                        echo $annee.' an';

                                        if ($annee != 1) {

                                            echo 's';

                                        }

                                    }

                                    else if ($ilya['day'] > 30.4) {

                                        $mois = floor($ilya['day']/30.4);

                                        echo $mois.' mois';

                                    }

                                    else {

                                        echo $ilya['day'].' jour';

                                        if ($ilya['day'] != 1) {

                                            echo 's';

                                        }

                                    }

                                }

                                else if ($ilya['hour'] > 0) {

                                    echo $ilya['hour'].' heure';

                                    if ($ilya['hour'] != 1) {

                                        echo 's';

                                    }

                                }

                                else if ($ilya['minute'] > 0) {

                                    echo $ilya['minute'].' minute';

                                    if ($ilya['minute'] != 1) {

                                        echo 's';

                                    }

                                }

                                else if ($ilya['second'] > 0) {

                                    echo $ilya['second'].' seconde';

                                    if ($ilya['second'] != 1) {

                                        echo 's';

                                    }

                                }

                                echo '</div>';

                                echo '<div class="tags col s12 m6 left-align">';

                                echo $tags;

                                echo '</div>';

                                echo '</div>';

                                $actuLink = (
                                    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://'
                                ) . $_SERVER['HTTP_HOST'] . '/index.php?onglet=actu&id=' . $a['id_actu'] . '#publi';

                                echo '<h3><a class="lientitre" href="' . $actuLink . '">' . $titre . '</a></h3>

                                <div class="contenu-publi">' . $contenu . '</div><br><br>';

                                $lien_share_fb = $actuLink;
                                include 'actu_share.inc.php';

                       echo'</div>

                     </div>

                </div>

        </div>

    </div>';

}



Utils::deconnecter($conn);



?>

</div>

<div class="col s12 l4" id="le-flux">

<h2>Mon flux twitter</h2>

<p style="text-align : center">Sur mon twitter on trouve notamment mes likes Youtube.<br>Si vous voulez être au courant de ce que je regarde c'est un bon endroit pour voir ça!</p>

<?php include_once 'utils.php';

$conn = Utils::connecter();

$sql = 'SELECT * FROM social__publication ORDER BY date_publication DESC LIMIT 50;';

$result = Utils::querySQL($sql, $conn);

foreach ($result-> fetchAll() as $a) {

    $timeajd = time();

    $timepubli = strtotime($a['date_publication']);

    $datepubli = date( 'd/m/Y à H:i:s', $timepubli);

    include_once 'datefx.inc.php';

    $ilya = dateDiff($timeajd, $timepubli);

    echo'<div class="row">

        <div class="col s12 m10 offset-m1">

            <div class="card-panel grey lighten-5 z-depth-1 hoverable">

                <div class="row valign-wrapper">

                    <div class="col s12">

                        <span class="black-text">

                            <div class="datepubli" title="Le '.$datepubli.'">';

                                echo 'Il y a ';

                                if ($ilya['day'] > 0) {

                                    if ($ilya['day'] > 365) {

                                        $annee = floor($ilya['day']/365);

                                        echo $annee.' an';

                                        if ($annee != 1) {

                                            echo 's';

                                        }

                                    }

                                    else if ($ilya['day'] > 30.4) {

                                        $mois = floor($ilya['day']/30.4);

                                        echo $mois.' mois';

                                    }

                                    else {

                                        echo $ilya['day'].' jour';

                                        if ($ilya['day'] != 1) {

                                            echo 's';

                                        }

                                    }

                                }

                                else if ($ilya['hour'] > 0) {

                                    echo $ilya['hour'].' heure';

                                    if ($ilya['hour'] != 1) {

                                        echo 's';

                                    }

                                }

                                else if ($ilya['minute'] > 0) {

                                    echo $ilya['minute'].' minute';

                                    if ($ilya['minute'] != 1) {

                                        echo 's';

                                    }

                                }

                                else if ($ilya['second'] > 0) {

                                    echo $ilya['second'].' seconde';

                                    if ($ilya['second'] != 1) {

                                        echo 's';

                                    }

                                }

                                echo '</div>';

                                echo '<p style="text-align : center">';
                                
                                $a['texte_html'] = str_replace("J'ai aimé la vidéo", "J'ai 👍 la vidéo", str_replace("J'ai ???? la vidéo", "J'ai aimé la vidéo", $a['texte_html']));

                                echo $a['texte_html'];

                                echo '</p>

                                <div class="row">

                                    <a class="col s10 offset-s1 m6 offset-m3 l10 offset-l1 btn orange darken-2" href="https://twitter.com/global/status/'.$a['id_publication_source'].'" target="_blank">

                                        Voir le tweet

                                    </a>

                                </div>

                            </span>

                        </div>

                     </div>

                </div>

        </div>

    </div>';

}



Utils::deconnecter($conn);



?>





</div>

</div>

