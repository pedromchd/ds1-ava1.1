<?php
session_start();

$user = $_SESSION['user'];
$name = $_SESSION['name'];

if ($user !== 1 || $name !== 'admin') {
  header('Location: /home.php');
  exit;
}

$db = new mysqli('localhost', 'root', '', 'library');
$result = $db->query('SELECT game.*, IFNULL(system.name, "[empty]") AS systemName, user.name AS userName FROM game LEFT JOIN system ON game.system = system.id JOIN user ON game.user = user.id');
$db->close();

require_once('../tcpdf/tcpdf.php');

$pdf = new TCPDF('L');

$pdf->setTitle('Game Report');

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->AddPage();
