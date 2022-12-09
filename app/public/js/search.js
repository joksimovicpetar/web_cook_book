async function deleteOrderItem(routeEdit, dataId) {
    // console.log(dataId);

    try{
        const deleteResponse = await fetch(routeEdit, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({id: parseInt(dataId)}),
        });

        const response = await deleteResponse.json();
        document.getElementById("user_order_table").innerHTML = response.html;
        deleteItem()
        updateItem()

    }
    catch (e) {
        console.error('Error while deleting item order')
        console.log(e)
    }
}
function deleteItem(){
    const btns = document.getElementsByClassName("btn-search");
    for (const btn of btns) {
        btn.addEventListener('click', () => {
                alert('clicked')
                const parameter = document.getElementById("search-bar").value;
                deleteOrderItem('http://localhost:8082/user_order/delete', parameter)
            }
            , false);
    }
}