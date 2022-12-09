async function modal(targetRoute) {

    try{
        await fetch(targetRoute);
        openModal()

    }
    catch (e) {
        console.error('Error')
        console.log(e)
    }
}
function openModal(){
    const btn = document.getElementById("modal_trigger");

    btn.addEventListener('click', (event) => {
        alert('click')
            modal('http://localhost:8082/modal')
        }
        , false);


}
