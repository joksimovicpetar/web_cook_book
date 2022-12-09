async function selectedSearchCategory(targetRoute, category) {

    try{
        const recipesResponse = await fetch(targetRoute, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({category: category})
        });
        const response = await recipesResponse.json();
        document.getElementById("recipe-list").innerHTML = response.html;
        openModal()
        load(category)
        // window.location.reload();

    }
    catch (e) {
        console.error('Error')
        console.log(e)
    }
}
function selectSearchCategory(){
    const btn = document.getElementById('radio-button');

        btn.addEventListener('change', (event) => {
                console.log(event.target.value)
                const category = event.target.value;
                selectedSearchCategory('http://localhost:8082/search_category', category)
            }
            , false);


}

