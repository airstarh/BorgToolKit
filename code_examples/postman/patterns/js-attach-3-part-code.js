let script = '';
const files = [
    'http://borg.home/BorgToolKit/code_examples/postman/patterns/sg-collection-pre-request.js',
    'http://borg.home/BorgToolKit/code_examples/postman/patterns/sg-event-bundle.js',
];

function sewaPromises(f) {
    return new Promise((resolve, reject) => {
        pm.sendRequest(f, (err, res) => {
            if (err) {
                console.log(err);
                reject();
            } else {
                script += res.text();
                resolve();
            }
        });
    });
}

const promises = files.map(el => sewaPromises(el));

Promise.all(promises)
    .then(results => {
        eval(script);
    })
    .catch(error => {
        console.error('Error fetching data:', error);
    });