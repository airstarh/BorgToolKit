const lib = 'http://borg.home/BorgToolKit/code_examples/postman/loyalty/collection-pre-request.js';

pm.sendRequest(lib, (error, response) => {
    if (error || response.code !== 200) {
        pm.expect.fail('Could not load external library');
    }

    eval(response.text());

});