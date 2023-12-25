function addToPanier(product) {
  panier.push(product);
  console.log("Product added to panier:", product);
  updatePanier();
}

// Function to update the panier display
function updatePanier() {
  console.log("Updating panier:", panier);
  // Array to store added products
  let panier = [];

  // Function to add a product to the panier
  function addToPanier(product) {
    panier.push(product);
    updatePanier();
  }

  // Function to update the panier display
  function updatePanier() {
    const panierList = document.getElementById("panier-list");
    const totalPriceElement = document.getElementById("total-price");

    // Clear the existing panier list
    panierList.innerHTML = "";

    // Populate the panier list with added products
    panier.forEach((product) => {
      const listItem = document.createElement("li");
      listItem.innerHTML = `<img src="${product.image}" alt="${product.name}">
                        <div>
                          <p>${product.name}</p>
                          <p>${product.price}DH</p>
                        </div>`;
      panierList.appendChild(listItem);
    });

    // Calculate and display the total price
    const totalPrice = panier.reduce((total, product) => total + product.price, 0);
    totalPriceElement.textContent = `Total: ${totalPrice}DH`;
  }

  // Event listener for the "Add to Cart" buttons
  document.querySelectorAll(".add-to-cart-btn").forEach((button) => {
    button.addEventListener("click", () => {
      // Get product details from the clicked product
      const productContainer = button.closest("li");
      const product = {
        image: productContainer.querySelector("img").src,
        name: productContainer.querySelector("h3").textContent,
        price: parseFloat(productContainer.querySelector("H4").textContent),
      };

      // Add the product to the panier
      addToPanier(product);
    });
  });

  // Event listener for the "Proceed to Pay" button
  document.getElementById("pay-button").addEventListener("click", () => {
    // Check if the cart is not empty
    if (panier.length > 0) {
      // You can add the logic to handle the payment process here
      alert("Redirecting to payment page!");
    } else {
      alert("Your cart is empty. Add some products before proceeding to pay.");
    }
  }
  )
}




// document.addEventListener('DOMContentLoaded', function () {
//     const cartList = document.getElementById('cart-list');
//     const emptyCartMessage = document.getElementById('empty-cart-message');
//     const totalPriceElement = document.getElementById('total-price');
//     const payButton = document.getElementById('pay-button');
  
//     // Retrieve cart data from localStorage
//     let cart = JSON.parse(localStorage.getItem('cart')) || [];
  
//     // Update cart display
//     function updateCart() {
//       cartList.innerHTML = '';
//       if (cart.length === 0) {
//         emptyCartMessage.style.display = 'block';
//         payButton.style.display = 'none';
//       } else {
//         emptyCartMessage.style.display = 'none';
//         payButton.style.display = 'block';
  
//         let total = 0;
//         cart.forEach(product => {
//           const listItem = document.createElement('li');
//           listItem.innerHTML = `<span>${product.name}</span><span>${product.price}DH</span>`;
//           cartList.appendChild(listItem);
//           total += product.price;
//         });
  
//         totalPriceElement.textContent = `Total: ${total}DH`;
//       }
//     }
  
//     // Event listener for "Add to Cart" buttons
//     document.querySelectorAll('.add-to-cart-btn').forEach(button => {
//       button.addEventListener('click', function () {
//         const productContainer = button.closest('.product-item');
//         const product = {
//           name: productContainer.querySelector('h3').textContent,
//           price: parseFloat(productContainer.querySelector('h4').textContent),
//         };
  
//         // Add product to cart and update localStorage
//         cart.push(product);
//         localStorage.setItem('cart', JSON.stringify(cart));
  
//         // Update cart display
//         updateCart();
//       });
//     });
  
//     // Initial update of the cart display
//     updateCart();
//   });
  
