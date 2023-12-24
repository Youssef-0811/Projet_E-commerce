<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $user_name = $_POST['username'];
  $password = $_POST['password'];

  $host = "localhost";
  $username = "root";
  $db_password = ""; // Changed the variable name to avoid conflict
  $database = "register";

  $conn = new mysqli($host, $username, $db_password, $database);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $query = "SELECT * FROM form WHERE nom='$user_name' and password='$password'";
  $result = $conn->query($query);

  if ($result->num_rows == 1) {
    header("Location: Produits.html");
    exit();
  } else {
    // Set an error message
    $error_message = "Invalid Username or Password";
  }

  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="keywords" content="commerce , achat , produite">
  <meta name="author" content="Agrar">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


  <title>CLOCK</title>
  <link rel="stylesheet" href="Style.css">
</head>

<body class="B2">
  <header>
    <div class="container">
      <nav>
        <H2 class="LOGO">Clock Tower.com</H2>
        <ul>
          <li><a href="accueil.html">Accueil</a></li>
          <li><a href="Untitled-1.html">Nos Produits</a></li>
          <li><a href="#">Actualités</a></li>
          <li><a href="#" class="fa fa-shopping-cart"> panier</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <div class=login-container>
    <form class="login-form" method="post">
      <h2>Login</h2>
      <?php
      // Display the error message if it's set
      if (isset($error_message)) {
        echo "<p style='color: red;'>$error_message</p>";
      }
      ?>
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>
      <button type="submit">Login</button>
      <h3>You don't have an account?</h3>
      <a href="register.php">Register</a>
    </form>
  </div>
</body>

</html>