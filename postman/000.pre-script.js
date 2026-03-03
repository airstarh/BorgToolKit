let script = [];
const files = [
    'http://borg.home/BorgToolKit/postman/loy/collection.pre-script.js',
    'http://borg.home/BorgToolKit/postman/loy/mockup.js',
    'http://borg.home/BorgToolKit/postman/loy/route/Events-Bundle.js',
];

function sewaPromises(f, order) {
    return new Promise((resolve, reject) => {
        pm.sendRequest(f, (err, res) => {
            if (err) {
                console.log(err);
                reject();
            } else {
                script[order] = res.text();
                resolve();
            }
        });
    });
}

const promises = files.map((el, order) => sewaPromises(el, order));

Promise.all(promises)
    .then(results => {
        eval(script.join('\n'));
    })
    .catch(error => {
        console.error('Error fetching data:', error);
    });