<?php include './chat.inc.php'; ?>
Je suis Pierre Miniggio, actuellement Développeur Web à Toulouse. Je suis quelqu'un de curieux et qui aime apprendre un peu dans tous les domaines. Sur ce site vous pouvez trouver une partie de mes réalisations.<br>
<br><br><a href="docs/cv-Pierre-Miniggio.pdf" target="_blank" class="cv waves-effect waves-light fleche btn">Obtenir mon CV en document PDF</a><div><img src="images/feu.gif"></div>
<?php include './chat2.inc.php'; ?>

<div class="row res" id="contact">
    <div class="col s2 m2 l2 vraiment-trop-petit" id="texte-contact">
        <h6>
            <span class="hide-on-med-and-down">Me contacter :</span>
            <span class="hide-on-large-only">Contact<div class="trop-petit"> :</div></span>
        </h6>
    </div>
    <div class="chip col s3 m3 l3">
        <img src="images/mail.png" alt="mail" class="trop-petit">
        <a href="https://ggio.link/email">Mail<span class="hide-on-med-and-down">: pierre.miniggio@gmail.com</span></a>
    </div>
    <div class="chip col s3 m3 l3">
        <img src="images/linkedin.png" alt="linkedin" class="trop-petit">
        <a href="https://ggio.link/linkedin" target="blank">LinkedIn<span class="hide-on-med-and-down">: Pierre Miniggio</span></a>
    </div>
    <div class="chip col s3 m3 l3">
        <img src="images/facebook.png" alt="facebook" class="trop-petit">
        <a href="https://www.facebook.com/pierre.miniggio" target="blank">Facebook<span class="hide-on-med-and-down">: Pierre Miniggio</span></a>
    </div>
</div>

<div class="row">
    <div class="col s12 m10 offset-m1 l8 offset-l2">
<ul class="collapsible popout" data-collapsible="accordion">
  <li>
    <div class="collapsible-header<?=$contactactive?>">
        <span class="hide-on-large-only">F</span><span class="hide-on-med-and-down">Accéder au f</span>ormulaire de contact :
    </div>
      <div class="collapsible-body">
          <form action="contact.php" method="POST">

            <div class="row">

                <div class="input-field col s12 m6 l6">
                    <input id="nom" name="nom" type="text" class="validate" required>
                    <label for="last_name">Nom & Prénom *</label>
                </div>

                <div class="input-field col s12 m6 l6">
                    <input id="email" name="email" type="email" class="validate" required>
                    <label for="email">E-mail *</label>
                </div>

           </div>

           <div class="row">

                <div class="input-field col s12 m12 l12">
                    <input id="objet" name="objet" type="text" class="validate">
                    <label for="objet">Objet</label>
                </div>

           </div>

            <div class="row">

                <div class="input-field col s12 m12 l12">
                    <textarea id="message" name="message" class="materialize-textarea"></textarea>
                    <label for="message">Message *</label>
                </div>

                <input class="col s12 m6 offset-m3 l4 offset-l4 waves-effect waves-light fleche btn" type="submit" id="envoyer" name="Envoyer" value="Envoyer">

            </div>

        </form>
    </div>
  </li>
</ul>
        </div>
</div>

<div class="row">
    <div class="col s12 m12 l10 offset-l1">
<ul class="collapsible popout" data-collapsible="accordion">
  <li>
    <div class="collapsible-header active">
        Quelques-unes de mes compétences :
    </div>
      <div class="collapsible-body">

          <div class="row">
              <div class="col s12 m12 l12">
                  <h3 class="vouspouvezsurvoler">Développement Informatique</h3>
              </div>
          </div>

          <div class="row capacites">
              <div class="col s3 m2 l1">
                  <div class="empty">
                      <div class="fill cHtml"><?php include './set1.inc.php'; ?></div><span>HTML</span>
                  </div>
              </div>
              <div class="col s3 m2 l1">
                  <div class="empty">
                  <div class="fill cCss"><?php include './set1.inc.php'; ?></div><span>CSS</span>
                  </div>
              </div>
              <div class="col s3 m2 l1">
                  <div class="empty">
                  <div class="fill cPhp"><?php include './set1.inc.php'; ?></div><span>PHP</span>
                  </div>
              </div>
              <div class="col s3 m2 l1">
                  <div class="empty">
                  <div class="fill cMysql"><?php include './set1.inc.php'; ?></div><span>MySQL</span>
                  </div>
              </div>
              <div class="col s3 m2 l1">
                  <div class="empty">
                  <div class="fill cJs"><?php include './set1.inc.php'; ?></div><span>JS</span>
                  </div>
              </div>
              <div class="col s3 m2 l1">
                  <div class="empty">
                  <div class="fill cMaterialize"><?php include './set1.inc.php'; ?></div><span>Materialize</span>
                  </div>
              </div>
              <div class="col s3 m2 l1">
                  <div class="empty">
                  <div class="fill cBootstrap"><?php include './set1.inc.php'; ?></div><span>Bootstrap</span>
                  </div>
              </div>
              <div class="col s3 m2 l1">
                  <div class="empty">
                  <div class="fill cPython"><?php include './set2.inc.php'; ?></div><span>Python</span>
                  </div>
              </div>
              <div class="col s3 m2 l1">
                  <div class="empty">
                  <div class="fill cJava"><?php include './set1.inc.php'; ?></div><span>Java</span>
                  </div>
              </div>
              <div class="col s3 m2 l1">
                  <div class="empty">
                  <div class="fill cPaintdotnet"><?php include './set1.inc.php'; ?></div><span>Paint.NET</span>
                  </div>
              </div>
              <div class="col s3 m2 l1">
                  <div class="empty">
                  <div class="fill cPhotoshop"><?php include './set1.inc.php'; ?></div><span>Photoshop</span>
                  </div>
              </div>
              <div class="col s3 m2 l1">
                  <div class="empty">
                  <div class="fill cGestionProjet"><?php include './set2.inc.php'; ?></div><span>Gestion de projet</span>
                  </div>
              </div>
          </div>

          <div class="row">
              <div class="col s12 m12 l12">
                  <h3>Informatique et réseau</h3>
              </div>
          </div>
          <div class="row">
              <div class="col s12 m6 l4">
                  <img src="images/cisco.png" alt="Image manquante :'(" class="responsive-img">
              </div>
              <div class="col s12 m6 l8">
                  <p>Le PC que j'utilise actuellement pour vous écrire ces lignes est un PC que j'ai monté moi-même. J'ai eu l'occasion d'apprendre à configurer du matériel réseau cisco et j'ai des connaissances sur le fonctionnement d'un réseau informatique. Et j'ai configuré divers serveurs Web ou autres sur Windows et sur Linux pour mes applications et projets de cours.</p>
              </div>
          </div>

          <div class="row">
              <div class="col s12 m12 l12">
                  <h3>Anglais et communication</h3>
              </div>
          </div>
          <div class="row">
              <div class="col s12 hide-on-med-and-up">
                  <img src="images/english.png" alt="Image manquante :'(" class="responsive-img">
              </div>
              <div class="col s12 m6 l8">
                  <p>Cela fait maintenant plus de 6 ans que j'utilise l'anglais de manière quotidienne. J’ai acquis des compétences dans cette langue lors de mes activités personnelles qui m'ont conduites consulter des vidéos en anglais et à communiquer très régulièrement à l'oral et à l'écrit avec des anglophones de différentes nationalités.</p>
                    <p>A travers mes expériences durant lesquelles je me suis mis en avant (scène en tant que musicien, réalisation de tutoriels vidéo, ou en coaching 1 on 1 sur le jeu League Of Legends, etc.), j'ai gagné de l'aisance dans les situations de communication aussi bien en français qu'en anglais.</p>
              </div>
              <div class="col hide-on-small-only m6 l4">
                  <img src="images/english.png" alt="Image manquante :'(" class="responsive-img">
              </div>
          </div>
          <h3>Mes autres compétences sont listées sur mon CV</h3>
          <h3><a href="docs/cv-Pierre-Miniggio.pdf" target="_blank" class="cv waves-effect waves-light fleche btn">consulter mon CV</a></h3>


    </div>
  </li>
</ul>
        </div>
</div>
