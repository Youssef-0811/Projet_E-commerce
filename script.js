function searchProducts() {
    const input = document.getElementById("searchInput").value.trim().toLowerCase();
    const products = document.querySelectorAll('.carte');
    const notFoundMessage = document.getElementById('notFoundMessage');
  
    if (!input) {
      // If input is empty, display all products and return
      notFoundMessage.style.display = 'none'; // Hide the "Not found" message
      products.forEach(product => {
        product.style.display = 'inline-block';
      });
      return;
    }
  
    let foundResults = false;
  
    products.forEach(product => {
      const title = product.querySelector('.Titre').textContent.toLowerCase();
      const description = product.querySelector('.Desc').textContent.toLowerCase();
  
      if (title.includes(input) || description.includes(input)) {
        product.style.display = 'inline-block';
        foundResults = true;
      } else {
        product.style.display = 'none';
      }
    });
  
    if (!foundResults) {
      // Display "Not found" message when no results are found
      notFoundMessage.style.display = 'block';
    } else {
      // Hide the message when results are found
      notFoundMessage.style.display = 'none';
    }
  }
  
  // Ajouter cet écouteur d'événements pour la touche "Entrée"
  document.getElementById("searchInput").addEventListener("keyup", function(event) {
    if (event.key === "Enter") {
      searchProducts();
    }
  });
  




// function searchProducts() {
//     const input = document.getElementById("searchInput").value.trim().toLowerCase();
//     const products = document.querySelectorAll('.carte');
//     const notFoundMessage = document.getElementById('notFoundMessage');
  
//     if (!input) {
//       // If input is empty, display all products and return
//       notFoundMessage.style.display = 'none'; // Hide the "Not found" message
//       products.forEach(product => {
//         product.style.display = 'inline-block';
//       });
//       return;
//     }
  
//     let foundResults = false;
  
//     products.forEach(product => {
//       const title = product.querySelector('.Titre').textContent.toLowerCase();
//       const description = product.querySelector('.Desc').textContent.toLowerCase();
  
//       if (title.includes(input) || description.includes(input)) {
//         product.style.display = 'inline-block';
//         foundResults = true;
//       } else {
//         product.style.display = 'none';
//       }
//     });
  
//     if (!foundResults) {
//       // Display "Not found" message when no results are found
//       notFoundMessage.style.display = 'block';
//     } else {
//       // Hide the message when results are found
//       notFoundMessage.style.display = 'none';
//     }
//   }
  