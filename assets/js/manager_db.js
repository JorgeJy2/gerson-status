let db = new PouchDB('buys');
let remoteCouch = false;


/**
 * Save in DB de order selected
 * @param {*} id_product 
 * @param {*} id_order 
 */

let saveOrderDB = (id_product, id_order) => {
    return new Promise((resolve, reject) => {
        db.put({ _id: id_product + '', id_order },
            (err, result) => {
                if (!err)
                    resolve(true);
                else
                    reject(false);
            });
    });
}


let deleteOrderDB = (id_product) => {
    return new Promise((resolve, reject) => {
        db.get(id_product + '').then(doc => {
                return db.remove(doc);
            })
            .then(resolve)
            .catch(reject);
    });

}

/**
 * Found order of product in DB
 * return Obj {
 *  found: BOOLEAN
 *  ...data in db.
 *  }
 *  
 * @param {*} id_product 
 */

let findOrderProductDB = id_product => {
    return new Promise((resolve, reject) => {
        db.get(id_product + '').then(doc => {
            resolve({ found: true, ...doc });
        }).catch(err => {
            if (err.name === 'not_found')
                resolve({ found: false });
            else
                reject(err.name);
        });
    });
}


let getAllOrdersDB = () => {
    return new Promise((resolve, reject) => {
        db.allDocs({ include_docs: true, descending: true },
            (err, doc) => {
                if (err)
                    reject(err);
                else
                    resolve(doc.rows);
            }
        );
    });
}