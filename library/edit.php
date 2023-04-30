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
  $aux = $cover['name'];
  $ext = substr($aux, strrpos($aux, '.'));
  $path = 'uploads/' . uniqid() . $ext;
  move_uploaded_file($file, $path);
  $stmt = $db->prepare('UPDATE game SET cover = ? WHERE id = ?');
  $stmt->bind_param('ss', $path, $game);
  $stmt->execute();
  unlink($_POST['old']);
}

$db->close();

header('Location: /home.php');
exit;
