async function openCart(route) {
    try{
        const viewCartResponse = await fetch(route, {

            method: 'GET',
            headers: { 'Content-Type': 'application/json' },
        });
        const response = await viewCartResponse.json();
        document.getElementById("cart-container").style.visibility = 'visible';
        document.getElementById("cart-container").innerHTML = response.html;
        document.getElementById("radio-button-container").style.visibility = 'hidden';
        document.getElementById(`recipe-list`).style.visibility = 'hidden';
        order();
    }
    catch (e) {
        console.error('Error while creating order')
    }
}
function viewCart() {

    const btn = document.getElementById("btn-cart");
    btn.addEventListener('click', () => {
            openCart('http://localhost:8082/view_cart')
        }
        , false);
}

viewCart();
order();