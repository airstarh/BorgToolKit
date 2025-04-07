let script = '';
const f1 = 'http://borg.home/BorgToolKit/code_examples/postman/patterns/sg-collection-pre-request.js';
const f2 = 'http://borg.home/BorgToolKit/code_examples/postman/patterns/sg-event-bundle.js';


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

const promise1 = sewaPromises(f1);
const promise2 = sewaPromises(f2);

Promise.all([promise1, promise2])
    .then(results => {

        console.log('XXXXXXXX');
        console.log(script);

        eval(script);
    })
    .catch(error => {
        console.error('Error fetching data:', error);
    });