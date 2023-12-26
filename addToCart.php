<!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        const cartList = document.getElementById('cart-list');
        const emptyCartMessage = document.getElementById('empty-cart-message');
        const totalPriceElement = document.getElementById('total-price');
        const payButton = document.getElementById('pay-button');

        // Retrieve cart data from localStorage
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        // Update cart display
        function updateCart() {
            cartList.innerHTML = '';
            if (cart.length === 0) {
                emptyCartMessage.style.display = 'block';
                payButton.style.display = 'none';
            } else {
                emptyCartMessage.style.display = 'none';
                payButton.style.display = 'block';

                let total = 0;
                cart.forEach(product => {
                    const listItem = document.createElement('li');
                    listItem.innerHTML = `<span>${product.name}</span><span>${product.price}DH</span>`;
                    cartList.appendChild(listItem);
                    total += product.price;
                });

                totalPriceElement.textContent = `Total: ${total}DH`;
            }
        }

        // Event listener for "Add to Cart" buttons
        document.querySelectorAll('.add-to-cart-btn').forEach(button => {
            button.addEventListener('click', function() {
                const productContainer = button.closest('.product-item');
                const product = {
                    name: productContainer.querySelector('h3').textContent,
                    price: parseFloat(productContainer.querySelector('h4').textContent),
                };

                // Add product to cart and update localStorage
                cart.push(product);
                localStorage.setItem('cart', JSON.stringify(cart));

                // Update cart display
                updateCart();
            });
        });

        // Initial update of the cart display
        updateCart();

        function addToCart(name, image, price) {
            // Create a new list item for the cart
            var cartItem = document.createElement('li');
            cartItem.innerHTML = `
        <img src="${image}" alt="${name}">
        <span class="cart-item-name">${name}</span>
        <span class="cart-item-price">${price}DH</span>
      `;

            // Append the new item to the cart list
            var cartList = document.getElementById('cart-list');
            cartList.appendChild(cartItem);

            // Update the total price
            updateTotalPrice(price);

            // Show the "Proceed to Pay" button
            var payButton = document.getElementById('pay-button');
            payButton.style.display = 'block';

            // Hide the empty cart message
            var emptyCartMessage = document.getElementById('empty-cart-message');
            emptyCartMessage.style.display = 'none';
        }

        function updateTotalPrice(price) {
            // Calculate and update the total price
            var totalPriceElement = document.getElementById('total-price');
            var currentTotal = parseFloat(totalPriceElement.innerText.replace('Total: ', '').replace('DH', ''));
            var newTotal = currentTotal + price;
            totalPriceElement.innerText = 'Total: ' + newTotal + 'DH';
        }

    });
</script> -->