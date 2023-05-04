<?php
require('config.php');

$db = new mysqli('localhost', 'root', '', 'library');

if (isset($_POST['name'], $_POST['owner'], $_POST['system'])) {
  $name = $_POST['name'];
  $owner = $_POST['owner'];
  $system = $_POST['system'];

  $stmt = $db->prepare('UPDATE system SET name = ?, owner = ? WHERE id = ?');
  $stmt->bind_param('sss', $name, $owner, $system);
  $stmt->execute();

  header('Location: /system/view.php');
  exit;
}

$system = $_GET['system'];

$stmt = $db->prepare("SELECT * FROM system WHERE system.id = ?");
$stmt->bind_param('s', $system);
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
  <title>Edit</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-screen bg-green-100 flex">
  <header class="py-3 px-5 bg-green-300">
    <h1 class="mb-3 text-3xl font-bold">Querty Library</h1>
    <nav class="text-lg space-y-2">
      <ol class="border border-green-500 divide-y divide-green-500">
        <li class="bg-green-400 hover:bg-green-500"><a href="/home.php" class="p-2 block">View games</a></li>
        <li class="bg-green-400 hover:bg-green-500"><a href="/report/admin.php" target="blank" class="p-2 block">Game Report</a></li>
      </ol>
      <ol class="border border-orange-500 divide-y divide-orange-500">
        <li class="bg-orange-400 hover:bg-orange-500"><a href="/report/summary.php" target="blank" class="p-2 block">Report Summary</a></li>
        <li class="bg-orange-400 hover:bg-orange-500"><a href="/report/history.php" target="blank" class="p-2 block">Remove History</a></li>
      </ol>
      <ol class="border border-blue-500 divide-y divide-blue-500">
        <li class="bg-blue-400 hover:bg-blue-500"><a href="/system/view.php" class="p-2 block">View systems</a></li>
      </ol>
      <ol class="border border-red-500 divide-y divide-red-500">
        <li class="bg-red-400 hover:bg-red-500"><a href="/auth/logout.php" class="p-2 block">Logout</a></li>
      </ol>
    </nav>
  </header>
  <main class="flex-grow grid place-items-center">
    <form action="/system/edit.php" method="post">
      <fieldset class="w-[25rem] p-5 border-2 border-blue-800 grid gap-2">
        <legend class="px-1 text-xl text-blue-800 font-semibold">Edit</legend>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?= $row['name'] ?>" required class="px-1 py-0.5 border border-blue-500 focus:outline-blue-600">
        <label for="owner">Owner:</label>
        <input type="text" name="owner" id="owner" value="<?= $row['owner'] ?>" required class="px-1 py-0.5 border border-blue-500 focus:outline-blue-600">
        <input type="hidden" name="system" value="<?= $system ?>">
        <input type="submit" value="Edit" class="mt-2 py-1 bg-blue-300 cursor-pointer hover:bg-blue-400">
        <a href="/system/view.php" class="text-center py-1 bg-blue-300 hover:bg-blue-400">Cancel</a>
      </fieldset>
    </form>
  </main>
</body>

</html>