let getCodePostal = (idColony) => {
    fetch('./logic/code_post/get_code_post.php?id_colonia=' + idColony)
        .then(response => response.json())
        .then(console.log)
        .catch(console.log)
};

let makeFetch = (url, nameElement, nameArray) => {
    fetch('./logic/' + url)
        .then(response => response.json())
        .then(res => getResponseFetch(res, nameElement, nameArray))
        .catch(console.log);
}

let getStates = () =>
    makeFetch('state/get_states.php', 'state', 'states');


let getResponseFetch = (responseState, nameElement, nameArray) => {
    if (responseState.ok)
        drawSates(nameElement, responseState[nameArray]);
    else
        alert(responseState.message);
};

let drawSates = (idElement, states) => {
    let elmentState = document.getElementById(idElement);
    states.forEach(state => drawOption(elmentState, state.name, state.id));
};

let drawOption = (elementSelect, name, id) => {
    let opt = document.createElement('option');
    opt.value = id;
    opt.innerHTML = name;
    elementSelect.appendChild(opt);
};


let changeState = (idState) => {
    printLeng();
    document.getElementById('municipality').options.length = 0;
    if (idState != -1)
        makeFetch('municipality/get_municipality.php?id_estado=' + idState,
            'municipality', 'municipalys');
}

let changeMunicipality = (idMunicipality) => {
    printLeng();
    document.getElementById('colony').options.length = 0;
    if (idMunicipality != -1)
        makeFetch('colony/get_colony.php?id_municipio=' + idMunicipality,
            'colony', 'colonys');
}

let changeColony = (idColony) => {
    printLeng();
    document.getElementById('postal_code').options.length = 0;
    if (idColony != -1)
        makeFetch('code_post/get_code_post.php?id_colonia=' + idColony,
            'postal_code', 'postal_codes');
}


getStates();


let validatorEmail = (email) => {
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
        console.log('Correo Correcto');
    } else
        console.log('Correo Incorrecto');
}


let printLeng = () => {
    // console.log('state', document.getElementById('state').options.length);
    // console.log('municipality', document.getElementById('municipality').options.length);
    // console.log('colony', document.getElementById('colony').options.length);
    // console.log('postal_code', document.getElementById('postal_code').options.length);
}


var testForm = document.getElementById('form-register');
testForm.onsubmit = function(event) {
    event.preventDefault();
    var formData = new FormData(document.getElementById('form-register'));
    fetch('./logic/client/add_client.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(addUser => {
            console.log(addUser);
            if (addUser.ok) {
                alert('Usuario registrado');
                window.location = './login.html';
            } else {
                alert('No registrado');
            }
        })
        .catch(console.log)
}