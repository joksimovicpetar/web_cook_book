async function addToCart(route, id) {
    try{
        alert('oh yeeeeah!')
        await fetch(route, {

            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({id: id}),
        });
    }
    catch (e) {
        console.error('Error while creating order')
    }
}
function add() {
    let active_card = document.getElementsByClassName("btn-add")[0];
    let id = active_card.getAttribute("data-id");
    const btn = document.getElementById("btn-add");
    btn.addEventListener('click', () => {

            addToCart('http://localhost:8082/add_to_cart', id)
        }
        , false);
}

add();