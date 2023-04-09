<?php
session_start();

$userID = $_SESSION['user_id'];
$uname = $_SESSION['username'];

$name = $year = $system = $developer = $user = '%';
$order = 'ASC';
if (isset($_GET['name'], $_GET['year'], $_GET['system'], $_GET['developer'], $_GET['user'], $_GET['order'])) {
  $name = "%$_GET[name]%";
  $year = "%$_GET[year]%";
  $system = "%$_GET[system]%";
  $developer = "%$_GET[developer]%";
  $user = "%$_GET[user]%";
  $order = "$_GET[order]";
}

$db = new mysqli('localhost', 'root', '', 'library');
$stmt = $db->prepare("SELECT game.*, user.name AS user FROM game JOIN user ON game.user = user.id WHERE game.name LIKE ? AND game.year LIKE ? AND game.system LIKE ? AND game.developer LIKE ? AND user.name LIKE ? ORDER BY game.year $order");
$stmt->bind_param('sssss', $name, $year, $system, $developer, $user);
$stmt->execute();

$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home - Querty Library</title>
  <link rel="stylesheet" href="/css/styles.css">
  <link rel="icon" href="/img/joystick-32x32.png" type="image/x-icon">
</head>

<body class="bg-[url(/img/zeal.png)] bg-cover bg-right-bottom">
  <main class="h-screen grid grid-cols-3 grid-rows-3 place-items-center">
    <div class="col-start-1 row-start-1 border-2 [border-style:outset] outline-1 [outline-style:outset]">
      <section class="p-0.5 w-[25rem] bg-[#ccc]">
        <header class="px-1 bg-gradient-to-r from-[#009] to-[#09f] flex items-center justify-between">
          <h1 class="font-mono text-white">Querty Library</h1>
          <button class="p-0.5 bg-[#ccc] border-2 [border-style:outset] outline-1 [outline-style:outset]">
            <svg width="10" height="10" viewBox="0 0 100 100">
              <path d="M 10 10 L 90 90" stroke="#000" stroke-width="20" stroke-linecap="round" />
              <path d="M 90 10 L 10 90" stroke="#000" stroke-width="20" stroke-linecap="round" />
            </svg>
          </button>
        </header>
        <div class="p-4 space-x-5 flex justify-between">
          <div><img src="/img/joystick-48x48.png" alt=""></div>
          <article class="flex-grow">
            <p>Welcome, <?= $uname ?>!</p>
          </article>
          <div class="space-y-3 font-mono">
            <a href="/auth/logout.php" class="block">
              <button class="w-20 bg-[#ccc] border-2 [border-style:outset] outline-1 [outline-style:outset]">
                Logout
              </button>
            </a>
          </div>
        </div>
      </section>
    </div>
    <div class="col-start-2 row-start-1 col-span-2 row-span-3 border-2 [border-style:outset] outline-1 [outline-style:outset]">
      <section class="p-0.5 min-w-[55rem] max-w-[55rem] min-h-[39rem] max-h-[39rem] bg-[#ccc] flex flex-col">
        <header class="px-1 bg-gradient-to-r from-[#009] to-[#09f] flex items-center justify-between">
          <div><img src="/img/joystick-16x16.png" alt=""></div>
          <h1 class="ml-1 font-mono text-white flex-grow"><?= "$uname's Library" ?></h1>
          <button class="p-0.5 bg-[#ccc] border-2 [border-style:outset] outline-1 [outline-style:outset]">
            <svg width="10" height="10" viewBox="0 0 100 100">
              <path d="M 10 10 L 90 90" stroke="#000" stroke-width="20" stroke-linecap="round" />
              <path d="M 90 10 L 10 90" stroke="#000" stroke-width="20" stroke-linecap="round" />
            </svg>
          </button>
        </header>
        <div class="p-[1px] my-1 font-mono">
          <a href="new_entry.php">
            <button class="bg-[#ccc] border-2 [border-style:outset] outline-1 [outline-style:outset]">
              <div class="w-32 py-1 px-2 flex items-center space-x-3">
                <img src="/img/devices-32x32.png" alt="">
                <p>Add new</p>
              </div>
            </button>
          </a>
          <button type="submit" form="alter" formaction="edit_entry.php" class="bg-[#ccc] border-2 [border-style:outset] outline-1 [outline-style:outset]">
            <div class="w-32 py-1 px-2 flex items-center space-x-3">
              <img src="/img/write-32x32.png" alt="">
              <p>Edit</p>
            </div>
          </button>
          <button type="submit" form="alter" formaction="delete_entry.php" class="bg-[#ccc] border-2 [border-style:outset] outline-1 [outline-style:outset]">
            <div class="w-32 py-1 px-2 flex items-center space-x-3">
              <img src="/img/bin-32x32.png" alt="">
              <p>Delete</p>
            </div>
          </button>
          <button class="bg-[#ccc] border-2 [border-style:outset] outline-1 [outline-style:outset]" onclick="document.querySelector('#count').classList.remove('hidden');">
            <div class="w-32 py-1 px-2 flex items-center space-x-3">
              <img src="/img/view-32x32.png" alt="">
              <p class="[line-height:1rem]">Games/ System</p>
            </div>
          </button>
          <div class="inline-block">
            <form id="alter" method="post"></form>
            <p>Found <?= $result->num_rows ?> entries.</p>
          </div>
        </div>
        <div class="bg-[#fff] flex-grow border-2 [border-style:inset] overflow-y-scroll">
          <table id="entries" class="w-[100%] border-separate relative">
            <tr class="sticky top-[2px]">
              <th>Cover</th>
              <th>Name</th>
              <th>Release Year</th>
              <th>System (Console)</th>
              <th>Developer</th>
              <th>User</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) : ?>
              <tr onclick="this.querySelector('input').checked = true">
                <td style="background-image: url(<?= $row['cover'] ?>);"></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['year'] ?></td>
                <td><?= $row['system'] ?></td>
                <td><?= $row['developer'] ?></td>
                <td><?= $row['user'] ?></td>
                <td class="hidden">
                  <input type="radio" form="alter" name="id" value="<?= $row['id'] ?>" required>
                </td>
              </tr>
            <?php endwhile; ?>
          </table>
        </div>
      </section>
    </div>
    <div class="col-start-1 row-start-2 row-span-2 border-2 [border-style:outset] outline-1 [outline-style:outset]">
      <section class="p-0.5 w-[25rem] bg-[#ccc]">
        <header class="px-1 bg-gradient-to-r from-[#009] to-[#09f] flex items-center justify-between">
          <div><img src="/img/search-16x16.png" alt=""></div>
          <h1 class="ml-1 font-mono text-white flex-grow">Search</h1>
          <button class="p-0.5 bg-[#ccc] border-2 [border-style:outset] outline-1 [outline-style:outset]">
            <svg width="10" height="10" viewBox="0 0 100 100">
              <path d="M 10 10 L 90 90" stroke="#000" stroke-width="20" stroke-linecap="round" />
              <path d="M 90 10 L 10 90" stroke="#000" stroke-width="20" stroke-linecap="round" />
            </svg>
          </button>
        </header>
        <div class="p-4 space-x-5 flex justify-between">
          <article class="flex-grow">
            <p>Search in all users' libraries.</p>
            <form name="search" id="search" action="admin.php" method="get" class="mt-3 space-y-3">
              <div class="flex justify-between">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="w-[70%] px-1 outline-1 [outline-style:inset]">
              </div>
              <div class="flex justify-between">
                <label for="year">Year:</label>
                <input type="number" name="year" id="year" class="w-[70%] px-1 outline-1 [outline-style:inset]">
              </div>
              <div class="flex justify-between">
                <p>Year order:</p>
                <div class="space-x-3">
                  <label for="asc">
                    <input type="radio" name="order" id="asc" value="ASC" checked>
                    Ascending
                  </label>
                  <label for="desc">
                    <input type="radio" name="order" id="desc" value="DESC">
                    Descending
                  </label>
                </div>
              </div>
              <div class="flex justify-between">
                <label for="system">System:</label>
                <input type="text" name="system" id="system" class="w-[70%] px-1 outline-1 [outline-style:inset]">
              </div>
              <div class="flex justify-between">
                <label for="developer">Developer:</label>
                <input type="text" name="developer" id="developer" class="w-[70%] px-1 outline-1 [outline-style:inset]">
              </div>
              <div class="flex justify-between">
                <label for="user">User:</label>
                <input type="text" name="user" id="user" class="w-[70%] px-1 outline-1 [outline-style:inset]">
              </div>
            </form>
            <div class="mt-4 space-x-1 text-right">
              <button form="search" class="w-20 bg-[#ccc] border-2 [border-style:outset] outline-1 [outline-style:outset]">
                Search
              </button>
              <a href="admin.php" class="inline-block">
                <button class="w-20 bg-[#ccc] border-2 [border-style:outset] outline-1 [outline-style:outset]">
                  Clear
                </button>
              </a>
            </div>
          </article>
        </div>
      </section>
    </div>
    <div id="count" class="hidden z-50 absolute border-2 [border-style:outset] outline-1 [outline-style:outset]">
      <section class="p-0.5 w-[30rem] max-h-[30rem] bg-[#ccc] flex flex-col">
        <header class="px-1 bg-gradient-to-r from-[#009] to-[#09f] flex items-center justify-between">
          <div><img src="/img/search_file-16x16.png" alt=""></div>
          <h1 class="ml-1 font-mono text-white flex-grow">Games per System</h1>
          <button class="p-0.5 bg-[#ccc] border-2 [border-style:outset] outline-1 [outline-style:outset]" onclick="document.querySelector('#count').classList.add('hidden');">
            <svg width="10" height="10" viewBox="0 0 100 100">
              <path d="M 10 10 L 90 90" stroke="#000" stroke-width="20" stroke-linecap="round" />
              <path d="M 90 10 L 10 90" stroke="#000" stroke-width="20" stroke-linecap="round" />
            </svg>
          </button>
        </header>
        <div class="bg-[#fff] flex-grow border-2 [border-style:inset] overflow-y-scroll">
          <table class="w-[100%] border-separate relative">
            <tr class="sticky top-[2px]">
              <th>System (Console)</th>
              <th>Games</th>
            </tr>
            <?php
            $stmt = $db->prepare('SELECT game.system, COUNT(game.name) AS games FROM game GROUP BY game.system');
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) : ?>
              <tr>
                <td><?= $row['system'] ?></td>
                <td><?= $row['games'] ?></td>
              </tr>
            <?php endwhile; ?>
          </table>
        </div>
      </section>
    </div>
  </main>
</body>

</html>