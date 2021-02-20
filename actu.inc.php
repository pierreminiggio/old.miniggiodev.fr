<?php include 'fb-share/script.inc.php'; ?>
<?php include 'tw-share/script.inc.php'; ?>
<?php include 'actu_style.inc.php'; ?>
<br><br>
<?php include_once 'utils.php';
$conn = Utils::connecter();
$sql = 'SELECT * FROM actualites WHERE statut = 1 AND id_actu = '.$_GET['id'].' ORDER BY date_actu DESC;';
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
    $tailletags = sizeof($titretags);
    if ($tailletags > 1) {
        for ($i=0; $i<$tailletags-1; $i++) {
            $tag = substr($titretags[$i],1);
            $tags = $tags.'<span class="new badge orange darken-1 tag" data-badge-caption="">#'.$tag.'</span>';
        }
    }

    // Les contenu emmbed
    $contenu = $a['contenu'];
    include 'embeds.inc.php';

    echo'<div class="row" id="publi">
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
                            echo '<h3>'.$titre.'</h3>
                            <div class="contenu-publi">'.$contenu.'</div><br><br>';
                            include 'actu_share.inc.php';
                   echo'</div>
                     </div>
                </div>
        </div>
    </div>';
}

Utils::deconnecter($conn);

?>
