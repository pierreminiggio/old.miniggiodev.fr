<?php include './chat.inc.php'; ?>
                      J'ai commencé à produire du contenu vidéo dans les débuts de Youtube comme un moyen d'échanger des informations (à l'époque pour pouvoir montrer et échanger en ligne des cartes Yu-Gi-Oh!). Puis j'ai développé une passion pour le montage vidéo que j'ai principalement mis au service de mes vidéos personnelles mais également pour d'autres personnes.
<?php include './chat2.inc.php'; ?>
<div class="row">
  <div class="col s12 m12 ml2">
    <h3 class="hide-on-large-only">Quelques vidéos :</h3>
    <h3 class="hide-on-med-and-down">Quelques-unes de mes vidéos :</h3>
  </div>
</div>
<div class="row">
    <div class="col s12 m6 l4">
      <div class="video-container">
          <iframe width="853" height="480" src="//www.youtube.com/embed/fK9ZE7fX5Pk?rel=0" frameborder="0" allowfullscreen></iframe>
      </div>
        <div>
            Une des vidéos que j'ai produite après avoir composé une musique.
        </div>
    </div>

    <div class="col s12 m6 l4">
      <div class="video-container">
          <iframe width="853" height="480" src="//www.youtube.com/embed/x8syBluG7y4?rel=0" frameborder="0" allowfullscreen></iframe>
      </div>
        <div>
            Un montage d'extraits de parties de joueurs du groupe facebook nommé <a href="https://www.facebook.com/groups/YumiiYouMonte/" target="blank">League Of Legends FR YYM</a> pour créer une espèce de "mémoire" commune sous la forme d'une vidéo.
        </div>
    </div>

    <div class="col s12 m6 l4">
      <div class="video-container">
          <iframe width="853" height="480" src="//www.youtube.com/embed/PWjj4Ad1E_Y?rel=0" frameborder="0" allowfullscreen></iframe>
      </div>
      <div>
          <a href="https://www.twitch.tv/nicodock" target="blank">NicoDock</a> est un streamer et avait besoin d'aide pour faire le montage vidéo d'un tutoriel, je me suis donc positionné pour le faire.
      </div>
    </div>
</div>
<h3>Pour découvrir d'autres de mes projets vidéos, vous pouvez</h3>
<h3><a href="https://www.youtube.com/catoonthecat" target="_blank" class="btn">consulter ma chaine Youtube</a></h3>
<br><br><br>
<h3>Ou regarder mes dernières vidéos</h3>
<?php
//On initialise le CURL
$curl = curl_init();

//On paramètre le CURL
$url = 'https://www.youtube.com/feeds/videos.xml?user=catoonthecat';
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_FAILONERROR,1);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION,1);
curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
curl_setopt($curl, CURLOPT_TIMEOUT, 15);
//On exécute le CURL et on récupère un résultat JSON contenant l'access token et sa durée de validité
$string = curl_exec($curl);

//On termine le CURL
curl_close($curl);

if ($string != false) {
  echo '<div class="row">';
  $videos = new SimpleXMLElement($string);
  foreach ($videos->entry as $video) {
    echo '<div class="col s12 m6 l4">
    <br><br>
      <div class="video-container">
          <iframe width="853" height="480" src="//www.youtube.com/embed/'.substr($video->id, 9).'?rel=0" frameborder="0" allowfullscreen></iframe>
      </div>
    </div>';
  }
  echo '</div>';
}
?>

<br><br><br>

