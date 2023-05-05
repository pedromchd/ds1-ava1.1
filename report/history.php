<?php
session_start();

$user = $_SESSION['user'];
$name = $_SESSION['name'];

if ($user !== 1 || $name !== 'admin') {
  header('Location: /home.php');
  exit;
}

$db = new mysqli('localhost', 'root', '', 'library');
$result = $db->query('SELECT * FROM deleted ORDER BY exclusion DESC');
$db->close();

require_once('../tcpdf/examples/tcpdf_include.php');

$pdf = new TCPDF('L');

$pdf->setTitle('Remove History');

$pdf->AddPage();

$html = <<<HTML
<style>
  table {
    border: 1px solid #4ade80;
  }
  th {
    border: 1px solid #4ade80;
    background-color: #86efac;
    font-weight: bold;
  }
  td {
    border: 1px solid #4ade80;
    background-color: #bbf7d0;
  }
</style>

<table cellpadding="5">
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Year</th>
    <th>System</th>
    <th>Developer</th>
    <th>User</th>
    <th>Exclusion</th>
  </tr>
HTML;

while ($row = $result->fetch_assoc()) {
  $html .= <<<HTML
  <tr>
    <td>$row[id]</td>
    <td>$row[name]</td>
    <td>$row[year]</td>
    <td>$row[system]</td>
    <td>$row[developer]</td>
    <td>$row[user]</td>
    <td>$row[exclusion]</td>
  </tr>
  HTML;
}

$pdf->writeHTML($html . '</table>');

$pdf->Output('history.pdf');
exit;
