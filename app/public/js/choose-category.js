async function selectedSearchCategory(targetRoute, category) {

    try{
        const recipesResponse = await fetch(targetRoute, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({category: category})
        });
        const response = await recipesResponse.json();
        document.getElementById("recipe-list").innerHTML = response.html;
        document.getElementById(`recipe-list`).style.visibility = 'visible';
        document.getElementById(`recipe-load-more`).style.visibility = 'visible';


        // openModal()
        load(category)
        // window.location.reload();

    }
    catch (e) {
        console.error('Error 1')
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

