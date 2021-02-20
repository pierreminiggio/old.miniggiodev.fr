<?php
$embeds = array();
    $embedYT = array(
        'delimiter1' => '[YT-',
        'delimiter2' => '-YT]',
        'html1' => '<div class="video-container"><iframe width="853" height="480" src="//www.youtube.com/embed/',
        'html2' => '?rel=0" frameborder="0" allowfullscreen></iframe></div>'

    );
    $embeds[] = $embedYT;
    $embedIMG = array(
        'delimiter1' => '[IMG-',
        'delimiter2' => '-IMG]',
        'html1' => '<img class="responsive-img" src="',
        'html2' => '" alt="Image de l\'article non disponible">'

    );
    $embeds[] = $embedIMG;
    foreach ($embeds as $embed) {
        $cut1 = explode($embed['delimiter1'], $a['contenu']);
        $tailleCut1 = sizeof($cut1);
        $avantCut1 = $cut1[0];

        if ($tailleCut1 > 1) {
            $contenu = $avantCut1;
            for ($i=1; $i<$tailleCut1; $i++) {
                $ctCut1 = $cut1[$i];
                $cut2 = explode($embed['delimiter2'], $ctCut1);
                $lienEmbed = $cut2[0];
                $apresCut2 = $cut2[1];
                $contenu = $contenu.$embed['html1'].$lienEmbed.$embed['html2'].$apresCut2;
            }
        }
    }
