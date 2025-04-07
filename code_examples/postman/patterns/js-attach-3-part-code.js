let script = [];
const files = [
    'http://borg.home/BorgToolKit/code_examples/postman/patterns/sg-collection-pre-request.js',
    'http://borg.home/BorgToolKit/code_examples/postman/patterns/mockup.js',
    'http://borg.home/BorgToolKit/code_examples/postman/patterns/sg-events-bundle.js',
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