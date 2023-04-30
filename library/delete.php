<?php
$game = $_POST['game'];

$db = new mysqli('localhost', 'root', '', 'library');
$stmt = $db->prepare('SELECT game.*, system.name AS "system_name", user.name AS "user_name" FROM game JOIN system ON game.system = system.id JOIN user ON game.user = user.id WHERE game.id = ?');
$stmt->bind_param('s', $game);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$stmt = $db->prepare('DELETE FROM game WHERE id = ?');
$stmt->bind_param('s', $game);
$stmt->execute();
$db->close();

unlink($_POST['old']);

$file = 'delete_log.txt';
$content = "id=$row[id]&name=$row[name]&year=$row[year]&developer=$row[developer]&system=$row[system]_$row[system_name]&user=$row[user]_$row[user_name]" . PHP_EOL;
file_put_contents($file, $content, FILE_APPEND);

header('Location: /home.php');
exit;
