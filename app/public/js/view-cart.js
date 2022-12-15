async function openCart(route) {
    try{
        const viewCartResponse = await fetch(route, {

            method: 'GET',
            headers: { 'Content-Type': 'application/json' },
        });
        const response = await viewCartResponse.json();
        document.getElementById("radio-button-container").innerHTML = response.html;
        document.getElementById(`recipe-list`).style.visibility = 'hidden';
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