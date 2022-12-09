async function registerUser(routeEdit, routeNext) {

    const username = document.getElementById('inputUsername').value;
    const password = document.getElementById('inputPassword').value;
    const repeatPassword = document.getElementById('inputRepeatPassword').value;

    if (password !== '' && username !== '' ) {
        if (password === repeatPassword) {
            try {
                const response = await fetch(routeEdit, {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({username: username, password: password})
                });

                if (response.status === 202) {
                    alert('Username already exists!')
                    return
                }
                window.location.href = routeNext
            } catch (e) {
                console.error('Error while updating item order')
                console.log(e)
            }
        } else {
            alert("Passwords don't match!")
        }
    } else {
        alert("You have to fill all required fields!")
    }
}

function register(){
    const btn = document.getElementById("register");
    btn.addEventListener('click', () => {
            registerUser('http://localhost:8082/register/write','http://localhost:8082/login/?registered=true')
        }
        , false);
}

register()