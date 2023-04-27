<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <main>
    <fieldset>
      <legend>Register</legend>
      <form action="/auth/register.php" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <label for="pass">Password:</label>
        <input type="password" name="pass" id="pass" required>
        <input type="submit" value="Submit">
      </form>
    </fieldset>
  </main>
</body>

</html>
