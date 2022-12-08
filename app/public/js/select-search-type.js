async function selectedSearchType(targetRoute, type) {

    try{
        const searchTypeResponse = await fetch(targetRoute, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({type: type})
        });
        const response = await searchTypeResponse.json();
        document.getElementById("radio-button-container").innerHTML += response.html;
        selectSearchType();
        // window.location.reload();

    }
    catch (e) {
        console.error('Error')
        console.log(e)
    }
}
function selectSearchType(){
    const btn = document.getElementById('recipe-search-selector');
// console.log(btn)
    btn.addEventListener('change', (event) => {
            // console.log(event.target.value)
            const type = event.target.value;
            selectedSearchType('http://localhost:8082/search', type)
        }
        , false);

}

selectSearchType();