<?php

header('Access-Control-Allow-Origin: *');

include '../utils.php';

function getMemo()
{
	$conn = Utils::connecter();
	$sql = 'SELECT content FROM `utils__memo` ORDER BY created_at DESC LIMIT 1';
	$result = Utils::querySQL($sql, $conn);
	$dbEntries = $result->fetchAll();
	Utils::deconnecter($conn);

	if (sizeof($dbEntries) == 1) {
		return $dbEntries[0]['content'];
	}
	return '';
}

echo getMemo();
?>
