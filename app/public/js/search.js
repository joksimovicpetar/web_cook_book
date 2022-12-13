
const LOAD_SEARCH_ROUTE = 'http://localhost:8082/load_more_search';

async function searchItem(parameter) {

    try{
        const searchResponse = await fetch(LOAD_SEARCH_ROUTE, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({searchParameter: parameter}),
        });

        const response = await searchResponse.json();
        document.getElementById(`recipe-list`).innerHTML = response.html;
        document.getElementById(`recipe-list`).style.visibility = 'visible';
        document.getElementById(`recipe-load-more`).style.visibility = 'hidden';
    }
    catch (e) {
        console.error('Error while searching')
        console.log(e)
    }
}
function search(){
    const btns = document.getElementsByClassName("btn-search");
    for (const btn of btns) {
        btn.addEventListener('click', () => {
                alert('clicked')
                const parameter = document.getElementById("search-bar").value;
                searchItem(parameter)
            }
            , false);
    }
}
