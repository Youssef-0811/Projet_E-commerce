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
  <style>
    .clear-cart-btn {
      background-color: #f44336;
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
    }

    .clear-cart-btn:hover {
      background-color: #d32f2f;
    }
  </style>
  <style>
    .cart-item {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
    }

    .cart-item img {
      max-width: 50px;
      margin-right: 10px;
    }

    .cart-item-details {
      flex-grow: 1;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
  </style>





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
        <li><a href="#" class="fa fa-shopping-cart"> </a></li>
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
  <!-- Panier Section -->
  <section class="cart">
    <h2>Shopping Cart</h2>
    <div id="cartDetails">
      <div id="cart-list"></div>






      <!-- Modify the displayCartDetails function in your panier.php page -->
      <script>
        function displayCartDetails() {
          // Retrieve the cart items from localStorage
          var cartItems = JSON.parse(localStorage.getItem('cart')) || [];

          // Get the element where you want to display the cart details
          var cartListElement = document.getElementById('cart-list');

          // Clear the existing content
          cartListElement.innerHTML = '';

          // Check if the cart is not empty
          if (cartItems.length > 0) {
            // Loop through cart items and display details
            cartItems.forEach(function(item) {
              // Check if the price property exists before calling toFixed
              var priceDisplay = item.price ? +item.price.toFixed(2) : +'DH';

              // Create a list item for each product
              var listItem = document.createElement('li');
              listItem.innerHTML = `
                    <div class="cart-item">
                        <img src="${item.image}" alt="${item.name}" class="cart-item-image">
                        <p>${item.name}.         Price: ${priceDisplay}</p>
                        
                        
                    </div>
                    <button onclick="removeFromCart('${item.name}')">Remove</button>
                    <hr>
                `;

              // Append the list item to the cart list
              cartListElement.appendChild(listItem);
            });

            // Display the total price
            var totalPrice = cartItems.reduce(function(sum, item) {
              return sum + (item.price || 0); // Make sure to handle undefined or null values
            }, 0);
            var totalPriceDisplay = totalPrice ? 'DH' + totalPrice.toFixed(2) : '';
            cartListElement.innerHTML += `<p>Total Price: ${totalPrice} DH</p>`;
          } else {
            // Display a message if the cart is empty
            cartListElement.innerHTML = '<p>Your cart is empty</p>';
          }
        }

        function removeFromCart(productName) {
          // Retrieve the cart items from localStorage
          var cartItems = JSON.parse(localStorage.getItem('cart')) || [];

          // Find the index of the product with the given name in the cart
          var indexToRemove = -1;
          for (var i = 0; i < cartItems.length; i++) {
            if (cartItems[i].name === productName) {
              indexToRemove = i;
              break;
            }
          }

          // If the product is found in the cart
          if (indexToRemove !== -1) {
            // If there is more than one quantity, reduce the quantity
            if (cartItems[indexToRemove].quantity > 1) {
              cartItems[indexToRemove].quantity -= 1;
            } else {
              // If there is only one quantity, remove the entire item from the cart
              cartItems.splice(indexToRemove, 1);
            }

            // Update the cart items in localStorage
            localStorage.setItem('cart', JSON.stringify(cartItems));

            // Refresh the cart details on the page
            displayCartDetails();
          }
        }

        // Initial display of cart details when the page loads
        displayCartDetails();
      </script>






    </div>

    <button id="pay-button" class="pay-button">Proceed to Pay</button>
    <a href="Produits.php" class="back-to-products-link">Back to Products</a>


    <style>
      .back-to-products-link {
        background-color: #4CAF50;
        color: white;
        padding: 10px 15px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        margin-bottom: 10px;
        border-radius: 4px;
      }

      .back-to-products-link:hover {
        background-color: #45a049;
      }

      .pay-button {
        background-color: #008CBA;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
      }

      .pay-button:hover {
        background-color: #0077A3;
      }
    </style>
    <button onclick="clearCart()" class="clear-cart-btn">Clear Cart</button>

    <script>
      // Function to clear the cart
      function clearCart() {
        // Clear the cart in localStorage
        localStorage.removeItem('cart');

        // Refresh the cart details on the page
        displayCartDetails();
      }
    </script>
  </section>

  <!-- <script defer src="script.js"></script> -->

</header>
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