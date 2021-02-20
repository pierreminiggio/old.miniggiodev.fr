<script>
    var goOut = 500;
    var goIn = 2000;
    var oldRecherche = '';
    var oldTag = '';
    var oldJeu = '';
    function rechercher() {
        var recherche = ($('#rechercher').val()).toLowerCase();
        if (recherche != oldRecherche) {
            $('.arechercher').each(function(index) {
                $(this).fadeOut(goOut);
            });
            $('.arechercher').each(function(index) {
                var contenu = ($(this).html()).toLowerCase();
                if (contenu.indexOf(recherche) >-1) {
                    $(this).slideDown(goIn);
                }
            });
            oldRecherche = recherche;
        }

    }
    function filterTags(tag) {
        if (tag != oldTag) {
            $('.arechercher').each(function(index) {
                $(this).fadeOut(goOut);
            });
            $('.arechercher').each(function(index) {
                var classes = $(this).attr('class');
                console.log(classes);
                if (classes.indexOf(tag) >-1) {
                    $(this).slideDown(goIn);
                }
            });
            oldTag = tag;
        }

    }
    function afficherJeu(jeu) {
        if (jeu != oldJeu) {
            $('.contenu-jeux').each(function(index) {
                $(this).fadeOut(goOut);
            });
            var ceJeu = '.contenu-'+jeu;
            $(ceJeu).each(function(index) {
                $(this).slideDown(goIn);
            });
            oldJeu = jeu;
        }
    }
</script>
