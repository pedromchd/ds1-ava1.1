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
  <main class="flex-grow p-5 overflow-y-scroll">
    <section>
      <h2 class="mb-3 text-xl font-semibold">Are you sure to delete this entry below?</h2>
      <article>
        <table class="border border-green-300">
          <tr class="bg-green-200 border border-green-300 divide-x divide-green-300 text-center font-semibold">
            <td class="p-2">Cover</td>
            <td class="p-2">Name</td>
            <td class="p-2">Year</td>
            <td class="p-2">System</td>
            <td class="p-2">Developer</td>
          </tr>
          <tr class="border border-green-300 divide-x divide-green-300 text-center">
            <td><img src="/library/<?= $row['cover'] ?>" class="object-cover h-20 w-40" /></td>
            <td class="p-2"><?= $row['name'] ?></td>
            <td class="p-2"><?= $row['year'] ?></td>
            <td class="p-2"><?= $row['systemName'] ?></td>
            <td class="p-2"><?= $row['developer'] ?></td>
          </tr>
        </table>
      </article>
      <article class="mt-3 flex gap-3">
        <form action="/library/delete.php" method="post">
          <input type="hidden" name="old" value="<?= $row['cover'] ?>">
          <input type="hidden" name="game" value="<?= $row['id'] ?>">
          <input type="submit" value="Delete" class="px-5 py-1 bg-green-300 cursor-pointer hover:bg-green-400">
        </form>
        <a href="/home.php" class="text-center px-5 py-1 bg-green-300 hover:bg-green-400">Cancel</a>
      </article>
    </section>
  </main>
</body>

</html>
