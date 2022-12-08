const offset = 3;
let page = 1;
const LOAD_ROUTE = 'http://localhost:8082/load_more_category';

async function loadMore(category) {

    try{
        const response = await fetch( LOAD_ROUTE, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({offset, page: ++page, category: category}),
        });

        const decodedResponse = await response.json();
        document.getElementById(`recipe-list`).innerHTML += decodedResponse.html;
        // active("card-rows", "card-bowl")
        page++;
        hasMore = decodedResponse.hasMoreResults;
        if (hasMore===false){
            document.getElementById(`recipe-load-more`).style.visibility = 'hidden';
        }
    }
    catch (e) {
        console.error('Error while creating item order')
    }
}

function load(){
    const loadMoreButtons = document.getElementsByClassName("btn-load");
    for (const loadMoreButton of loadMoreButtons) {
        loadMoreButton.addEventListener('click', () => {
                const category = loadMoreButton.getAttribute("data-id");
                loadMore(category)
            }
            , false);
    }
}

