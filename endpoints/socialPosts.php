<?php
header('Content-Type: application/json');

include '../utils.php';

function getLastSocialPost () {

	$conn = Utils::connecter();
	$sql = 'SELECT * FROM `social__publication`
	WHERE relayed_on_fb is NULL
	ORDER BY `social__publication`.`date_publication` ASC
	LIMIT 1';
	$result = Utils::querySQL($sql, $conn);
	$dbEntries = $result->fetchAll();
	Utils::deconnecter($conn);

	if (sizeof($dbEntries) == 1) {
		$conn = Utils::connecter();
		$sql = 'UPDATE `social__publication`
		SET relayed_on_fb = NOW()
		WHERE id_post = '.$dbEntries[0]['id_post'].';';
		$result = Utils::execSQL($sql, $conn);
		Utils::deconnecter($conn);

		return json_encode(['id' => $dbEntries[0]['id_publication_source'], 'text' => $dbEntries[0]['texte_brut']]);
	}
	return '{}';
}

echo getLastSocialPost();
?>