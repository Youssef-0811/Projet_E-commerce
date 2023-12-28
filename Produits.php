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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"   />
  <title>CLOCK</title>
  <link rel="stylesheet" href="Style.css">
  <script>
    var logo = document.querySelector('.LOGO');
    var dropdownContent = document.querySelector('.dropdown-content');
  </script>


  <?php if (isset($_SESSION['user_name'])) { ?>
    <script>
      document.addEventListener("DOMContentLoaded", function() {
        var logo = document.querySelector('.LOGO');
        var dropdownContent = document.querySelector('.dropdown-content');

        logo.addEventListener('mouseover', function(event) {
          var rect = logo.getBoundingClientRect();
          var x = rect.left + window.pageXOffset;
          var y = rect.bottom + window.pageYOffset + 5;

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
  <?php } ?>


</head>

<body>

  <header>
    <div class="container">
      <nav>
        <H2 class="LGO">Clock Tower.com</H2>

        <ul>
          <li><a href="accueil.php">Accueil</a></li>
          <li><a href="#">Nos Produits</a></li>
          <li><a href="#">Actualités</a></li>
          <li><a href="#contact">Contact</a></li>
          <li><a href="panier.php" class="fa fa-shopping-cart"></a></li>
          <li class="user-menu">
            <?php
            // Start the session to access session variables
            session_start();

            // Check if the user is logged in
            if (isset($_SESSION['user_name'])) {
              echo "<div class='user-info'>";
              echo "<img src='img\user_icon.png' alt='User Icon'>"; // Replace 'user_icon.png' with the actual path to your user icon
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
          </section>
        </ul>

      </nav>
    </div>
  </header>
  <style>
    .searchbar {
      display: flex;
      align-items: center;
      margin-bottom: 20px;
      margin-left: 110px;
      /* Ajouter cette ligne pour l'espace à gauche */

    }

    #searchInput {
      padding: 10px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 4px;
      margin-right: 5px;
      margin-bottom: 0px;
      width: 40%;
    }

    #searchInput::placeholder {
      color: #999;
    }

    button {
      padding: 10px;
      font-size: 16px;
      cursor: pointer;
      background-color: #4caf50;
      color: #fff;
      border: none;
      border-radius: 4px;
    }

    button:hover {
      background-color: #45a049;
    }
  </style>




  <!-- Other HTML content -->
  <section class="searchbar">
    <input type="text" id="searchInput" placeholder="Search...">
    <button type="button" id="searchButton">Search</button>
  </section>


  <!-- "Not found" message -->
  <div id="notFoundMessage" style="display: none;">No results found.</div>


  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const logo = document.querySelector('.brandLogo'); // Remplacez 'brandLogo' par votre vrai nom de classe
      const dropdownContent = document.querySelector('.dropdown-content');

      if (logo) {
        logo.addEventListener('mouseover', function() {
          const rect = logo.getBoundingClientRect();
          const x = rect.left + window.pageXOffset;
          const y = rect.bottom + window.pageYOffset + 5; // Position ajustée

          dropdownContent.style.left = x + 'px';
          dropdownContent.style.top = y + 'px';

          dropdownContent.classList.add('show');
        });

        logo.addEventListener('mouseout', function() {
          if (dropdownContent.classList.contains('show')) {
            dropdownContent.classList.remove('show');
          }
        });
      }

      // Event listener pour le clic sur le bouton de recherche
      const searchButton = document.getElementById("searchButton");
      if (searchButton) {
        searchButton.addEventListener("click", searchProducts);
      }

      // Event listener pour la touche "Entrée" sur le champ de recherche
      const searchInput = document.getElementById("searchInput");
      if (searchInput) {
        searchInput.addEventListener("keydown", function(event) {
          if (event.key === "Enter") {
            // Vérifiez si la longueur de l'entrée est d'au moins 3 caractères avant de déclencher la recherche
            if (searchInput.value.trim().length >= 3) {
              searchProducts();
            }
          }
        });
      }

      function searchProducts() {
        const input = searchInput.value.trim().toLowerCase();
        const products = document.querySelectorAll('.carte');
        const notFoundMessage = document.getElementById('notFoundMessage');

        // Réinitialisez l'affichage de tous les produits
        products.forEach(product => {
          product.style.display = 'inline-block';
        });

        // Vérifiez si la longueur de l'entrée est inférieure à 3 caractères
        if (input.length < 3) {
          // Si la longueur de l'entrée est inférieure à 3, ne faites rien
          return;
        }

        let foundResults = false;

        products.forEach(product => {
          const title = product.querySelector('.Titre').textContent.toLowerCase();
          const description = product.querySelector('.Desc').textContent.toLowerCase();

          if (title.includes(input) || description.includes(input)) {
            // Le produit correspond à la recherche, ne rien faire ici
            foundResults = true;
          } else {
            // Masquer le produit qui ne correspond pas à la recherche
            product.style.display = 'none';
          }
        });

        if (!foundResults) {
          // Affichez le message "Non trouvé" lorsqu'aucun résultat n'est trouvé
          notFoundMessage.style.display = 'block';
        } else {
          // Masquez le message lorsqu'il y a des résultats
          notFoundMessage.style.display = 'none';
        }
      }
    });
  </script>




  <script>
    // Save a copy of all product cards when the page loads
    var allProductCards = document.querySelectorAll('.carte');

    function filterProducts() {
      var selectedCategory = document.getElementById('categoryDropdown').value;
      var productCards = document.querySelectorAll('.carte');

      productCards.forEach(function(card) {
        var cardCategory = card.getAttribute('data-category');

        if (selectedCategory === 'all' || selectedCategory === cardCategory) {
          card.style.display = 'inline-block'; // Adjust display property as needed
        } else {
          card.style.display = 'none';
        }
      });
    }

    // Function to show all products when "All Categories" is selected
    function showAllProducts() {
      var productCards = document.querySelectorAll('.carte');

      productCards.forEach(function(card, index) {
        // Restore the original display property from the backup
        card.style.display = 'inline-block'; // Adjust display property as needed
      });
    }
  </script>











  <select id="categoryDropdown" onchange="filterProducts()">
    <option value="all" onclick="showAllProducts()">All Categories</option>
    <option value="Electronics">Electronics</option>
    <option value="Accessories">Accessories</option>
    <option value="Gaming">Gaming</option>
    <!-- Add more categories as needed -->
  </select>




  <section class="products_section">
    <div class="Produits">


      <div class="carte" data-category="Gaming">
        <div class="img"><img src="img/IMG-20231207-WA0036.jpg"></div>

        <div class="Titre" style="font-weight: bold;">Souris Gamer</div>
        <div class="Desc">Elevate gaming precision with our advanced mouse.</div>
        <br>
        <div class="etoiles">
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span> +500 vendus
        </div>
        <div class="prix">300DH</div>
        <div class="product-details">
          <button class="add-to-cart-btn" onclick="console.log('Button Clicked!'); addToCart('Souris Gamer', 300, 'img/IMG-20231207-WA0036.jpg')">Add to Cart</button>

        </div>

      </div>

      <div class="carte" data-category="Accessories">
        <div class="img"><img src="img/ClassicAnalogWatch.jpg"></div>
        <div class="Titre" style="font-weight: bold;">Classic Analog Watch</div>
        <div class="Desc">Embrace timeless style with our classic analog watch.</div>
        <br>
        <div class="etoiles">
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span> +500 vendus
        </div>
        <div class="prix">499.99 DH</div>
        <div class="product-details">
          <button class="add-to-cart-btn" onclick="addToCart('Classic Analog Watch', 499.99, 'img/ClassicAnalogWatch.jpg')">Add to Cart</button>
        </div>
      </div>


      <div class="carte" data-category="Electronics">
        <div class="img"><img src="img/Clavier1.jpg"></div>
        <div class="Titre" style="font-weight: bold;">Key-pad</div>
        <div class="Desc"> Boost productivity with our customizable key-pad.</div>
        <br>
        <div class="etoiles">
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span> +500 vendus
        </div>

        <div class="prix">300Dh</div>
        <div class="product-details">
          <button class="add-to-cart-btn" onclick="console.log('Button Clicked!'); addToCart('Clavier', 300, 'img/Clavier1.jpg')">Add to Cart</button>
        </div>
      </div>





      <div class="carte">
        <div class="img"><img src="img/Ecran1.jpg"></div>

        <div class="Titre" style="font-weight: bold;">Display Screen</div>
        <div class="Desc">Immerse in stunning visuals for work or play.</div>
        <br>
        <div class="etoiles">
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span> +500 vendus
        </div>
        <div class="prix">1200DH</div>
        <div class="product-details">
          <button class="add-to-cart-btn" onclick="console.log('Button Clicked!'); addToCart('Ecran PC', 1200, 'img/Ecran1.jpg')">Add to Cart</button>
        </div>

      </div>

      <div class="carte">
        <div class="img"><img src="img/IMG-20231207-WA0033.jpg"></div>

        <div class="Titre" style="font-weight: bold;">Smart-Watch</div>
        <div class="Desc">Stay connected and fit with our sleek smartwatch.</div>
        <br>
        <div class="etoiles">
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span> +500 vendus
        </div>
        <div class="prix">500DH</div>
        <div class="product-details">
          <button class="add-to-cart-btn" onclick="console.log('Button Clicked!'); addToCart('Smart-Watch', 500, 'img/IMG-20231207-WA0033.jpg')">Add to Cart</button>

        </div>
      </div>

      <div class="carte">
        <div class="img"><img src="img/Wireless Bluetooth Earbuds.jpg"></div>
        <div class="Titre" style="font-weight: bold;">Wireless Bluetooth Earbuds</div>
        <div class="Desc">Enjoy wireless freedom and clear sound on the go.</div>
        <br>
        <div class="etoiles">
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span> +500 vendus
        </div>
        <div class="prix">299.99 DH</div>
        <div class="product-details">
          <button class="add-to-cart-btn" onclick="addToCart('Wireless Bluetooth Earbuds', 299.99, 'img/Wireless Bluetooth Earbuds.jpg')">Add to Cart</button>
        </div>
      </div>


      <div class="carte">
        <div class="img"><img src="img/PC1.jpg"></div>

        <div class="Titre" style="font-weight: bold;">PC Tower</div>
        <div class="Desc">Power up tasks and gaming with our reliable PC towers.</div>
        <br>
        <div class="etoiles">
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span> +500 vendus
        </div>
        <div class="prix">4999.99DH</div>
        <div class="product-details">
          <button class="add-to-cart-btn" onclick="console.log('Button Clicked!'); addToCart('Tour PC', 5000, 'img/PC1.jpg')">Add to Cart</button>

        </div>
      </div>
      <div class="carte">
        <div class="img"><img src="img/Portable Coffee Maker.jpg"></div>
        <div class="Titre" style="font-weight: bold;">Portable Coffee Maker</div>
        <div class="Desc">A compact and portable coffee maker for on-the-go coffee lovers.</div>
        <br>
        <div class="etoiles">
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span> +650 vendus
        </div>
        <div class="prix">799.99 DH</div>
        <div class="product-details">
          <button class="add-to-cart-btn" onclick="addToCart('Portable Coffee Maker', 799.99, 'img/Portable Coffee Maker.jpg')">Add to Cart</button>
        </div>
      </div>


      <div class="carte">
        <div class="img"><img src="IMG/WhatsApp Image 2023-12-07 à 14.02.43_ab170b2f.jpg"></div>

        <div class="Titre" style="font-weight: bold;">Printer</div>
        <div class="Desc">Print efficiently and maximize priting with our reliable printer.</div>
        <br>
        <div class="etoiles">
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span> +800 vendus
        </div>
        <div class="prix">800DH</div>
        <div class="product-details">
          <button class="add-to-cart-btn" onclick="console.log('Button Clicked!'); addToCart('Imprimante', 800, 'IMG/WhatsApp Image 2023-12-07 à 14.02.43_ab170b2f.jpg')">Add to Cart</button>

        </div>
      </div>

      <div class="carte">
        <div class="img"><img src="img/Smart LED Desk Lamp.jpg"></div>
        <div class="Titre" style="font-weight: bold;">Smart LED Desk Lamp</div>
        <div class="Desc">Illuminate your workspace smartly.</div>
        <br>
        <div class="etoiles">
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span> +1500 vendus
        </div>
        <div class="prix">399.99 DH</div>
        <div class="product-details">
          <button class="add-to-cart-btn" onclick="addToCart('Smart LED Desk Lamp', 399.99, 'img/Smart LED Desk Lamp.jpg')">Add to Cart</button>
        </div>
      </div>


      <div class="carte">
        <div class="img"><img src="img/RTX.jpg"></div>

        <div class="Titre" style="font-weight: bold;">RTX PC</div>
        <div class="Desc">Powerful graphics, superior performance – elevate your computing experience.</div>
        <br>
        <div class="etoiles">
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span> +10000 vendus
        </div>
        <div class="prix">3000DH</div>
        <div class="product-details">
          <button class="add-to-cart-btn" onclick="console.log('Button Clicked!'); addToCart('RTX', 3000, 'img/RTX.jpg')">Add to Cart</button>

        </div>
      </div>


      <div class="carte">
        <div class="img"><img src="img/PCportable1.jpg"></div>

        <div class="Titre" style="font-weight: bold;">PC-Portable</div>
        <div class="Desc">Powerful, portable computing for versatile performance on-the-move</div>
        <br>
        <div class="etoiles">
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span> +500 vendus
        </div>
        <div class="prix">8000DH</div>
        <div class="product-details">
          <button class="add-to-cart-btn" onclick="console.log('Button Clicked!'); addToCart('PC-Portable', 8000, 'img/PCportable1.jpg')">Add to Cart</button>

        </div>
      </div>

      <div class="carte">
        <div class="img"><img src="img/Fitness Tracker Watch.jpg"></div>
        <div class="Titre" style="font-weight: bold;">Fitness Tracker Watch</div>
        <div class="Desc">Achieve fitness goals with our tracker watch.</div>
        <br>
        <div class="etoiles">
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span> +500 vendus
        </div>
        <div class="prix">59.99 DH</div>
        <div class="product-details">
          <button class="add-to-cart-btn" onclick="addToCart('Fitness Tracker Watch', 599.99, 'img/Fitness Tracker Watch.jpg')">Add to Cart</button>
        </div>
      </div>


      <div class="carte">
        <div class="img"><img src="img/TourPC3.jpg"></div>

        <div class="Titre" style="font-weight: bold;">Tour PC</div>
        <div class="Desc">Description</div>
        <br>
        <div class="etoiles">
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span> +500 vendus
        </div>
        <div class="prix">5500DH</div>
        <div class="product-details">
          <button class="add-to-cart-btn" onclick="console.log('Button Clicked!'); addToCart('Tour PC', 5500, 'img/TourPC3.jpg')">Add to Cart</button>

        </div>
      </div>


      <div class="carte">
        <div class="img"><img src="img/IMG-20231207-WA0035.jpg"></div>

        <div class="Titre" style="font-weight: bold;">Smartphone</div>
        <div class="Desc">Stay connected with style and functionality.</div>
        <br>
        <div class="etoiles">
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="far fa-star"></span> +550 ventes
        </div>
        <div class="prix">3500DH</div>
        <div class="product-details">
          <button class="add-to-cart-btn" onclick="console.log('Button Clicked!'); addToCart('Smatphone', 3500, 'img/IMG-20231207-WA0035.jpg')">Add to Cart</button>

        </div>

      </div>



      <div class="carte">
        <div class="img"><img src="img/Souris&Clavier.jpg"></div>

        <div class="Titre" style="font-weight: bold;">Clavier+Souris</div>
        <div class="Desc">Enhance control with our combo.</div>
        <br>
        <div class="etoiles">
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star-half"></span>+1000ventes

        </div>
        <div class="prix">1000DH</div>
        <div class="product-details">
          <button class="add-to-cart-btn" onclick="console.log('Button Clicked!'); addToCart('Clavier+Souris', 600, 'img/Souris&Clavier.jpg')">Add to Cart</button>

        </div>
      </div>



      <div class="carte">
        <div class="img"><img src="img/TourPC2.jpg"></div>

        <div class="Titre" style="font-weight: bold;">Tour PC</div>
        <div class="Desc">Description</div>
        <br>
        <div class="etoiles">
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span> +500 vendus
        </div>
        <div class="prix">7000DH</div>
        <div class="product-details">
          <button class="add-to-cart-btn" onclick="console.log('Button Clicked!'); addToCart('Tour PC', 7000, 'img/TourPC2.jpg')">Add to Cart</button>

        </div>
      </div>

      <div class="carte">
        <div class="img"><img src="img/IMG-20231207-WA0034.jpg"></div>

        <div class="Titre" style="font-weight: bold;">HeadPhones</div>
        <div class="Desc">Immerse in superior audio quality.</div>
        <br>
        <div class="etoiles">
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span> +500 vendus
        </div>
        <div class="prix">500DH</div>
        <div class="product-details">
          <button class="add-to-cart-btn" onclick="console.log('Button Clicked!'); addToCart('HeadPhones', 500, 'img/IMG-20231207-WA0034.jpg')">Add to Cart</button>

        </div>
      </div>

      <div class="carte">
        <div class="img"><img src="img/IMG-20231207-WA0035.jpg"></div>

        <div class="Titre" style="font-weight: bold;">Smartphone</div>
        <div class="Desc">Description</div>
        <br>
        <div class="etoiles">
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span> +500 vendus
        </div>
        <div class="prix">1000DH</div>
        <div class="product-details">
          <button class="add-to-cart-btn" onclick="console.log('Button Clicked!'); addToCart('Smatphone', 3500, 'img/IMG-20231207-WA0035.jpg')">Add to Cart</button>

        </div>
      </div>

      <div class="carte">
        <div class="img"><img src="img/TourPC3.jpg"></div>

        <div class="Titre" style="font-weight: bold;">Smartphone</div>
        <div class="Desc">Description</div>
        <br>
        <div class="etoiles">
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span> +500 vendus
        </div>
        <div class="prix">1000DH</div>
        <div class="product-details">
          <button class="add-to-cart-btn" onclick="console.log('Button Clicked!'); addToCart('Smatphone', 3500, 'img/IMG-20231207-WA0035.jpg')">Add to Cart</button>

        </div>
      </div>

      <div class="carte">
        <div class="img"><img src="img/IMG-20231207-WA0036.jpg"></div>

        <div class="Titre" style="font-weight: bold;">Smartphone</div>
        <div class="Desc">Description</div>
        <br>
        <div class="etoiles">
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span> +500 vendus
        </div>
        <div class="prix">1000DH</div>
        <div class="product-details">
          <button class="add-to-cart-btn" onclick="console.log('Button Clicked!'); addToCart('Smatphone', 3500, 'img/IMG-20231207-WA0035.jpg')">Add to Cart</button>

        </div>
      </div>

    </div>
  </section>



  <section class="contact" id="contact">
    <div class="card">
      <a class="social-link1">
        <svg viewBox="0 0 16 16" class="bi bi-instagram" fill="currentColor" height="16" width="16" xmlns="http://www.w3.org/2000/svg" style="color: white">
          <path fill="white" d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"></path>
        </svg>
      </a>
      <a class="social-link2">
        <svg viewBox="0 0 16 16" class="bi bi-twitter" fill="currentColor" height="16" width="16" xmlns="http://www.w3.org/2000/svg" style="color: white">
          <path fill="white" d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"></path>
        </svg> </a>
      <a class="social-link3">
        <svg viewBox="0 0 16 16" class="bi bi-discord" fill="currentColor" height="16" width="16" xmlns="http://www.w3.org/2000/svg" style="color: white">
          <path fill="white" d="M13.545 2.907a13.227 13.227 0 0 0-3.257-1.011.05.05 0 0 0-.052.025c-.141.25-.297.577-.406.833a12.19 12.19 0 0 0-3.658 0 8.258 8.258 0 0 0-.412-.833.051.051 0 0 0-.052-.025c-1.125.194-2.22.534-3.257 1.011a.041.041 0 0 0-.021.018C.356 6.024-.213 9.047.066 12.032c.001.014.01.028.021.037a13.276 13.276 0 0 0 3.995 2.02.05.05 0 0 0 .056-.019c.308-.42.582-.863.818-1.329a.05.05 0 0 0-.01-.059.051.051 0 0 0-.018-.011 8.875 8.875 0 0 1-1.248-.595.05.05 0 0 1-.02-.066.051.051 0 0 1 .015-.019c.084-.063.168-.129.248-.195a.05.05 0 0 1 .051-.007c2.619 1.196 5.454 1.196 8.041 0a.052.052 0 0 1 .053.007c.08.066.164.132.248.195a.051.051 0 0 1-.004.085 8.254 8.254 0 0 1-1.249.594.05.05 0 0 0-.03.03.052.052 0 0 0 .003.041c.24.465.515.909.817 1.329a.05.05 0 0 0 .056.019 13.235 13.235 0 0 0 4.001-2.02.049.049 0 0 0 .021-.037c.334-3.451-.559-6.449-2.366-9.106a.034.034 0 0 0-.02-.019Zm-8.198 7.307c-.789 0-1.438-.724-1.438-1.612 0-.889.637-1.613 1.438-1.613.807 0 1.45.73 1.438 1.613 0 .888-.637 1.612-1.438 1.612Zm5.316 0c-.788 0-1.438-.724-1.438-1.612 0-.889.637-1.613 1.438-1.613.807 0 1.451.73 1.438 1.613 0 .888-.631 1.612-1.438 1.612Z"></path>
        </svg>
      </a>
      <a class="social-link4">
        <svg viewBox="0 0 16 16" class="bi bi-whatsapp" fill="currentColor" height="16" width="16" xmlns="http://www.w3.org/2000/svg" style="color: white">
          <path fill="white" d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"></path>
        </svg>
      </a>
    </div>
    </footer>

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


    <script>
      document.addEventListener("DOMContentLoaded", function() {
        var addToCartButtons = document.querySelectorAll('.add-to-cart-btn');

        addToCartButtons.forEach(function(button) {
          button.addEventListener('click', function() {
            // Check if the user is logged in
            <?php
            if (isset($_SESSION['user_name'])) {
              // If logged in, add the product to the cart using JavaScript or make an AJAX call to the server
              echo "console.log('Product added to cart');";
            } else {
              // If not logged in, redirect to the login page
              echo "window.location.href = 'login.php';";
            }
            ?>
          });
        });
      });
    </script>

</body>

</html>