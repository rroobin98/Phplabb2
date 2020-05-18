<?php
// Startar sessionen igen och länkar nödvändiga variabler
session_start();
$userName = $_SESSION['userName'];
include_once("class-users.php");

// Loggar ut när man klickar på knappen.
$user = new Users;
if (isset($_POST['loggOut'])) {
  unset($_SESSION['userName']);
  $user->loggOut();
}

// Om man är inloggad visas detta
if (isset($userName)) {
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php echo $userName;?></title>
    <link rel="stylesheet" href="css/main.css">
  </head>
  <body>
    <nav>
      <form class="" action="loggedIn.php" method="post">
        <input id="loggOutButton" type="submit" name="loggOut" value="Logga ut">
      </form>
    </nav>
    <main>
      <h1>You are logged in</h1>
      <h2><?php echo $userName;?></h2>
    </main>
  </body>
</html>
<?php
}

// Annars visas detta. Så man inte kan komma till sidan utan att vara inloggad
else {
  ?>
  <body style="padding: 50px;
  margin: 0;
  background-color: #222;
  color: white;
  ">
    <h3>You are logged out</h3>
    <p>Your session has expired</p>
    <a style="color: #61ce6c; decoration: none;" href="index.php">Go to the homepage</a>
  </body>
  <?php
}
?>
