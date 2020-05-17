/**
 * Upate de GUI icon car of product selected
 * @param {*} id_product 
 * @param {*} state_buy 
 */

let updateIconCarOfProduct = (id_product, state_buy) => {
    let icCarElement = document.getElementById(`ic_car_${id_product}`);
    getNumberOfOrders();
    if (icCarElement) {
        if (state_buy) {
            icCarElement.classList.remove('car_no_active');
            icCarElement.classList.add('car_active');
        } else {
            icCarElement.classList.add('car_no_active');
            icCarElement.classList.remove('car_active');
        }
    }
}

let addOrDeleteOrderServerDB = (id_product) => {
    return new Promise((resolve, reject) => {
        findOrderProductDB(id_product)
            .then(responseFound => {
                if (responseFound.found) {
                    fetchDeleteOrder(responseFound.id_order)
                        .then(jsonResponse => {
                            if (jsonResponse.ok) {
                                deleteOrderDB(id_product)
                                    .then(resolve({ delete: true, add: false }))
                                    .catch(error => reject('No se pudo eliminar la orden en el cache'));
                            } else
                                reject(jsonResponse.message);
                        })
                        .catch(error => reject('No se pudo realizar la petición al servidor..'));
                } else {
                    fetchAddOrder(id_product)
                        .then(jsonResponse => {
                            if (jsonResponse.ok) {
                                saveOrderDB(id_product, jsonResponse.id_pedido)
                                    .then(resolve({ delete: false, add: true }))
                                    .catch(error => reject('No se pudo guardar la orden en el cache'));
                            } else
                                reject(jsonResponse.message);
                        }).catch(error => reject('No se pudo realizar la petición al servidor..'));
                }
            })
            .catch(error => reject('Existe un error en el cache...'));
    });
}

/**
 * Update de icon car in GUI
 * save in BD order
 * 
 * @param {*} id_product 
 */
let newOrder = (id_product) => {
    addOrDeleteOrderServerDB(id_product).then(response => {
        updateIconCarOfProduct(id_product, response.add);
        getLenghProducts();
    }).catch(alert);
}


let fetchAddOrder = id_product => {
    return new Promise((resolve, reject) => {
        let form_data = new FormData();
        form_data.append('id_producto', id_product);
        form_data.append('cantidad', 1);

        fetch('./logic/order/add.php', {
                method: 'POST',
                body: form_data
            }).then(response => response.json())
            .then(resolve)
            .catch(reject);
    });
}

let fetchDeleteOrder = idOder => {
    return new Promise((resolve, reject) => {
        let form_data = new FormData();
        form_data.append('id_pedido', idOder);

        fetch('./logic/order/delete.php', {
                method: 'POST',
                body: form_data
            }).then(response => response.json())
            .then(resolve)
            .catch(reject);
    });
}

let deleteOrder = (id_order, id_product) => {

}

let updateNumberCar = () => {
    console.log('Update number');
    //let numberArticleCarElement = document.getElementById('number_articles_in_car');
    //numberArticleCarElement.innerHTML = products_car.length;
}

let formEncode = (obj) => {
    let str = [];
    for (let p in obj)
        str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
    return str.join("&");
}

let updateIconCarProductsInDB = () => {
    getAllOrdersDB()
        .then(rows => {
            rows.forEach(row =>
                updateIconCarOfProduct(row.doc._id, true));
        })
        .catch(console.error);
}

updateIconCarProductsInDB();

let getLenghProducts = () => {
    getAllOrdersDB()
        .then(rows => {
            let number_article_car = document.getElementById('number_articles_in_car');
            number_article_car.innerHTML = rows.length;
        })
        .catch(console.error);
}

getLenghProducts();


/**
 * GESTIÓN DE ICON 
 */

let getNumberOfOrders = () => {
    getAllOrdersDB()
        .then(rows => {
            let sizeProducts = rows.length;
            console.log(sizeProducts);
            console.log('TAMANIO');
            if (sizeProducts > 0) {
                let products = [];
                rows.forEach(row => products.push(row.doc.id_order));
                console.log('ESTO SE MANDA');
                console.log(products.join(',').toString());
                let formData = new FormData();
                formData.append('orders', products.join(',').toString());
                fetch('./logic/car/get_total.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(totalResponse => {
                        if (totalResponse.ok) {
                            if (totalResponse.total) {
                                updateInfoIcon(sizeProducts, totalResponse.total);
                            } else {
                                updateInfoIcon(0, 0);
                            }
                        }
                    })
                    .catch(console.log);
            } else {
                updateInfoIcon(0, 0);
            }
        })
        .catch(console.error);
}

getNumberOfOrders();

let updateInfoIcon = (articles, total) => {
    let numberElement = document.getElementById('number_articles_in_car');
    let priceElement = document.getElementById('price_article_in_car');

    numberElement.innerHTML = articles;
    priceElement.innerHTML = '$ ' + total;
}