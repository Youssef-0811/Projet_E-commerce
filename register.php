<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "register";

$con = new mysqli($host, $username, $password, $database);

if ($con->connect_error) {
  die('Connection failed: ' . $con->connect_error);
}

session_start();

$error_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $user_name = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Check if the username already exists
  $check_query = "SELECT * FROM form WHERE nom=?";
  $check_stmt = $con->prepare($check_query);
  $check_stmt->bind_param("s", $user_name);
  $check_stmt->execute();
  $check_result = $check_stmt->get_result();

  if ($check_result->num_rows > 0) {
    // Username already exists
    $error_message = "The name \"$user_name\" already exists. Choose another one!";
  }
  $check_stmt->close();

  // Validate password requirements
  if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[^a-zA-Z0-9]/', $password)) {
    $error_message = "Password should be at least 8 characters long and contain at least one uppercase letter and one special character.";
  }

  // Check if there is an error message
  if (!empty($error_message)) {
    // Store the error message in a session variable
    $_SESSION['error_message'] = $error_message;
    header("Location: register.php"); // Redirect to the registration page
    exit();
  } else {
    // Use prepared statement to prevent SQL injection
    $query = "INSERT INTO form (nom, email, password) VALUES (?, ?, ?)";
    $stmt = $con->prepare($query);

    if ($stmt) {
      $stmt->bind_param("sss", $user_name, $email, $password);
      $stmt->execute();
      $stmt->close();

      //echo "<script type='text/javascript'> alert('Successfully Register.')</script>";
      header("Location: Produits.php");
      exit();
    } else {
      //echo "<script type='text/javascript'> alert('Enter Valid Informations.')</script>";
      $_SESSION['error_message'] = "An error occurred during registration. Please try again.";
      header("Location: register.php"); // Redirect to the registration page
      exit();
    }
  }
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
          <li><a href="Untitled-1.php">Nos Produits</a></li>
          <li><a href="#">Actualités</a></li>
          <li><a href="#" class="fa fa-shopping-cart"> </a></li>
        </ul>
      </nav>
    </div>
  </header>
  <div class="login-container">
    <form class="login-form" method="post">
      <h2>Register</h2>
      <?php
      if (isset($_SESSION['error_message'])) {
        echo "<p style='color: red; margin-top: 0;'>" . $_SESSION['error_message'] . "</p>";
        unset($_SESSION['error_message']);
      }
      ?>
      <label for="username">Username:</label>
      <input type="text" id="Register Username" name="username" required>
      <label for="email">Email:</label>
      <input type="email" id="Register email" name="email" required>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>
      <button type="submit">Register</button>
      <h4>back to login:</h4>
      <a href="login.php"> login</a>
    </form>
  </div>

</body>

</html>