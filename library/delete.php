<?php
$game = $_POST['game'];

$db = new mysqli('localhost', 'root', '', 'library');

$stmt = $db->prepare('INSERT INTO deleted (id, name, year, system, developer, user) SELECT game.id, game.name, game.year, system.name, game.developer, user.name FROM game LEFT JOIN system ON game.system = system.id JOIN user ON game.user = user.id WHERE game.id = ?');
$stmt->bind_param('s', $game);
$stmt->execute();

$stmt = $db->prepare('DELETE FROM game WHERE id = ?');
$stmt->bind_param('s', $game);
$stmt->execute();

$db->close();

unlink($_POST['old']);

header('Location: /home.php');
exit;
