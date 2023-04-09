<?php
$name = $_POST['name'];
$year = $_POST['year'];
$system = $_POST['system'];
$developer = $_POST['developer'];
$gameID = $_POST['game_id'];

$db = new mysqli('localhost', 'root', '', 'library');
$stmt = $db->prepare('UPDATE game SET name = ?, year = ?, system = ?, developer = ? WHERE id = ?');
$stmt->bind_param('sssss', $name, $year, $system, $developer, $gameID);
$stmt->execute();

if (isset($_FILES['cover'])) {
  $cover = $_FILES['cover'];
  $path = 'uploads/' . uniqid() . "_$cover[name]";
  move_uploaded_file($cover['tmp_name'], $path);

  $stmt = $db->prepare('UPDATE game SET cover = ? WHERE id = ?');
  $stmt->bind_param('ss', $path, $gameID);
  $stmt->execute();
}

header('Location: index.php');
