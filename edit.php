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

<body class="h-screen bg-green-100 flex">
  <header class="py-3 px-5 bg-green-300">
    <h1 class="mb-3 text-3xl font-bold">Querty Library</h1>
    <nav class="bg-green-400 border border-green-500">
      <ol class="text-lg divide-y divide-green-500">
        <li class="hover:bg-green-500"><a href="/new.php" class="p-2 block">Add game</a></li>
        <li class="hover:bg-green-500"><a href="/auth/logout.php" class="p-2 block">Logout</a></li>
      </ol>
    </nav>
  </header>
  <main class="flex-grow grid place-items-center">
    <form action="/library/edit.php" method="post" enctype="multipart/form-data">
      <fieldset class="w-[25rem] p-5 border-2 border-green-800 grid gap-2">
        <legend class="px-1 text-xl text-green-800 font-semibold">Edit</legend>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?= $row['name'] ?>" required class="px-1 py-0.5 border border-green-500 focus:outline-green-600">
        <label for="year">Year:</label>
        <input type="number" name="year" id="year" value="<?= $row['year'] ?>" required class="px-1 py-0.5 border border-green-500 focus:outline-green-600">
        <label for="system">System:</label>
        <select name="system" id="system" required class="px-1 py-0.5 border border-green-500 focus:outline-green-600">
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
        <input type="text" name="developer" id="developer" value="<?= $row['developer'] ?>" required class="px-1 py-0.5 border border-green-500 focus:outline-green-600">
        <label for="cover">Cover:</label>
        <input type="file" name="cover" id="cover">
        <input type="hidden" name="old" value="<?= $row['cover'] ?>">
        <input type="hidden" name="game" value="<?= $game ?>">
        <input type="submit" value="Edit" class="mt-2 py-1 bg-green-300 cursor-pointer hover:bg-green-400">
        <a href="/home.php" class="text-center py-1 bg-green-300 hover:bg-green-400">Cancel</a>
      </fieldset>
    </form>
  </main>
</body>

</html>