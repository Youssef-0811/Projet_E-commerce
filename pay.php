<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="commerce, achat, produite">
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
<header>
    <div class="container">
        <nav>
            <H2 class="LOGO">Clock Tower.com</H2>
            <ul>
                <li><a href="accueil.php">Accueil</a></li>
                <li><a href="Produits.php">Nos Produits</a></li>
                <li><a href="#">Actualités</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="panier.php" class="fa fa-shopping-cart"> </a></li>
                <li class="user-menu">
                    <?php
                    // Start the session to access session variables
                    session_start();

                    // Check if the user is logged in
                    if (isset($_SESSION['user_name'])) {
                        echo "<div class='user-info'>";
                        echo "<img src='img/user_icon.png' alt='User Icon'>"; // Replace 'user_icon.png' with the actual path to your user icon
                        echo "<div class='user-dropdown'>";
                        echo "<span>" . $_SESSION['user_name'] . "</span>";
                        echo "<div class='dropdown-content'>";
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

<body>
    <div class="payment-container">
        <h2>Payment Simulation</h2>
        <form action="process_payment.php" method="post">
            <label for="card_number">Card Number:</label>
            <input type="text" id="card_number" name="card_number" required>

            <label for="expiry_date">Expiry Date:</label>
            <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/YY" required>

            <label for="cvv">CVV:</label>
            <input type="text" id="cvv" name="cvv" required>

            <label for="holder_name">Name:</label>
            <input type="text" id="holder_name" name="holder_name" required>

            <label for="billing_address">Address:</label>
            <input type="text" id="billing_address" name="billing_address" required>

            <label for="zip_code">Zip Code:</label>
            <input type="text" id="zip_code" name="zip_code" required>

            <button type="submit">Submit Payment</button>
        </form>
    </div>
</body>

<footer>
    <!-- Contact Us Section -->
    <section class="contact">
        <div class="container">
            <h2>Contact Us</h2>
            <p>Have questions or feedback? Reach out to us!</p>

            <!-- Contact Form -->
            <form id="contact-form">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="message">Message:</label>
                <textarea id="message" name="message" required></textarea>

                <button type="submit">Send Message</button>
            </form>
        </div>
    </section>
</footer>

</html>