<?php include 'script-recherche.inc.php'; ?>

<style>



h2 {

    margin-top: 50px;

    font-weight: 1000;

}



.contenu-jeux {

    display: none;

    padding: 15px;

}



.jeux div {

    height: 50px;

    line-height: 50px;

    text-align: center;

    cursor: pointer;

    border: 1px #FFF solid;

}



@media screen and (min-width: 992px) {

    .lego-title, .poke-title, .mc-title {

        font-size: 2vw;

    }

    .ygo-title {

        font-size: 1.8vw;

    }

    .aoe-title {

        font-size: 1.6vw;

    }

    .lol-title {

        font-size: 1.4vw;

    }



    .contenu-jeux {

        padding: 30px;

    }

}





.lego-title {

    color: #FFF;

    background-color: #F4070D;

    text-shadow: #000000 2px 2px 2px, #000000 -2px 2px 2px, #000000 -2px -2px 2px, #000000 2px -2px 2px, #FFF81E 5px 5px 10px, #FFF81E -5px 5px 10px, #FFF81E -5px -5px 10px, #FFF81E 5px -5px 10px;

}



.aoe-title {

    background-color: #000;

    font-family: 'Fredericka the Great', cursive;

}



.aoe-title .gold-aoe {

    color: #735600;

    text-shadow: #FBD43D 1px 1px 2px, #FBD43D -1px 1px 2px, #FBD43D -1px -1px 2px, #FBD43D 1px -1px 2px, #FFED80 2px 2px 4px, #FFED80 -2px 2px 4px, #FFED80 -2px -2px 4px, #FFED80 2px -2px 4px, #FFFFFF 3px 3px 10px, #FFFFFF -3px 3px 10px, #FFFFFF -3px -3px 10px, #FFFFFF 3px -3px 10px;

}



.aoe-title .red-2 {

    color: #FE0102;

    text-shadow: #000000 1px 1px 2px, #000000 -1px 1px 2px, #000000 -1px -1px 2px, #000000 1px -1px 2px, #F95352 2px 2px 4px, #F95352 -2px 2px 4px, #F95352 -2px -2px 4px, #F95352 2px -2px 4px, #FFFFFF 3px 3px 10px, #FFFFFF -3px 3px 10px, #FFFFFF -3px -3px 10px, #FFFFFF 3px -3px 10px;

}



.poke-title {

    color: #FFCA06;

    text-shadow: #415FC1 2px 2px 3px, #415FC1 -2px 2px 3px, #415FC1 -2px -2px 3px, #415FC1 2px -2px 3px, #0D2242 -2px 2px 3px, #415FC1 2px 2px 3px, #415FC1 -2px 2px 3px, #415FC1 -2px -2px 3px, #415FC1 2px -2px 3px, #415FC1 2px 2px 3px, #415FC1 -2px 2px 3px, #415FC1 -2px -2px 3px, #415FC1 2px -2px 3px, #0D2242 -2px 2px 3px, #0D2242 -2px 2px 3px, #0D2242 -2px 2px 3px, #0D2242 -3px 3px 3px, #0D2242 -3px 3px 3px, #FFF81E 10px 10px 15px, #FFF81E -10px 10px 15px, #FFF81E -10px -10px 15px, #FFF81E 10px -10px 15px;

}

.ygo-title {

    background-color: #000;

    font-weight: 1;

    text-shadow: #EAF5FA -1px -1px 1px, #EAF5FA -1px 1px 1px, #E5DD82 2px 2px 3px, #E5DD82 -2px 2px 3px, #E5DD82 -2px -2px 3px, #E5DD82 2px -2px 3px, #E31F1D 10px 10px 15px, #E31F1D -10px 10px 15px, #E31F1D -10px -10px 15px, #E31F1D 10px -10px 15px, #E31F1D 10px 10px 15px, #E31F1D -10px 10px 15px, #E31F1D -10px -10px 15px, #E31F1D 10px -10px 15px, #E31F1D 10px 10px 15px, #E31F1D -10px 10px 15px, #E31F1D -10px -10px 15px, #E31F1D 10px -10px 15px, #E31F1D 10px 10px 15px, #E31F1D -10px 10px 15px, #E31F1D -10px -10px 15px, #E31F1D 10px -10px 15px, #E31F1D 10px 10px 15px, #E31F1D -10px 10px 15px, #E31F1D -10px -10px 15px, #E31F1D 10px -10px 15px, #E31F1D 10px 10px 15px, #E31F1D -10px 10px 15px, #E31F1D -10px -10px 15px, #E31F1D 10px -10px 15px;

}

.mc-title {

    color: #FAFAFB;

    background-color: #000;

    text-shadow: #000 1px 0px 1px, #747473 1px 2px 1px, #000 2px 0px 1px, #747473 2px 3px 1px, #AFAFB0 -1px -1px;



}

.lol-title {

    color: #FEF284;

    background-color: #000;

    font-family: 'Domine', serif;

    font-weight: 1;

    font-style: oblique;

    text-shadow: #B27D47 1px 1px 1px, #B27D47 -1px 1px 1px, #B27D47 -1px -1px 1px, #B27D47 1px -1px 1px, #000 2px 2px 1px, #000 -2px 2px 1px, #000 -2px -2px 1px, #000 2px -2px 1px, #79766F 3px 3px 4px, #79766F -3px 3px 4px, #79766F -3px -3px 4px, #79766F 3px -3px 4px, #67625F 5px 5px 5px, #67625F -5px 5px 5px, #67625F -5px -5px 5px, #67625F 5px -5px 5px, #5E4C38 10px 10px 10px, #5E4C38 -10px 10px 10px, #5E4C38 -10px -10px 10px, #5E4C38 10px -10px 10px;

}

</style>

<?php include './chat.inc.php'; ?>

Vous retrouverez bientôt ici toutes les infos concernant les jeux auquel j'ai joué!

<?php include './chat2.inc.php'; ?>

<div class="row jeux">

    <div class="col s6 m4 l2 lego-title" onclick="afficherJeu('lego')">Lego</div>

    <div class="col s6 m4 l2 aoe-title" onclick="afficherJeu('aoe')"><span class="hide-on-large-only" title="Age Of Empire II"><span class="gold-aoe">AOE</span> <span class="red-2">II</span></span><span class="hide-on-med-and-down"><span class="gold-aoe">Age Of Empire</span> <span class="red-2">II</span></span></div>

    <div class="col s6 m4 l2 poke-title" onclick="afficherJeu('poke')">Pokémon</div>

    <div class="col s6 m4 l2 ygo-title" onclick="afficherJeu('ygo')">Yu-Gi-Oh!</div>

    <div class="col s6 m4 l2 mc-title" onclick="afficherJeu('mc')">Minecraft</div>

    <div class="col s6 m4 l2 lol-title" onclick="afficherJeu('lol')"><span class="hide-on-large-only" title="League Of Legends">LOL</span><span class="hide-on-med-and-down">League Of Legends</span></div>

</div>

<div class="contenu-jeux contenu-lego">

    test lego

</div>

<div class="contenu-jeux contenu-aoe">

    test aoe

</div>

<div class="contenu-jeux contenu-poke">

    <h2>Pikachu!</h2>

    <p>La première fois que j'ai eu l'occasion de jouer à un jeu pokémon, c'était l'école primaire. Un ami m'avait prété sa Gameboy Color ainsi que le jeu Pokémon version Jaune.</p>

    <p>C'est la première console portable sur laquelle j'ai joué, et je me suis bien amusé à compléter l'aventure à l'aide d'un puissant Leviator!</p>

    <p>Un peu plus tard, j'ai ensuite joué aux versions Saphire, Or, Argent, Cristal, Bleu, Rouge, Emeraude, puis Diamant et Perles, Rouge feu, Rubie, puis le remake de Or.</p>

    <p>Ce que j'aimais principalement sur Pokémon c'était défier mes amis (et gagner ahah).</p>

    <p>Sans le vouloir j'ai également trouvé 2 Pokémons shiny : J'ai trouvé un Hoothoot sur la version Oren voulant entraîner mon wattouat. Maheureusement je lui ai mis un coup critique et je l'ai donc raté. Le deuxième shiny que j'ai trouvé et capturé était un Rosélia sur la version Rubie alors que je chassais un Latios.</p>

    <p>J'ai aussi joué un peu au jeu de carte mais pas beaucoup vu que personne n'y jouait autour de moi.</p>

</div>

<div class="contenu-jeux contenu-ygo">

    <h2>C'est l'heure du Du - Du - Du - Du - Du - Duel!</h2>

    <p>Quelques-uns de mes amis du village ont commencé à obtenir des cartes Yu-Gi-Oh! et ont voulu apprendre le jeu, ils m'y ont introduit pour que j'apprenne avec eux.</p>

    <p>On se contentait au début évidemment d'utiliser les cartes que l'on avait, mais on est tous parti au fur et à mesure à la quête de cartes que l'on recherchait pour obtenir un Deck qui correspond le mieux à notre personnalité.</p>



    <h2>Mes Decks!</h2>

    <p>J'ai eu du coup quelques Deck, mon premier deck a été un Deck demon-rocher, basé sur Gaia Sombre, Heros du mal. Puis j'ai ensuite construit un deck Bêtes Cristallines, un Morphtronique, un deck Coelacanthe OTK, et pour finir un deck basé sur la carte Crâne Sacré.</p>

    <p>Parmis ces decks, mon deck signature a été mon Deck Duplic Morph (mon deck Morphtronique).</p>

    <p>Le principe de ce deck est d'utiliser la capacité invasive des Morphtronique pour pouvoir invoquer de manière explosive plusieurs monstres Synchros et/ou XYZ</p>

    <p>Ce deck a été le deck que j'ai le plus joué en compétitif, et je l'ai joué jusqu'à à peu près le moment où le Deck Rescue Rabbit dominait les tournois.</p>



    <h2>Le jeu change!</h2>

    <p>Yu-Gi-Oh! comme beaucoup de jeux de cartes et tous les jeux en ligne, voit constemment de changements. Le jeu a évolué de tel sorte que les nouvelles cartes qui sortaient étaient toujours plus fortes que les anciennes et que les nouvelles cartes n'étaient pas utilisables dans les anciens Decks.</p>

    <p>Et très récemment, bien après que j'ai arrêté le jeu, de nouvelles règles sont apparus ce qui fait que beaucoup de vieux Decks ne sont pûrement et simplement plus possibles à jouer.</p>

    <p>je ne jouais pas à Yu-Gi-Oh! pour m'amuser à construire des nouveaux Decks toutes les quelques semaines. Même si la construction de Deck est quelque chose qui me passionnait vraiment, obtenir les cartes pour les mettre en application est loin d'être gratuit.</p>

    <p>Ce que je cherchais dans ce jeu, c'est l'esprit personnel du Deck, un peu comme dans l'anime : Chaque joueur a son Deck qui a un thème et qui évolue en fonction du temps.</p>

    <p>L'élément principal qui faisait que j'adorais le jeu s'est donc envolé, et j'ai décidé d'arrêter également.</p>

</div>

<div class="contenu-jeux contenu-mc">

    <h2>Inspiration</h2>

    <p>J'ai commencé Minecraft après qu'un ami d'enfance (Aurelien) m'ait introduit au jeu (oui encore!).</p>

    <p>J'ai tout de suite accroché à certaines mécaniques du jeu, notemment tout ce qu'on pouvait faire avec de la redstone (une forme d'électricité) et l'eau.</p>

    <p>Après avoir joué sur le serveur créatif de Aurelien pendant quelques temps, je bouge ensuite jouer sur le serveur survie d'un ami de lycée, Mathieu (Tigrounnet de son pseudo)</p>

    <p>Il se trouve que Mathieu était à l'époque en train d'apprendre le Java et s'est "légèrement" amusé à nous rendre le jeu plus complexe en augmentant la puissance des monstres (un Enderman qui envoie des boules de ghast c'est pas très rassurant!)</p>

    <p>Ce que j'ai le plus aimé dans minecraft, c'est de jouer en survie sur le jeu de base, sans modification, dans le but de construire des bases épiques mais tout en prenant le temps d'obtenir les ressources nécéssaires pour le faire.</p>

    <p>Ce style de jeu, appelé SMP Vanilla, a été beaucoup popularisé grâce au <a href="https://www.youtube.com/watch?v=HliGAyD6AlQ&list=PLlF9ssj6rf6wlwRWObcr9C46q0eJ-VH2p" target="_blank">serveur Mindcrack</a>, au <a href="https://www.youtube.com/watch?v=mzmW-fQ_rzQ&list=PL5F968FA0F2323D39" target="_blank">serveur Hermicraft</a> ou encore à la série <a href="https://www.youtube.com/watch?v=cYfLkJ5fkLk&list=PL642CE2E8ECA2C069" target="_blank">Life On Bogota de Zisteau</a></p>



    <h2>Hidden Craft</h2>

    <p>Voulant retourner sur un style de jeu le plus proche possible du SMP Vanilla, je décide donc de lancer Hidden Craft, un serveur minecraft.</p>

    <p>Ce serveur est très largement inspiré de Mindcrack :</p>

    <ul>

        <li>- Un petit groupe de copains</li>

        <li>- Qui s'ammusent à construire des bases épiques chacun dans leur coin.</li>

        <li>- Participent à des projets d'intérêt communs (comme des fermes à XP ou à loot), ou encore le spawn.</li>

        <li>- Se trollent gentiment entre eux (les pranks)</li>

        <li>- Documenté sur Youtube</li>

        <li>- Avec un changement de saison (changement de map), tous les 6 mois à 1 an.</li>

    </ul>

    <p>Donc oui, on avait presque tous des chaînes Youtube sur lesquels on documentait notre aventure commune sur le jeu. C'était vraiment excellent!</p>

    <p>Pour ma part, mon PC n'était malheureusement pas assez puissant pour filmer des vidéos de qualité, mais malgré ça ma chaîne Youtube a eu une croissance exponentielle du début de Hidden Craft jusqu'à la fin.</p>

    <p><a href="https://www.youtube.com/watch?v=INMOeE0CHBc&list=PLMzEhcF7dipBnD7b4hDsIPpvl9ytxWfE9" target="_blank">La saison 1 d'Hidden Craft</a></p>

    <p><a href="https://www.youtube.com/watch?v=3_jlX91e47I&list=PLMzEhcF7dipAtJa48VML-YrakWxchupWs" target="_blank">La saison 2 d'Hidden Craft</a></p>



    <h2>La fin :(</h2>

    <p>Il y a eu 2 petites saison 3 et 4 de quelques épisodes, mais l'âge d'or d'Hidden Craft s'est plus ou moins arrêté après la saison 2.</p>

    <p>Quelques soucis personnels + un burnout du jeu m'ont fait perdre l'envie de m'investir autant dans le projet (avant j'étais capable de passer 16h / jour à filmer, monter, et uploader ces épisodes, oui ce n'était pas sain!).</p>

    <p>D'autres amis et joueurs du serveur ont petit à petit perdu de l'intérêt pour le serveur et Minecraft de manière générales pour diverses raisons souvent personnelles ou d'un intérêt plus grand pour un autre jeu.</p>

    <p>On a donc mis fin au serveur après 2 belles années d'existence, et on a essayé quelques tentatives de renaissances pour les saison 3 et 4, mais beaucoup trop de choses avaient changé pour tout le monde entre temps...</p>





</div>

<div class="contenu-jeux contenu-lol">

    <h2>Le commencement...</h2>

    <p>League Of Legends et un jeu de stratégie compétitif de 5 joueurs contre 5.</p>

    <p>J'ai commencé LOL en octobre 2013 à force de me faire presque harceler (gentiment évidemment!) par mes amis qui voulaient que je les rejoigne dessus. J'ai tout de suite arroché au jeu et y ai investi corps et âme pendant les deux premières années de jeu pour progresser dessus.</p>





    <h2>La première saison de soloQ</h2>



    <h3>Les deux premiers mois...</h3>

    <p>Après être passé level 30, je commence en début 2014 les soloQ (pour obtenir un classement). Je finis par obtenir 6 victoires et 4 défaites. J'ai obtenu le grade Argent 5, à l'époque j'étais très content car tous mes amis qui avaient commencé le jeu avant moi étaient classés en Bronze.</p>



    <h3>Début des soloQ...</h3>

    <p>Peu de temps après, en spammant les games j'arrive assez rapidemment Argent 4, ça m'a vraiment motivé à continuer de beaucoup jouer pour continuer de progresser</p>

    <div class="video-container">

        <iframe width="853" height="480" src="//www.youtube.com/embed/fGBRTLhlzmU?rel=0" frameborder="0" allowfullscreen></iframe>

    </div>



    <h3>Trop de soloQ!</h3>

    <p>Un petit saut de presque 1 an dans le temps. J'ai continué de spammer des parties en jouant que quelques personnages, mais je progressais très peu vite. Sur la première saison j'ai joué un total de 1100 soloQ pour ne même pas obtenir le grade Or. J'ai terminé la saison Argent 1 et 2/0 dans ma promotion pour Or 5, donc à une partie de l'obtenir!</p>





    <h2>La deuxième saison de soloQ</h2>



    <h3>On y retourne!</h3>

    <p>Cette saison, j'étais vraiment motivé pour progresser, car j'avais bien plus de temps vu que mon projet principal sur Minecraft avait définitivement pris fin. J'ai redoublé d'efforts et je suis très rapidement sorti du grade Argent pour très vite rejoindre le Platine et atteindre tout aussi rapidemment les grades au dessus!</p>

    <p>J'ai rencontré en chemin un paquet de joueurs qui sont devenus des partenaires de jeu et des amis par la suite.</p>



    <h2>Après</h2>

    <h3>On réduit un peu la cadence</h3>

    <p>Les saisons suivante, je n'ai pas perdu d'intérêt pour la soloQ, mais j'étais tout simplement plus attiré par d'autres activités. Mon activité principale sur LOL a été durant les quelques dernières années principalement aider d'autres joueurs à progresser au jeu pour qu'ils atteignent leurs objectifs!</p>

</div>

<script>

    $('.contenu-lol').each(function(index) {

        $(this).slideDown(goIn);

    });

</script>

