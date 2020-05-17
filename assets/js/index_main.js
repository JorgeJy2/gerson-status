/**
 * Draw GUI all products categorys
 */

let selectAllProducts = () => {
    fetch('./logic/product/select_product.php')
        .then(data => data.json())
        .then(drawProducts)
        .catch(console.log);
};

/**
 * Update de  GUI with de category selected
 * @param {*} idCategory 
 */

let selectCategory = (idCategory) => {
    fetch('./logic/product/select_product.php', {
            method: 'POST',
            body: formEncode({ category: idCategory }),
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        })
        .then(data => data.json())
        .then(drawProducts)
        .catch(console.log);
};

/**
 * Search product in txt search href = search.hml
 * @param {*} event 
 */

let searchProduct = (event) => {
    //Key enter == 13
    if (event.keyCode === 13) {
        let inSearchElement = document.getElementById("input_search_nav");
        window.location.href = `search.php?value=${inSearchElement.value}`;
    }
}

let drawProducts = (response) => {
    let container_products = document.getElementById('container_products');
    container_products.innerHTML = '';
    response.productos.forEach(producto =>
        container_products.insertAdjacentHTML('beforeend', createProduct(producto))
    );

    updateIconCarProductsInDB();
};

let createProduct = (producto) => {
    return `<a href="details_product.php?id=${producto.id_producto}">
                <div id="1" class="product-car mx-auto shadow-sm rounded">
                    <div class="row">
                        <div class="col-10">
                            <strong>${producto.producto}</strong>
                            <p>$${producto.preven}</p>
                        </div>
                        <div class="col-2 text-right">
                            <i class="fa fa-shopping-cart" id="ic_car_${producto.id_producto}" onclick="newOrder(${producto.id_producto})"  aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="product-image mt-4">
                        <img src="${producto.imagen}">
                    </div>
                </div>
            </a>`;
};