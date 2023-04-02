<?php
$name = $_POST['name'];
$year = $_POST['year'];
$system = $_POST['system'];
$developer = $_POST['developer'];
$userID = $_POST['user_id'];
$cover = $_FILES['cover'];
$path = 'uploads/' . uniqid() . "_$cover[name]";
move_uploaded_file($cover['tmp_name'], $path);

$db = new mysqli('localhost', 'root', '', 'library');
$stmt = $db->prepare('INSERT INTO game (name, year, system, developer, cover, user) VALUES (?, ?, ?, ?, ?, ?)');
$stmt->bind_param('sssssi', $name, $year, $system, $developer, $path, $userID);
$stmt->execute();

header('Location: index.php');