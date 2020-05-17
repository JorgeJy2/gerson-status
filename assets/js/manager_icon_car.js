let getNumberOfOrders = () => {
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

getNumberOfOrders();

let updateInfoIcon = (articles, total) => {
    let numberElement = document.getElementById('number_articles_in_car');
    let priceElement = document.getElementById('price_article_in_car');

    numberElement.innerHTML = articles;
    priceElement.innerHTML = '$ ' + total;
}