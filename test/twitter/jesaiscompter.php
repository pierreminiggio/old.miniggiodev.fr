<?php
ini_set('display_errors', 1);
if( PHP_VERSION_ID < 50600 ){
    ini_set('mbstring.internal_encoding', 'UTF-8');
}else{
    ini_set('default_charset', 'UTF-8');
}
?>
<head>
    <meta charset="UTF-8">
    <title>Test api</title>
    <style>
    </style>
</head>

<body>
<h1>Je sais Compter</h1>
<?php

$mots = array("angle", "armoire", "banc", "bureau", "cabinet", "carreau", "chaise", "classe", "clé", "coin", "couloir", "dossier", "eau", "école", "écriture", "entrée", "escalier", "étagère", "étude", "extérieur", "fenêtre", "intérieur", "lavabo", "lecture", "lit", "marche", "matelas", "maternelle", "meuble", "mousse", "mur", "peluche", "placard", "plafond", "porte", "portemanteau", "poubelle", "radiateur", "rampe", "récréation", "rentrée", "rideau", "robinet", "salle", "savon", "serrure", "serviette", "siège", "sieste", "silence", "sol", "sommeil", "sonnette", "sortie", "table", "tableau", "tabouret", "tapis", "tiroir", "toilette", "vitre", "w.-c.", "crayon", "stylo", "feutre", "taille-crayon", "pointe", "mine", "gomme", "dessin", "coloriage", "rayure", "peinture", "pinceau", "couleur", "craie", "papier", "feuille", "cahier", "carnet", "carton", "ciseaux", "découpage", "pliage", "pli", "colle", "affaire", "boîte", "casier", "caisse", "trousse", "cartable", "jouet", "jeu", "pion", "dé", "domino", "puzzle", "cube", "perle", "chose", "forme", "carré", "rond", "pâte à modeler", "tampon", "livre", "histoire", "bibliothèque", "image", "album", "titre", "bande dessinée", "conte", "dictionnaire", "magazine", "catalogue", "page", "ligne", "mot", "enveloppe", "étiquette", "carte d’appel", "affiche", "alphabet", "appareil", "caméscope", "cassette", "cédé", "cédérom", "chaîne", "chanson", "chiffre", "contraire", "différence", "doigt", "écran", "écriture", "film", "fois", "idée", "instrument", "intrus", "lettre", "liste", "magnétoscope", "main", "micro", "modèle", "musique", "nom", "nombre", "orchestre", "ordinateur", "photo", "point", "poster", "pouce", "prénom", "question", "radio", "sens", "tambour", "télécommande", "téléphone", "télévision", "trait", "trompette", "voix", "xylophone", "zéro", "ami", "attention", "camarade", "colère", "copain", "coquin", "dame", "directeur", "directrice", "droit", "effort", "élève", "enfant", "fatigue", "faute", "fille", "garçon", "gardien", "madame", "maître", "maîtresse", "mensonge", "ordre", "personne", "retard", "sourire", "travail", "arrosoir", "assiette", "balle", "bateau", "boîte", "bouchon", "bouteille", "bulles", "canard", "casserole", "cuillère", "cuvette", "douche", "entonnoir", "gouttes", "litre", "moulin", "pluie", "poisson", "pont", "pot", "roue", "sac en plastique", "saladier", "seau", "tablier", "tasse", "trous", "verre", "à l’endroit", "à l’envers", "anorak", "arc", "bagage", "baguette", "barbe", "bonnet", "botte", "bouton", "bretelle", "cagoule", "casque", "casquette", "ceinture", "chapeau", "chaussette", "chausson", "chaussure", "chemise", "cigarette", "col", "collant", "couronne", "cravate", "culotte", "écharpe", "épée", "fée", "flèche", "fusil", "gant", "habit", "jean", "jupe", "lacet", "laine", "linge", "lunettes", "magicien", "magie", "maillot", "manche", "manteau", "mouchoir", "moufle", "nœud", "paire", "pantalon", "pied", "poche", "prince", "pull-over", "pyjama", "reine", "robe", "roi", "ruban", "semelle", "soldat", "sorcière", "tache", "taille", "talon", "tissu", "tricot", "uniforme", "valise", "veste", "vêtement", "aiguille", "ampoule", "avion", "bois", "bout", "bricolage", "bruit", "cabane", "carton", "clou", "colle", "crochet", "élastique", "ficelle", "fil", "marionnette", "marteau", "métal", "mètre", "morceau", "moteur", "objet", "outil", "peinture", "pinceau", "planche", "plâtre", "scie", "tournevis", "vis", "voiture", "véhicule", "accident", "aéroport", "auto", "camion", "engin", "feu", "frein", "fusée", "garage", "gare", "grue", "hélicoptère", "moto", "panne", "parking", "pilote", "pneu", "quai", "train", "virage", "vitesse", "voyage", "wagon", "zigzag", "acrobate", "arrêt", "arrière", "barre", "barreau", "bord", "bras", "cerceau", "chaises", "cheville", "chute", "cœur", "corde", "corps", "côté", "cou", "coude", "cuisse", "danger", "doigts", "dos", "échasses", "échelle", "épaule", "équipe", "escabeau", "fesse", "filet", "fond", "genou", "gymnastique", "hanche", "jambes", "jeu", "mains", "milieu", "montagne", "mur d’escalade", "muscle", "numéro", "ongle", "parcours", "pas", "passerelle", "pente", "peur", "pieds", "plongeoir", "poignet", "poing", "pont de singe", "poutre d’équilibre", "prises", "rivière des crocodiles", "roulade", "saut", "serpent", "sport", "suivant", "tête", "toboggan", "tour", "trampoline", "tunnel", "ventre", "bagarre", "balançoire", "ballon", "bande", "bicyclette", "bille", "cadenas", "cage à écureuil", "cerf-volant", "château", "coup", "cour", "course", "échasse", "flaque", "paix", "pardon", "partie", "pédale", "pelle", "pompe", "préau", "raquette", "rayon", "récréation", "sable", "sifflet", "signe", "tas", "tricycle", "tuyau", "vélo", "filet", "allumette", "anniversaire", "appétit", "beurre", "coquille", "crêpes", "croûte", "dessert", "envie", "faim", "fève", "four", "galette", "gâteau", "goût", "invitation", "langue", "lèvres", "liquide", "louche", "mie", "moitié", "moule", "odeur", "œuf", "part", "pâte", "pâtisserie", "recette", "rouleau", "sel", "soif", "tarte", "tranche", "yaourt", "glaçon", "jus", "kiwi", "lame", "mûre", "noyau", "paille", "pamplemousse", "râpe", "bassine", "cocotte", "épluchure", "légume", "pomme de terre", "rondelle", "soupe", "consommé", "potage", "arête", "frite", "gobelet", "jambon", "os", "poulet", "purée", "radis", "restaurant", "sole", "animal", "bébés", "bouche", "cage", "câlin", "caresse", "cochon d’Inde", "foin", "graines", "hamster", "lapin", "maison", "nez", "œil", "oreille", "patte", "toit", "yeux", "légume", "abeille", "agneau", "aile", "âne", "arbre", "bain", "barque", "bassin", "bébé", "bec", "bête", "bœuf", "botte de foin", "boue", "bouquet", "bourgeon", "branche", "caillou", "campagne", "car", "champ", "chariot", "chat", "cheminée", "cheval", "chèvre", "chien", "cochon", "colline", "coq", "coquelicot", "crapaud", "cygne", "départ", "dindon", "escargot", "étang", "ferme", "fermier", "feuille", "flamme", "fleur", "fontaine", "fumée", "grain", "graine", "grenouille", "griffe", "guêpe", "herbe", "hérisson", "insecte", "jardin", "mare", "marguerite", "miel", "morceau de pain", "mouche", "mouton", "oie", "oiseau", "pierre", "pigeon", "plante", "plume", "poney", "poule", "poussin", "prairie", "rat", "rivière", "route", "tortue", "tracteur", "tulipe", "vache", "vétérinaire", "aigle", "animaux", "aquarium", "bêtes", "cerf", "chouette", "cigogne", "crocodile", "dauphin", "éléphant", "girafe", "hibou", "hippopotame", "kangourou", "lion", "loup", "ours", "panda", "panthère", "perroquet", "phoque", "renard", "requin", "rhinocéros", "singe", "tigre", "zèbre", "zoo", "épingle", "bâton", "bêtise", "bonhomme", "bottes", "canne", "cauchemar", "cri", "danse", "déguisement", "dinosaure", "drapeau", "en argent", "en or", "en rang", "fête", "figure", "géant", "gens", "grand-mère", "grand-père", "joie", "joue", "journaux", "maquillage", "masque", "monsieur", "moustache", "ogre", "princesse", "rue", "trottoir", "Noël", "boule", "cadeau", "canne à pêche", "chance", "cube", "guirlande", "humeur", "papillon", "spectacle", "surprise", "trou", "visage", "âge", "an", "année", "après-midi", "calendrier", "début", "dimanche", "été", "étoile", "fin", "heure des mamans", "heure", "hiver", "horloge", "jeudi", "jour", "journée", "lumière", "lundi", "lune", "mardi", "matin", "mercredi", "midi", "minuit", "minute", "mois", "moment", "montre", "nuit", "ombre", "pendule", "retour", "réveil", "saison", "samedi", "semaine", "soir", "soleil", "temps", "univers", "vacances", "vendredi", "air", "arc-en-ciel", "brouillard", "ciel", "éclair", "flocon", "goutte", "hirondelle", "luge", "neige", "nuage", "orage", "ouragan", "parapluie", "parasol", "ski", "tempête", "thermomètre", "tonnerre", "traîneau", "vent", "assiette", "balai", "biscuit", "boisson", "bol", "bonbon", "céréale", "confiture", "coquetier", "couteau", "couvercle", "couvert", "cuillère", "cuisine", "cuisinière", "désordre", "dînette", "éponge", "évier", "four", "fourchette", "lait", "lave-linge", "lessive", "machine", "nappe", "pain", "pile", "plat", "plateau", "poêle", "réfrigérateur", "repas", "tartine", "torchon", "vaisselle", "argent", "aspirateur", "bague", "barrette", "bijou", "bracelet", "brosse", "cadre", "canapé", "chambre", "cheveu", "chiffon", "cil", "coffre", "coffret", "collier", "couette", "coussin", "couverture", "dent", "dentifrice", "drap", "fauteuil", "fer à repasser", "frange", "glace", "lampe", "lit", "ménage", "or", "oreiller", "parfum", "peigne", "pouf", "poupée", "poussette", "poussière", "shampoing", "sourcil", "trésor", "tube", "vase", "adulte", "album", "amour", "baiser", "bavoir", "biberon", "bisou", "caprice", "cimetière", "cousin", "cousine", "crèche", "fils", "frère", "grand-parent", "homme", "femme", "jumeau", "maman", "mari", "mariage", "mère", "papa", "parent", "père", "petit-enfant", "petit-fils", "petite-fille", "rasoir", "sœur", "ambulance", "bosse", "champignon", "dentiste", "docteur", "fièvre", "front", "gorge", "infirmier", "infirmière", "jambe", "larme", "médecin", "menton", "mine", "ordonnance", "pansement", "peau", "piqûre", "poison", "sang", "santé", "squelette", "trousse", "araignée", "brouette", "chenille", "coccinelle", "fourmi", "herbe", "jonquille", "lézard", "pâquerette", "rangée", "râteau", "rosé", "souris", "taupe", "terrain", "terre", "terrier", "tige", "ver", "portière", "sac", "billet", "caisse", "farce", "grimace", "grotte", "pays", "regard", "ticket", "bûche", "buisson", "camp", "chasseur", "châtaigne", "chemin", "chêne", "corbeau", "écorce", "écureuil", "forêt", "gourde", "lac", "loupe", "lutin", "marron", "mûre", "moustique", "muguet", "nid", "paysage", "pin", "rocher", "sapin", "sommet", "tente", "adresse", "appartement", "ascenseur", "balcon", "boucherie", "boulanger", "boulangerie", "boutique", "bus", "caniveau", "caravane", "carrefour", "cave", "charcuterie", "cinéma", "cirque", "clin d’œil", "cloche", "clocher", "clown", "coiffeur", "colis-route", "courrier", "croix", "église", "embouteillage", "endroit", "enveloppe", "essence", "facteur", "fleuriste", "foire", "hôpital", "hôtel", "immeuble", "incendie", "laisse", "magasin", "manège", "médicament", "moineau", "monde", "monument", "ouvrier", "palais", "panneau", "paquet", "parc", "passage", "pharmacie", "pharmacien", "piscine", "place", "police", "policier", "pompier", "poste", "promenade", "quartier", "square", "timbre", "travaux", "usine", "village", "ville", "voisin", "volet", "abricot", "ail", "aliment", "ananas", "banane", "bifteck", "café", "carotte", "cerise", "chocolat", "chou", "citron", "citrouille", "clémentine", "concombre", "coquillage", "corbeille", "crabe", "crevette", "endive", "farine", "fraise", "framboise", "fromage", "fruit", "gâteau", "haricot", "huile", "légume", "marchand", "melon", "monnaie", "navet", "noisette", "noix", "nourriture", "oignon", "orange", "panier", "pâtes", "pêche", "persil", "petit pois", "poire", "poireau", "pomme", "pomme de terre", "prix", "prune", "queue", "raisin", "riz", "salade", "sucre", "thé", "tomate", "viande", "vin", "baleine", "bouée", "île", "jumelles", "marin", "mer", "mouette", "navire", "pêcheur", "plage", "poisson", "port", "sardine", "serviette", "vague", "voile");

function str_plural($mot) {
    $suffixe = (substr($mot, -1) == 's' || substr($mot, -1) == 'x' || substr($mot, -1) == 'z') ? '' : 's'; // Par défaut S
    if (substr($mot, -3) == 'eau' || substr($mot, -2) == 'eu') { // Si eau -> eaux & eu -> eux
        $suffixe = 'x';
    }
    if (substr($mot, -2) == 'al') { // Si al -> aux
        $suffixe = 'ux';
        $mot = substr($mot, 0, -1);
    }
    return $mot.$suffixe; 
} 

$mot = str_plural($mots[array_rand($mots)]);


// Twitter
require_once('fonctions.php');

// BDD
require_once('utils.php');

// On check si le like est en bdd
$conn = Utils::connecter();

$sql = "SELECT count FROM count";

$result = Utils::querySQL($sql, $conn);

$counter = 0;

foreach ($result->fetchAll() as $a) {
    $counter = (int)$a['count'] + 1;
}

Utils::deconnecter($conn);

$conn = Utils::connecter();

$sql = "UPDATE count set count = ".$counter;

Utils::execSQL($sql, $conn);

Utils::deconnecter($conn);

// On poste sur Twitter
$status = $counter.' '.$mot;
updateStatus($status, array('settings' => 'countingSettings.php'));
echo '<br>Tweet posté : '.$status;

?>
<br>Import fini
</body>
<?php
exit();
