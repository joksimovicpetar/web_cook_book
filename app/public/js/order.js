async function placeOrder(route, routeNext) {
    try{
        await fetch(route, {

            method: 'GET',
            headers: { 'Content-Type': 'application/json' },
        });
        window.location.href = routeNext

    }
    catch (e) {
        console.error('Error while creating order')
    }
}
function order() {

    const btn = document.getElementById("btn-order");
    btn.addEventListener('click', () => {
        alert('clicli')
            placeOrder('http://localhost:8082/order', 'http://localhost:8082/main')
        }
        , false);
}

order();