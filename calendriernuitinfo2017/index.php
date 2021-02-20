<?php
if (isset($_GET['hack'])) {
    $hack = true;
    $lien = "";
    $textelien = "Je suis patient";
}
else {
    $hack=false;
    $lien = "?hack=true";
    $textelien = "Je suis gourmand!";
}

?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>CALENDRIER</title>

        <link rel="stylesheet" href="style.css">
         <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">

  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
  <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

      <script>
          function loadeventdiv(idcase) {
             var ncase = 'case'+idcase;
             var div = document.getElementById("infos");
             div.style.display = "block";
             var div2 = document.getElementById("X");
             div2.style.display = "block";
             document.getElementById(ncase).style.opacity = "1";
             document.getElementById(ncase).style.border = "none";


         }

         function closeeventdiv() {
             var div = document.getElementById("infos");
             div.style.display = "none";
             var div2 = document.getElementById("X");
             div2.style.display = "none";
             document.getElementById('infos').innerHTML = "";
         }

         function impossibilite() {
             alert("Vous ne pouvez pas ouvrir cette case à cette date!");
         }

         function event1() {
             document.getElementById('infos').innerHTML = '<h2>La logique de Assassin\'s Creed...</h2><img src="img/1.png" class="responsive-img" width="50%" height="50%">';
             document.getElementById('case1').innerHTML = '<a href="#" onclick="loadeventdiv(1);event1()"><img src="img/logoAS.png" width="100" height="100"></a>';
         }

         function event2() {
             document.getElementById('infos').innerHTML = '<h2>It\'s fucking chocolate! Pig!</h2><video width="100%" heigh="100%" controls autoplay><source src="vid/2.mp4" type="video/mp4"></video>';
             document.getElementById('case2').innerHTML = '<a href="#" onclick="loadeventdiv(2);event2()"><img src="img/logoBeyond2.png" width="100" height="100"></a>';
         }

         function event3() {
             document.getElementById('infos').innerHTML = '<h2>Comme ouvrir ces cases...</h2><video width="100%" heigh="100%" controls autoplay><source src="vid/3.mp4" type="video/mp4"></video>';
             document.getElementById('case3').innerHTML = '<a href="#" onclick="loadeventdiv(3);event3()"><img src="img/logoFC3.png" width="100" height="100"></a>';
         }

         function event4() {
             var ncase = 4;
             document.getElementById('infos').innerHTML = '<h2>Oui</h2><img src="img/'+ncase+'.png" class="responsive-img" width=100% height=100%>';
             document.getElementById('case'+ncase).innerHTML = '<a href="#" onclick="loadeventdiv('+ncase+');event'+ncase+'()"><img src="img/logoU.png" width="100" height="100"></a>';
         }

         function event5() {
             var ncase = 5;
             document.getElementById('infos').innerHTML = '<h2>Comme ouvrir ces cases...</h2><video width="100%" heigh="100%" controls autoplay><source src="vid/'+ncase+'.mp4" type="video/mp4"></video>';
             document.getElementById('case'+ncase).innerHTML = '<a href="#" onclick="loadeventdiv('+ncase+');event'+ncase+'()"><img src="img/logoR6S.png" width="100" height="100"></a>';
         }

         function event6() {
             var ncase = 6;
             document.getElementById('infos').innerHTML = '<h2>Tu ne me vois pas!</h2><img src="img/'+ncase+'.png" class="responsive-img" width=100% height=100%>';
             document.getElementById('case'+ncase).innerHTML = '<a href="#" onclick="loadeventdiv('+ncase+');event'+ncase+'()"><img src="img/logoSC.png" width="100" height="100"></a>';
         }

         function event7() {
             var ncase = 7;
             document.getElementById('infos').innerHTML = '<h2>Pensez à eux!</h2><img src="img/'+ncase+'.png" class="responsive-img" width=50% height=50%>';
             document.getElementById('case'+ncase).innerHTML = '<a href="#" onclick="loadeventdiv('+ncase+');event'+ncase+'()"><img src="img/logoWD.png" width="100" height="100"></a>';
         }

         function event8() {
             var ncase = 8;
             document.getElementById('infos').innerHTML = '<h2>420 BLAZE IT</h2><img src="img/'+ncase+'.png" class="responsive-img" width=50% height=50%>';
             document.getElementById('case'+ncase).innerHTML = '<a href="#" onclick="loadeventdiv('+ncase+');event'+ncase+'()"><img src="img/logoSP.png" width="100" height="100"></a>';
         }

         function event9() {
             var ncase = 9;
             document.getElementById('infos').innerHTML = '<h2>Jouez maintenant!</h2><a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" target="blank"><img src="img/'+ncase+'.png" class="responsive-img" width=100% height=100%></a>';
             document.getElementById('case'+ncase).innerHTML = '<a href="#" onclick="loadeventdiv('+ncase+');event'+ncase+'()"><img src="img/logoTC.png" width="100" height="100"></a>';
         }

         function event10() {
             var ncase = 10;
             document.getElementById('infos').innerHTML = '<h2>les bras m\'en tombent!</h2><img src="img/'+ncase+'.png" class="responsive-img" width=50% height=50%>';
             document.getElementById('case'+ncase).innerHTML = '<a href="#" onclick="loadeventdiv('+ncase+');event'+ncase+'()"><img src="img/10.png" width="100" height="100"></a>';
         }

         function event11() {
             var ncase = 11;
             document.getElementById('infos').innerHTML = '<h2>BWAAAAAAAAAAAAAAH!</h2><img src="img/'+ncase+'.png" class="responsive-img" width=50% height=50%><audio src="audio/11.ogg" autoplay style:"display : none;">';
             document.getElementById('case'+ncase).innerHTML = '<a href="#" onclick="loadeventdiv('+ncase+');event'+ncase+'()"><img src="img/11.png" width="100" height="100"></a>';
         }

         function event12() {
             var ncase = 12;
             document.getElementById('infos').innerHTML = '<h2>BWAAAAAAAAAAAAAAH!</h2><img src="img/11.png" class="responsive-img" width=50% height=50%><audio src="audio/11.ogg" autoplay style:"display : none;">';
             document.getElementById('case'+ncase).innerHTML = '<a href="#" onclick="loadeventdiv('+ncase+');event'+ncase+'()"><img src="img/11.png" width="100" height="100"></a>';
         }

         function event13() {
             var ncase = 13;
             document.getElementById('infos').innerHTML = '<h2>BWAAAAAAAAAAAAAAH!</h2><img src="img/11.png" class="responsive-img" width=50% height=50%><audio src="audio/11.ogg" autoplay style:"display : none;">';
             document.getElementById('case'+ncase).innerHTML = '<a href="#" onclick="loadeventdiv('+ncase+');event'+ncase+'()"><img src="img/11.png" width="100" height="100"></a>';
         }

         function event14() {
             var ncase = 14;
             document.getElementById('infos').innerHTML = '<h2>BWAAAAAAAAAAAAAAH!</h2><img src="img/11.png" class="responsive-img" width=50% height=50%><audio src="audio/11.ogg" autoplay style:"display : none;">';
             document.getElementById('case'+ncase).innerHTML = '<a href="#" onclick="loadeventdiv('+ncase+');event'+ncase+'()"><img src="img/11.png" width="100" height="100"></a>';
         }

         function event15() {
             var ncase = 15;
             document.getElementById('infos').innerHTML = '<h2>BWAAAAAAAAAAAAAAH!</h2><img src="img/11.png" class="responsive-img" width=50% height=50%><audio src="audio/11.ogg" autoplay style:"display : none;">';
             document.getElementById('case'+ncase).innerHTML = '<a href="#" onclick="loadeventdiv('+ncase+');event'+ncase+'()"><img src="img/11.png" width="100" height="100"></a>';
         }

         function event16() {
             var ncase = 16;
             document.getElementById('infos').innerHTML = '<h2>BWAAAAAAAAAAAAAAH!</h2><img src="img/11.png" class="responsive-img" width=50% height=50%><audio src="audio/11.ogg" autoplay style:"display : none;">';
             document.getElementById('case'+ncase).innerHTML = '<a href="#" onclick="loadeventdiv('+ncase+');event'+ncase+'()"><img src="img/11.png" width="100" height="100"></a>';
         }

         function event17() {
             var ncase = 17;
             document.getElementById('infos').innerHTML = '<h2>BWAAAAAAAAAAAAAAH!</h2><img src="img/11.png" class="responsive-img" width=50% height=50%><audio src="audio/11.ogg" autoplay style:"display : none;">';
             document.getElementById('case'+ncase).innerHTML = '<a href="#" onclick="loadeventdiv('+ncase+');event'+ncase+'()"><img src="img/11.png" width="100" height="100"></a>';
         }

         function event18() {
             var ncase = 18;
             document.getElementById('infos').innerHTML = '<h2>BWAAAAAAAAAAAAAAH!</h2><img src="img/11.png" class="responsive-img" width=50% height=50%><audio src="audio/11.ogg" autoplay style:"display : none;">';
             document.getElementById('case'+ncase).innerHTML = '<a href="#" onclick="loadeventdiv('+ncase+');event'+ncase+'()"><img src="img/11.png" width="100" height="100"></a>';
         }

         function event19() {
             var ncase = 19;
             document.getElementById('infos').innerHTML = '<h2>BWAAAAAAAAAAAAAAH!</h2><img src="img/11.png" class="responsive-img" width=50% height=50%><audio src="audio/11.ogg" autoplay style:"display : none;">';
             document.getElementById('case'+ncase).innerHTML = '<a href="#" onclick="loadeventdiv('+ncase+');event'+ncase+'()"><img src="img/11.png" width="100" height="100"></a>';
         }

         function event20() {
             var ncase = 20;
             document.getElementById('infos').innerHTML = '<h2>BWAAAAAAAAAAAAAAH!</h2><img src="img/11.png" class="responsive-img" width=50% height=50%><audio src="audio/11.ogg" autoplay style:"display : none;">';
             document.getElementById('case'+ncase).innerHTML = '<a href="#" onclick="loadeventdiv('+ncase+');event'+ncase+'()"><img src="img/11.png" width="100" height="100"></a>';
         }

         function event21() {
             var ncase = 21;
             document.getElementById('infos').innerHTML = '<h2>BWAAAAAAAAAAAAAAH!</h2><img src="img/11.png" class="responsive-img" width=50% height=50%><audio src="audio/11.ogg" autoplay style:"display : none;">';
             document.getElementById('case'+ncase).innerHTML = '<a href="#" onclick="loadeventdiv('+ncase+');event'+ncase+'()"><img src="img/11.png" width="100" height="100"></a>';
         }

         function event22() {
             var ncase = 22;
             document.getElementById('infos').innerHTML = '<h2>BWAAAAAAAAAAAAAAH!</h2><img src="img/11.png" class="responsive-img" width=50% height=50%><audio src="audio/11.ogg" autoplay style:"display : none;">';
             document.getElementById('case'+ncase).innerHTML = '<a href="#" onclick="loadeventdiv('+ncase+');event'+ncase+'()"><img src="img/11.png" width="100" height="100"></a>';
         }

         function event23() {
             var ncase = 23;
             document.getElementById('infos').innerHTML = '<h2>BWAAAAAAAAAAAAAAH!</h2><img src="img/11.png" class="responsive-img" width=50% height=50%><audio src="audio/11.ogg" autoplay style:"display : none;">';
             document.getElementById('case'+ncase).innerHTML = '<a href="#" onclick="loadeventdiv('+ncase+');event'+ncase+'()"><img src="img/11.png" width="100" height="100"></a>';
         }

         function event24() {
             var ncase = 24;
             document.getElementById('infos').innerHTML = '<h2>NEVER GONNA GIVE YOU UP</h2><img src="img/24.png" class="responsive-img" width=50% height=50%><audio src="audio/24.mp3" autoplay style:"display : none;">';
             document.getElementById('case'+ncase).innerHTML = '<a href="#" onclick="loadeventdiv('+ncase+');event'+ncase+'()"><img src="img/24.png" width="100" height="100"></a>';
         }

         function event25() {
             var ncase = 25;
             document.getElementById('infos').innerHTML = '<a href="noel404.php" target="blank"><h2>Cliquez pour le sauver!</h2><img src="img/dessin.png" class="responsive-img" width=60% height=60%><audio src="audio/25.mp3" autoplay style:"display : none;"></a>';
             document.getElementById('case'+ncase).innerHTML = '<a href="#" onclick="loadeventdiv('+ncase+');event'+ncase+'()"><img src="img/logoNoel.png" width="100" height="100"></a>';
         }

      </script>
    </head>
    <body>
        <?php  include 'navbar.inc.php';  ?>
        <div class="row">
        <div class="calendrier col s12 m12 l12">
        <?php
        $aujourdhui = date("m-d-Y");
        $orderdate = explode('-', $aujourdhui);
$month = $orderdate[0];
$day   = $orderdate[1];
$year  = $orderdate[2];

        $classe_taille = '';
        $blanc_noir = '';
        for ($i = 1; $i < 26 ; $i++) {

            /* couleur des cases */
            if ($i == 4 || $i == 5 || $i == 12 || $i == 16 || $i == 20 || $i == 22 || $i == 23 || $i == 24) {
                $blanc_noir =" blanc";
            }

            else {
                $blanc_noir =" noir";
            }

            /* taille des cases */
            if ($i == 26 || $i<11) {
                $classe_taille = ' case1026';
            }
            else {
                $classe_taille = '';
            }
            $onclick = "";
            if ($hack == false) {
               if ($month == 12 || $month == 1) {
                if ($day >= $i) {
                    $onclick = 'loadeventdiv('.$i.');event'.$i.'()';
                }
                else {
                    $onclick = 'impossibilite()';
                }
            }
            else {
                    $onclick = 'impossibilite()';
                }

            }
            else {
                $onclick = 'loadeventdiv('.$i.');event'.$i.'()';
            }

            echo '<div id="case'.$i.'" class="case'.$blanc_noir.$classe_taille.'"><a href="#" onclick="'.$onclick.'">'.$i.'</a></div>';
        }
        ?>
            <div id="infos">

            </div>
            <div id="X">
                <a href="#" onclick="closeeventdiv()">X</a>
            </div>
        </div>
            </div>
            <p style="text-align: center">Bienvenue sur le calendrier de l'avent Ubisoft! Vous pouvez soit découvrir vos cadeaux chaque jour, soit si vous êtes gourmand vous pouvez tout débloquer d'un coup sans aucun scrupule!<br>Cherchez bien vos récompenses quotiennes qui sont cachées sur cette image!<br>PS : Désolé pour les éventuelles fautes d'orthographe il est 6h06.</p>;

        <footer class="page-footer">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">Calendrier de l'avent</h5>
                <p class="grey-text text-lighten-4">Ce calendrier de l'avent inspiré de l'univers Ubisoft a été réalisé dans le cadre de la nuit de l'info.</p>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Créateurs :</h5>
                <ul>
                    <li><a class="grey-text text-lighten-3" href="https://www.behance.net/RenardVentile" target="blank">Graphisme : Valentin Derre</a></li>
                    <li><a class="grey-text text-lighten-3" href="https://www.miniggiodev.fr" target="blank">Développement : Pierre Miniggio</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            2017
            </div>
          </div>
        </footer>
         <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
    </body>
</html>
