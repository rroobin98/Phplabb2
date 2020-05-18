<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Users {

  // Lägg till användare
  public function addUser($userName, $userPassword) {

    // Gör en koll om användaren finns, annars gör en ny fil
    if (file_exists ("users/$userName.csv")) {
      echo "<h3 class='message red'>This user already exist</h3>";
    }
    else {
      echo "<h3 class='message green'>You are registered</h3>";
      $fileHandle = fopen("users/$userName.csv", "w+");
      fwrite($fileHandle, "$userName,$userPassword");
      fclose($fileHandle);
    }

  }

  // Logga in
  public function login($userName, $userPassword) {

    // Kollar om användaren finns
    if (file_exists ("users/$userName.csv")) {

      $userFile = array_map('str_getcsv', file("users/$userName.csv"));

      // En funktion som kollar om lösenordet man loggar in med matchar det saltade lösenordet
      $isCorrect = password_verify($userPassword, $userFile[0][1]);

      // Kollar om lösenordet matchar och startar en session och skickar en till den inloggade sidan
      if ($userName == $userFile[0][0] && $isCorrect) {

        session_start();
        $_SESSION['userName'] = $userName;
        header("Location: loggedIn.php");
        exit();

      }
      else {
        echo "<h3 class='message red'>Felaktigt Password</h3>";
      }

    }
    else {
      echo "<h3 class='message red'>Felaktigt Username</h3>";
    }

  }

  // Logga ut functionen
  public function loggOut(){
    header("Location: index.php");
    exit();
  }

}


?>
