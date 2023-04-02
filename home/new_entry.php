<?php
session_start();

$uname = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Insert new - Querty Library</title>
  <link rel="stylesheet" href="/css/styles.css">
  <link rel="icon" href="/img/joystick-32x32.png" type="image/x-icon">
  <script src="new_entry.js" defer></script>
</head>

<body class="bg-[url(/img/zeal.png)] bg-cover bg-right-bottom">
  <main class="h-screen grid grid-cols-3 grid-rows-3 place-items-center">
    <div class="col-span-2 border-2 [border-style:outset] outline-1 [outline-style:outset]">
      <section class="p-0.5 min-w-[31rem] bg-[#ccc]">
        <header class="px-1 bg-gradient-to-r from-[#009] to-[#09f] flex items-center justify-between">
          <h1 class="font-mono text-white">Querty Library</h1>
          <div class="p-0.5 bg-[#ccc] border-2 [border-style:outset] outline-1 [outline-style:outset]">
            <svg width="10" height="10" viewBox="0 0 100 100">
              <path d="M 10 10 L 90 90" stroke="#000" stroke-width="20" stroke-linecap="round" />
              <path d="M 90 10 L 10 90" stroke="#000" stroke-width="20" stroke-linecap="round" />
            </svg>
          </div>
        </header>
        <div class="p-4 space-x-5 flex justify-between">
          <div><img src="/img/joystick-48x48.png" alt=""></div>
          <article class="flex-grow">
            <p>Welcome to Querty Library, <?= $uname ?>!</p>
            <p>Add, edit or delete your game records.</p>
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
    <div class="row-start-2 col-span-2 row-span-2 border-2 [border-style:outset] outline-1 [outline-style:outset]">
      <section class="p-0.5 min-w-[31rem] bg-[#ccc]">
        <header class="px-1 bg-gradient-to-r from-[#009] to-[#09f] flex items-center justify-between">
          <div><img src="/img/devices-16x16.png" alt=""></div>
          <h1 class="ml-1 font-mono text-white flex-grow">Add new entry</h1>
          <div class="p-0.5 bg-[#ccc] border-2 [border-style:outset] outline-1 [outline-style:outset]">
            <svg width="10" height="10" viewBox="0 0 100 100">
              <path d="M 10 10 L 90 90" stroke="#000" stroke-width="20" stroke-linecap="round" />
              <path d="M 90 10 L 10 90" stroke="#000" stroke-width="20" stroke-linecap="round" />
            </svg>
          </div>
        </header>
        <div class="p-4 space-x-5 flex justify-between">
          <article class="flex-grow">
            <p>Please fill in this form to add your game data.</p>
            <form name="newEntry" id="newEntry" action="insert_data.php" method="post" class="mt-3 space-y-3">
              <div class="flex justify-between">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="w-[70%] px-1 outline-1 [outline-style:inset]">
              </div>
              <div class="flex justify-between">
                <label for="year">Release year:</label>
                <input type="number" name="year" id="year" class="w-[70%] px-1 outline-1 [outline-style:inset]">
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
                <label for="cover">Cover:</label>
                <input type="file" name="cover" id="cover" class="w-[70%]">
              </div>
            </form>
          </article>
          <div class="space-y-3 font-mono flex flex-col">
            <p>Preview:</p>
            <div id="thumbnail" class="flex-grow border border-dashed border-black bg-[#fff]"></div>
            <div>
              <button form="newEntry" class=" w-20 bg-[#ccc] border-2 [border-style:outset] outline-1 [outline-style:outset]">
                Submit
              </button>
              <a href="index.php" class="">
                <button class="w-20 bg-[#ccc] border-2 [border-style:outset] outline-1 [outline-style:outset]">
                  Cancel
                </button>
              </a>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>
</body>

</html>