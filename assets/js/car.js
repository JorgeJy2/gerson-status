let change_cuantity_product = (event, id_car) => {
    let cuantity = event.srcElement.value;

    let price = document.getElementById(`price_${id_car}`).innerText;
    let total = price * cuantity;

    let element_total = document.getElementById(`total_${id_car}`);
    element_total.innerHTML =total;

    console.log({
        id_car,
        cuantity
    });
    fetch('./logic/car/car_update.php', {
            method: 'POST',
            body: formEncode({
                id_car,
                cuantity
            }),
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }

        }).then(data => data.json())
        .then(response => {
            console.log(response);
            if (response.ok) {
                updatePriceView();
            } else {
                console.log('FALSE::');
            }
        })
        .catch(console.log);
}

let updatePriceView = () => {
    getAllOrdersDB()
        .then(rows => {
            let sizeProducts = rows.length;
            if (sizeProducts > 0) {
                let products = [];
                rows.forEach(row => products.push(row.doc.id_order));

                let formData = new FormData();
                formData.append('orders', products.join(',').toString());
                fetch('./logic/car/get_total.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(totalResponse => {
                        if (totalResponse.ok) {
                            document.getElementById(`total_car_price`).innerHTML = "$ " + totalResponse.total;
                            updateInfoIcon(sizeProducts, totalResponse.total);
                        }
                    })
                    .catch(console.log);
            } else {
                updateInfoIcon(0, 0);
            }

        })
        .catch(console.error);
}



let deleteCarOrder = (id_product) => {
    addOrDeleteOrderServerDB(id_product).then(response => {
        if (response.delete) {
            removeOrderCar(id_product);
            updatePriceView();
        }
    }).catch(alert);
}

let removeOrderCar = (id_product) => {
    let elmentTh = document.getElementById('th_order_' + id_product);
    elmentTh.innerHTML = '';
}

let deleteOrderViewAndDB = (id_product) => {
    deleteOrderDB(id_product)
        .then(response => {
            removeOrderCar(id_product);
        })
        .catch(error => console.log('No se pudo eliminar la orden en el cache'));

}


let buy_car = (id_user) => {
    let products = [];
    getAllOrdersDB()
        .then(rows => {
            rows.forEach(row => products.push(row.doc.id_order));
            if (products.length > 0) {
                let formData = new FormData();

                formData.append('id_user', id_user);
                formData.append('orders', products.join(',').toString());

                fetch('./logic/car/buy_products.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    // .then(console.log)
                    .then(responseAdd => {
                        if (responseAdd.ok) {
                            responseAdd.ordes_addes.forEach(deleteOrderViewAndDB);
                            let element_total = document.getElementById(`total_car_price`);
                            element_total.innerHTML = '0';
                            showResult(responseAdd.bill);
                        }
                    })
                    .catch(err=>console.log('Error en peticion comprar productos ', err));

            } else {
                console.log('sin productos');
            }
        }).catch(console.error);

}

let showResult = (bill) => {
    let element = document.getElementById('result_buy');
    element.innerHTML = `<div class="row ">
        <div class="col-md-12 text-center">
            <h3>¡Compra realizada!</h3>
            <hr>
            <h4>Muchas gracias por comprar</h4>
            <a href="./index.php">
                <button id="btn-access-login" class="btn btn-car-primary-register btn-block  mt-3">Segir comprando</button>
            </a>
            <a href="./${bill}">
                <button id="btn-access-login" class="btn btn-car-primary-register btn-block  mt-3">Ver mi factura</button>
            </a>
        </div>
    </div>`;
    document.getElementById('car_view').innerHTML = '';

}