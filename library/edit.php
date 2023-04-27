<?php
$name = $_POST['name'];
$year = $_POST['year'];
$system = $_POST['system'];
$developer = $_POST['developer'];
$game = $_POST['game'];

$db = new mysqli('localhost', 'root', '', 'library');
$stmt = $db->prepare('UPDATE game SET name = ?, year = ?, system = ?, developer = ? WHERE id = ?');
$stmt->bind_param('sssss', $name, $year, $system, $developer, $game);
$stmt->execute();

$cover = $_FILES['cover'];
if ($file = $cover['tmp_name']) {
  $path = 'uploads/' . uniqid() . $cover['name'];
  move_uploaded_file($file, $path);
  $db->query("UPDATE game SET cover = $path WHERE id = $game");
}

$db->close();

header('Location: index.php');
exit;
