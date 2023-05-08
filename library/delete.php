<?php
$game = $_POST['game'];

$db = new mysqli('localhost', 'root', '', 'library');

$stmt = $db->prepare(
  <<<SQL
    INSERT INTO deleted
      (id, name, year, system, developer, user, exclusion)
    SELECT
      game.id,
      game.name,
      game.year,
      IFNULL(system.name, "[empty]"),
      game.developer,
      user.name,
      CURRENT_TIMESTAMP
    FROM game
    LEFT JOIN system ON game.system = system.id
    JOIN user ON game.user = user.id WHERE game.id = ?
  SQL
);
$stmt->bind_param('s', $game);
$stmt->execute();

$stmt = $db->prepare('DELETE FROM game WHERE id = ?');
$stmt->bind_param('s', $game);
$stmt->execute();

$db->close();

unlink($_POST['old']);

header('Location: /home.php');
exit;
