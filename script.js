document.addEventListener("DOMContentLoaded", function () {
  var logo = document.querySelector('.LOGO');
  var dropdownContent = document.querySelector('.dropdown-content');

  logo.addEventListener('mouseover', function (event) {
    var rect = logo.getBoundingClientRect();
    var x = rect.left + window.pageXOffset;
    var y = rect.bottom + window.pageYOffset + 5; // Position ajustée

    dropdownContent.style.left = x + 'px';
    dropdownContent.style.top = y + 'px';

    dropdownContent.classList.add('show');
  });

  logo.addEventListener('mouseout', function (event) {
    if (dropdownContent.classList.contains('show')) {
      dropdownContent.classList.remove('show');
    }
  });

  // Ajout du gestionnaire d'événements pour la touche "Entrée" sur le champ de recherche
  const searchInput = document.getElementById("searchInput");
  searchInput.addEventListener("keydown", function (event) {
    if (event.key === "Enter") {
      searchProducts();
    }
  });

  // Ajout du gestionnaire d'événements pour le clic sur le bouton de recherche
  const searchButton = document.getElementById("searchButton");
  searchButton.addEventListener("click", searchProducts);

  function searchProducts() {
    const input = document.getElementById("searchInput").value.trim().toLowerCase();
    const products = document.querySelectorAll('.carte');
    const notFoundMessage = document.getElementById('notFoundMessage');

    // Réinitialisez l'affichage de tous les produits
    products.forEach(product => {
      product.style.display = 'inline-block';
    });

    // Vérifiez si le champ est vide
    if (!input) {
      // Si le champ est vide, masquez le message "Non trouvé" et retournez
      notFoundMessage.style.display = 'none';
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