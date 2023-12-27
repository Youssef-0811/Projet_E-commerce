<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $user_name = $_POST['username'];
  $password = $_POST['password'];

  $host = "localhost";
  $username = "root";
  $db_password = "";
  $database = "register";

  $conn = new mysqli($host, $username, $db_password, $database);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $query = "SELECT * FROM form WHERE nom='$user_name' and password='$password'";
  $result = $conn->query($query);

  if ($result->num_rows == 1) {
    // Start the session
    session_start();

    // Set session variables
    $_SESSION['user_name'] = $user_name;

    header("Location: Produits.php");
    exit();
  } else {
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>CLOCK</title>
  <link rel="stylesheet" href="Style.css">

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      var logo = document.querySelector('.LOGO');
      var dropdownContent = document.querySelector('.dropdown-content');

      logo.addEventListener('mouseover', function(event) {
        var rect = logo.getBoundingClientRect();
        var x = rect.left + window.pageXOffset;
        var y = rect.bottom + window.pageYOffset + 5; // Adjusted position

        dropdownContent.style.left = x + 'px';
        dropdownContent.style.top = y + 'px';

        dropdownContent.classList.add('show');
      });

      logo.addEventListener('mouseout', function(event) {
        if (dropdownContent.classList.contains('show')) {
          dropdownContent.classList.remove('show');
        }
      });
    });
  </script>

</head>

<body class="B2">
  <header>
    <div class="container">

      <nav>
        <H2 class="LOGO">Clock Tower.com</H2>
        <ul>
          <li><a href="accueil.php">Accueil</a></li>
          <li><a href="Produits.php">Nos Produits</a></li>
          <li><a href="#">Actualités</a></li>
          <li><a href="panier.php" class="fa fa-shopping-cart"> </a></li>
          <li class="user-menu">
            <?php
            // Start the session to access session variables
            session_start();

            // Check if the user is logged in
            if (isset($_SESSION['user_name'])) {
              echo "<div class='user-info'>";
              echo "<img src='img/user_icon.jpg' alt='User Icon'>"; // Replace 'user_icon.png' with the actual path to your user icon
              echo "<div class='user-dropdown'>";
              echo "<span>" . $_SESSION['user_name'] . "</span>";
              echo "<div class='dropdown-content'>";
              echo "<a href='#'>Modify Information</a>";
              echo "<a href='logout.php'>Se déconnecter</a>";
              echo "</div>";
              echo "</div>";
              echo "</div>";
            } else {
              echo "<a href='login.php'>Se connecter</a>";
            }
            ?>
          </li>
        </ul>
      </nav>
    </div>
  </header>

  <div class=login-container>
    <form class="login-form" method="post">
      <h2>Login</h2>
      <?php
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