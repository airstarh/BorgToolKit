let script = [];
const files = [
  "https://borg.home:40443/BorgToolKit/postman/loy/collection.pre-script.js",
  "https://borg.home:40443/BorgToolKit/postman/loy/mockup.js",
  "https://borg.home:40443/BorgToolKit/postman/loy/route/Events-Bundle.js",
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