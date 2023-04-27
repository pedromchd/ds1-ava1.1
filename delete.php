<?php
session_start();

$user = $_SESSION['user'];
$name = $_SESSION['name'];

$game = $_GET['game'];

$db = new mysqli('localhost', 'root', '', 'library');
$stmt = $db->prepare("SELECT game.*, system.name AS systemName FROM game JOIN system ON game.system = system.id WHERE game.id = ?");
$stmt->bind_param('s', $game);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$db->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <main>
    <section>
      <article>
        <table>
          <tr>
            <td>Cover</td>
            <td>Name</td>
            <td>Year</td>
            <td>System</td>
            <td>Developer</td>
          </tr>
          <tr>
            <td><?= $row['cover'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['year'] ?></td>
            <td><?= $row['systemName'] ?></td>
            <td><?= $row['developer'] ?></td>
          </tr>
        </table>
      </article>
      <article>
        <a href="/home.php">Cancel</a>
        <form action="/library/delete.php">
          <input type="hidden" name="game" value="<?= $row['id'] ?>">
          <input type="submit" value="Delete">
        </form>
      </article>
    </section>
  </main>
</body>

</html>
