let ordes = [];

let getAllOrdes = () => {
    getAllOrdersDB()
        .then(rows => {
            rows.forEach(row => ordes.push(row.doc.id_order));
            getFetchOrders(ordes.join(','));
        }).catch(console.error);
};

getAllOrdes();


let getFetchOrders = id_ordes => {
    let formdata = new FormData();
    formdata.append('id_orders', id_ordes);
    fetch('./logic/car/car_get.php', {
            method: 'POST',
            body: formdata
        }).then(response => response.json())
        .then(coreOrders)
        .catch(console.error);
}

let coreOrders = response => {
    if (response.ok) {
        console.log(response);
        let containerOrder = document.getElementById('container_orders');
        containerOrder.innerHTML = '';

        response.orders.forEach(order =>
            containerOrder.insertAdjacentHTML('beforeend', htmlOrder(order))
        );

        let textTotal = document.getElementById('total_car_price');
        textTotal.innerHTML = response.total_carrito;
    }
}

let htmlOrder = (order) => {
    return `<tr id="th_order_${order.id_producto}">
        <td>
        <img  class="imagen_product" src="./${order.producto_imagen}">
        ${order.nombre_producto}
        </td>
        <td>
            <label id="price_${order.id}">
                ${order.precio_producto}
            </label>
        </td>
        <td><input type="number" value="${order.cantidad}" onchange="change_cuantity_product(event,${order.id})" min="1"></td>
        <td>
            <label id="total_${order.id}">
                ${order.total}
            </label>
        </td>
        <td><button onclick="deleteCarOrder(${order.id_producto})" class="btn  btn-danger">X</button></td>
    </tr>`;
}