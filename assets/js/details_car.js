let addArticleToCard = (id_product) => {
    addOrDeleteOrderServerDB(id_product).then(response =>
        updateBtnCar(response.add)
    ).catch(alert);
}

let updateBtnCar = (state_buy) => {
    getNumberOfOrders();
    let btnAddCar = document.getElementById('btn_add_car');
    if (btnAddCar) {
        if (state_buy) {
            btnAddCar.firstChild.data = "Eliminar del carrito";
            btnAddCar.classList.remove('btn-car-sale');
        } else {
            btnAddCar.firstChild.data = "Agregar al carrito ";
            btnAddCar.classList.add('btn-car-sale');
        }
    }
}

let existProductInCar = (id_product) => {
    findOrderProductDB(id_product)
        .then(responseFound =>
            updateBtnCar(responseFound.found)
        ).catch(error => {
            console.log(error);
            console.log('Error al buscar el articulo..');
        });
}

let paramId = location.search.split('id=')[1];

if (paramId)
    existProductInCar(paramId);



let chagePhoto = (url) => {
    console.log(url);
    let elementImgMain = document.getElementById('main_img_product');
    elementImgMain.src = url;
}