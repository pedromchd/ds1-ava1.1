<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Querty Library</title>
  <link rel="stylesheet" href="/css/styles.css">
  <link rel="icon" href="/img/joystick-32x32.png" type="image/x-icon">
</head>

<body class="bg-[url(/img/zeal.png)] bg-cover bg-right-bottom">
  <main class="h-screen grid grid-cols-2 grid-rows-3 place-items-center">
    <div class="border-2 [border-style:outset] outline-1 [outline-style:outset]">
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
            <p>Welcome to Querty Library!</p>
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
      <section class="p-0.5 min-w-[74rem] max-w-[74rem] min-h-[25rem] max-h-[25rem] bg-[#ccc] flex flex-col">
        <header class="px-1 bg-gradient-to-r from-[#009] to-[#09f] flex items-center justify-between">
          <div><img src="/img/joystick-16x16.png" alt=""></div>
          <h1 class="ml-1 font-mono text-white flex-grow"><?="$_SESSION[username]'s Library"?></h1>
          <div class="p-0.5 bg-[#ccc] border-2 [border-style:outset] outline-1 [outline-style:outset]">
            <svg width="10" height="10" viewBox="0 0 100 100">
              <path d="M 10 10 L 90 90" stroke="#000" stroke-width="20" stroke-linecap="round" />
              <path d="M 90 10 L 10 90" stroke="#000" stroke-width="20" stroke-linecap="round" />
            </svg>
          </div>
        </header>
        <div class="p-[1px] my-1 font-mono">
          <button class="bg-[#ccc] border-2 [border-style:outset] outline-1 [outline-style:outset]">
            <div class="w-32 py-1 px-2 flex items-center space-x-3">
              <img src="/img/devices-32x32.png" alt="">
              <p>Add new</p>
            </div>
          </button>
          <button class="bg-[#ccc] border-2 [border-style:outset] outline-1 [outline-style:outset]">
            <div class="w-32 py-1 px-2 flex items-center space-x-3">
              <img src="/img/write-32x32.png" alt="">
              <p>Edit</p>
            </div>
          </button>
          <button class="bg-[#ccc] border-2 [border-style:outset] outline-1 [outline-style:outset]">
            <div class="w-32 py-1 px-2 flex items-center space-x-3">
              <img src="/img/bin-32x32.png" alt="">
              <p>Delete</p>
            </div>
          </button>
        </div>
        <div class="bg-[#fff] flex-grow border-2 [border-style:inset] overflow-y-scroll">

        </div>
      </section>
    </div>
  </main>
</body>

</html>