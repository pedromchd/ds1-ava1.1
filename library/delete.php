<?php
$game = $_POST['game'];

$db = new mysqli('localhost', 'root', '', 'library');
$stmt = $db->prepare('DELETE FROM game WHERE id = ?');
$stmt->bind_param('s', $game);
$stmt->execute();
$db->close();

header('Location: /home.php');
