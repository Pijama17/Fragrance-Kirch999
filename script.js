//dit is de code om een product in mijn winkel wagen tezetten
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');
            fetch('add_to_cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'product_id=' + productId
            })
            .then(response => response.text())
            .then(data => {
                alert('Product toegevoegd aan winkelwagen!');
            })
            .catch(error => console.error('Error:', error));
        });
    });
});
 
