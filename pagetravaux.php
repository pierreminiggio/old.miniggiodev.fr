<!DOCTYPE html>
<!-- La page bootstrap -->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Quelques projets de cours</title>
        <link rel="icon" type="image/png" href = "./images/bootstrap/bootstraplogo.png">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <style>
            
            /* Stylisation du nav et le passer au premier plan */
            nav {
                border-bottom: 1px #EEE solid;
                z-index: 20;
                width: 100vw;
            }
            
            .filter .nav-item {
                font-weight: bold;
                margin-right: 30px;
                font-size: 120%;
            }
            
            
            /* Masquer les classes matérialize que j'ai sur la page en important le footer du site */
            .hide-on-med-and-down {
                display: none;
            }
            
            
            /* Changement du style du footer */
            .pagefooter {
                background-color: #EEE;
            }
            
            footer ul li {
                list-style-type: none;
            }

            
            /* Styliser les filtres "Programmation" et "Informatique et réseaux" */
            .categ {
                text-align: center;
            }
            
            .categ li {
                list-style-type: none;
                display: inline-block;
                font-size: 200%;
                text-align: center;
                padding: 20px;
                border: 1px white solid;
                border-radius: 50%;
                background-color: #EEE;
            } 
            
            
            
            h2 {
                text-align: center;
                padding-top: 100px;
                padding-bottom: 50px;
            }
            
            .carousel {
                width: 50%;
                margin: auto;
                margin-top: 100px;
                margin-bottom: 100px;
            }

            
            /* Styliser les cards */
            .row>div {
                padding: 10px;
            }
            
            .card {
                text-align: center;
            }
            
            .card-header {
                font-weight: bold;
                font-size: 110%;
            }
            
            @media only screen and (min-width: 1200px) {
                .card-header {
                    font-size: 120%;
                }
            }
            
            .modal h3 {
                margin-top: 50px;
                text-align: center;
            }
            
            .modal h3 a {
                font-size: 150%;
            }
            
            .badge {
                margin-bottom: 20px;
                padding: 5px;
            }
            
            .breadcrumb {
                background-color: #FFF;
                padding: 0;
            }
            
            .breadcrumb-item + .breadcrumb-item {
                font-size: 150%;
                line-height: 29px;
                color: #000;
            }
            
        </style>
        <script>
            // supprimer la possibilité de selectionner le texte
            document.onselectstart = new Function ("return false");
                if(window.sidebar)
                {
                        document.onmousedown = false;
                        document.onclick = true;
                }
            
            $(window).scroll(function (event) {
                var scroll = $(window).scrollTop();
                if (scroll > 100) {
                   $("nav").css("position", "fixed");
                   $("nav").css("opacity", "0.9");
                }
                else {
                    $("nav").css("position", "absolute");
                    $("nav").css("opacity", "1");
                }
            });
            
            // Activation des carousels
            $('.carousel').carousel();
            
            
            
            
            // utiliser le clics sur les checkbox comme déclencheur d'affichage
            function filtrerThemes() {
                
                // les associations thèmes : contenus
                var tab = {
                    "#progcheck" : ".progcontent",
                    "#rtcheck" : ".rtcontent"
                };
                
                // parcours les différents thèmes
                for (var checkbox in tab) {
                    var content = tab[checkbox];
                    
                    // la checkbox est cochée
                    if ($(checkbox).prop("checked") == true) {
                        // on parcours tous les contenus de la catégorie
                        $(content).each(function( index, item ) {
                            // on attend
                            setTimeout(function(){
                                // on les affiche
                                $(item).fadeIn(500);
                        }, 500*index);
                        
                        });
                    }
                    // la checkbox n'est pas cochée
                    else {
                        // on parcourt tous les contenus de la catégorie
                        $(content).each(function( index, item ) {
                            // on attend
                            setTimeout(function(){
                                // on les masque
                                $(item).fadeOut(200);
                            }, 200*index);
                        
                        }); 
                    }
                }
            }
        </script>
    </head>
    <body>
     
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <!-- Le bouton sandwich -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link"  href="index.php?onglet=apps#pagetravaux"><- Retour aux applications</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php">Page d'accueil</a>
      </li>
    </ul>
    <ul class="navbar-nav filter">
        <li class="nav-item">
            <a class="nav-link" href="#apropos">A propos de cette page</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#projets">Quelques projets</a>
        </li>
    </ul>
  </div>
</nav>
        
<div class="container">
    <h2 class="display-3" id="apropos">Pourquoi cette page?</h2>
    <p>Cette page est le résultat d'un projet de cours durant lequel il a été demandé de mettre en application différents éléments du framework CSS/JS Bootstrap.</p>
    <p>J'ai construit les autres pages de mon site grâce à un autre framework ayant des fonctionnalités similaire à celui de Bootstrap, il s'agit de Materialize.</p>
    <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators2" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators2" data-slide-to="1"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
        <img class="d-block w-100" src="images/bootstrap/bootstrap.png" alt="First slide">
    </div>
    <div class="carousel-item">
        <img class="d-block w-100" src="images/bootstrap/materializecss.png" alt="Second slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators2" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators2" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
    <p>C'est pour cela que cette page du site a un "look" assez différent des autres pages. J'aurais pu très bien reproduire le même style et utiliser les mêmes couleurs mais pourquoi ne pas faire quelque chose de différent quitte à changer de framework?!</p>
    
    
    <h2 class="display-3" id="projets">Quelques projets de cours...</h2>
    <ul class="categ">
        <li>
            <label for="progcheck">Programmation</label> <input type="checkbox" checked id="progcheck" onclick="filtrerThemes()" onchange="filtrerThemes()">
        </li>
        <li>
            <label for="rtcheck">Informatique et réseaux</label> <input type="checkbox" checked id="rtcheck" onclick="filtrerThemes()" onchange="filtrerThemes()">
        </li>
    </ul>
        <div class="row">
            <div class="col-sm-12 col-lg-4 progcontent">
                <div class="card">
                    <div class="card-header">L'application des fournitures</div>
                    <img class="card-img-top" src="images/applipref.png" alt="img_applipref_manquante">
                    <div class="card-body">Une application développée pour la préfecture d'Avignon</div>
                    <div class="card-footer">Projet de fin de DUT<br><span class="badge badge-secondary">HTML/CSS/JS/PHP/MYSQL</span>
                    <!-- plus de détails -->
                    <br>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#fournitures">
                      En savoir plus...
                    </button>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-4 progcontent">
                <div class="card">
                    <div class="card-header">Le blog rtai</div>
                    <img class="card-img-top" src="images/projets/rtai.png" alt="img_rtai_manquante">
                    <div class="card-body">Le site blog représentant les étudiants de la formation rtai</div> 
                    <div class="card-footer">Projet tuteuré<br><span class="badge badge-secondary">HTML/CSS/JS/PHP/Wordpress</span>
                            <!-- plus de détails -->
                            <br><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#blogrtai">
  En savoir plus...
</button></div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-4 rtcontent">
                <div class="card">
                    <div class="card-header">Virtualisation Proxmox</div>
                    <img class="card-img-top" src="images/projets/proxmox.png" alt="img_proxmox_manquante">
                    <div class="card-body">Mise en place d'un hyperviseur gérant des machines virtuelles</div> 
                    <div class="card-footer">Projet tuteuré<br><span class="badge badge-secondary">Promox/Windows/Debian</span>
                            <!-- plus de détails -->
                            <br><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#proxmox">
  En savoir plus...
</button></div>
                </div>
            </div>
    </div>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
        <img class="d-block w-100" src="images/bootstrap/htmlcssjs.png" alt="First slide">
    </div>
    <div class="carousel-item">
        <img class="d-block w-100" src="images/bootstrap/phpmysql.png" alt="Second slide">
    </div>
    <div class="carousel-item">
        <img class="d-block w-100" src="images/bootstrap/java.png" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>

<!-- Modal pref -->
<div class="modal fade" id="fournitures" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#" class="close" data-dismiss="modal" aria-label="Close">Quelques projets...</a></li>
    <li class="breadcrumb-item active" aria-current="page">L'application des fournitures</li>
  </ol></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <?php include 'applipref.inc.php' ?>
      </div>
    </div>
  </div>
</div>

<!-- Modal blog -->
<div class="modal fade" id="blogrtai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#" class="close" data-dismiss="modal" aria-label="Close">Quelques projets...</a></li>
    <li class="breadcrumb-item active" aria-current="page">Le blog rtai</li>
  </ol>
</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <?php include 'blogrtai.inc.php' ?>
      </div>
    </div>
  </div>
</div>

<!-- Modal proxmox -->
<div class="modal fade" id="proxmox" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" class="close" data-dismiss="modal" aria-label="Close">Quelques projets...</a></li>
                <li class="breadcrumb-item active" aria-current="page">Virtualisation Proxmox</li>
            </ol>
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <?php include 'proxmox.inc.php' ?>
      </div>
    </div>
  </div>
</div>
<div class="pagefooter text-muted">
    <?php include './footer.inc.php'; ?>
</div>
    </body>
</html>
