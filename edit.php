<?php
session_start();

$user = $_SESSION['user'];
$name = $_SESSION['name'];

$game = $_GET['game'];

$db = new mysqli('localhost', 'root', '', 'library');
$stmt = $db->prepare("SELECT * FROM game WHERE game.id = ?");
$stmt->bind_param('s', $game);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$result = $db->query("SELECT * FROM system");
$db->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <main>
    <fieldset>
      <legend>Edit</legend>
      <form action="/library/edit.php" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?= $row['name'] ?>" required>
        <label for="year">Year:</label>
        <input type="number" name="year" id="year" value="<?= $row['year'] ?>" required>
        <label for="system">System:</label>
        <select name="system" id="system" required>
          <option disabled>Select one</option>
          <?php
          while ($sys = $result->fetch_assoc()) {
            if ($sys['id'] == $row['system']) {
              echo "<option value=$sys[id] selected>$sys[name]</option>";
              continue;
            }
            echo "<option value=$sys[id]>$sys[name]</option>";
          }
          ?>
        </select>
        <label for="developer">Developer:</label>
        <input type="text" name="developer" id="developer" value="<?= $row['developer'] ?>" required>
        <label for="cover">Cover:</label>
        <input type="file" name="cover" id="cover">
        <input type="hidden" name="game" value="<?= $row['id'] ?>">
        <input type="submit" value="Submit">
      </form>
    </fieldset>
  </main>
</body>

</html>
