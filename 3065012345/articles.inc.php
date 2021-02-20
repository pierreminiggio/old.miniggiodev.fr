<?php include '../script-recherche.inc.php'; ?>
<?php include '../bouton-recherche.inc.php'; ?>
<?php
echo '<table>';
echo '<tr><form action="editarticle.php" method="post">';
echo '<td><input type="hidden" name="creer" value="creer"></td>';
echo '<td><input type="text" name="titre" placeholder="titre"></td>';
echo '<td><textarea name="contenu" placeholder="contenu"></textarea></td>';
echo '<td><input type="text" name="date_actu" value="'.date('Y-m-d H:i:s', time()).'"></td>';
echo '<td><input type="number" name="statut" value="1" placeholder="0"></td>';
echo '<td colspan="2"><input type="submit" value="Créer" class="btn orange darken-2"></td>';
echo '</form></tr>';
echo'<tr><th>Id</th><th>titre</th><th>contenu</th><th>Date</th><th>Statut</th><th colspan="2">Actions</th></tr>';

include_once '../utils.php';
$conn = Utils::connecter();
$sql = 'SELECT * FROM actualites ORDER BY date_actu DESC';
$result = Utils::querySQL($sql, $conn);
foreach ($result-> fetchAll() as $a) {
    echo '<tr class="arechercher"><form action="editarticle.php" method="post">';
    echo '<td><input type="hidden" name="id_actu" value="'.$a['id_actu'].'">'.$a['id_actu'].'</td>';
    echo '<td><input type="text" name="titre" value="'.$a['titre'].'"></td>';
    echo '<td><textarea name="contenu">'.$a['contenu'].'</textarea></td>';
    echo '<td><input type="text" name="date_actu" value="'.$a['date_actu'].'"></td>';
    echo '<td><input type="number" name="statut" value="'.$a['statut'].'"></td>';
    echo '<td><input type="submit" value="Modifier" class="btn orange darken-2"></td></form>';
    echo '<td><form action="deletearticle.php" method="post"><input type="hidden" name="id_actu" value="'.$a['id_actu'].'"><input type="submit" value="Supprimer" class="btn red"></form></td>';
    echo '</tr>';
}
Utils::deconnecter($conn);
echo '</table>';
