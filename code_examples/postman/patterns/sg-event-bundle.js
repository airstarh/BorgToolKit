// const LOYALTY = require('https://borg.home/BorgToolKit/code_examples/postman/patterns/sg-collection-pre-request.js');


// ##################################################
// VARS CUSTOM
let ClientKey = '';
let ClientPWD = '';
let IDUser = 0;
const Merchant = 958;

// ##################################################
// DevCasino
ClientKey = '0d8f8cb8c23b1fdd962eb62d79359b47';
ClientPWD = '2046045182213637';
// ###
// ##################################################

function getUserIds() {
    const userIds = [
        279394074,
        279394173,
        279394199,
        // 279425387,
        // 279425388,
        // 279428177,
        // 279428549,
        // 279430676,
        // 279430718,
        // 279430744,
        // 279430779,
        // 279433061,
        // 279433092,
        // 279433126,
        // 279433145,
        // 279433895,
        // 279433903,
        // 279433921,
        // 279433951,
        // 279433962,
        // 279434032,
        // 279434100,
        // 279434174,
        // 279434216,
        // 279434289,
        // 279434363,
        // 279434406,
        // 279434477,
        // 279434553,
        // 279434581,
        // 279434609,
        // 279434651,
        // 279434692,
        // 279434707,
        // 279434754,
    ];

    return userIds;
}

function getEventArray(IDUser) {
    const events = [
        {
            "IDUser": IDUser,
            "Event": "Win",
            "Data": {
                "Amount": getRandomInteger(),
                "Merchant": Merchant,
                "Balance": "2",
                "IDRound": "123",
                "BonusActionData": { "action_data": [] }
            }
        },
        {
            "IDUser": IDUser,
            "Event": "Bet",
            "Data": {
                "Amount": "100",
                "AmountOrig": getRandomInteger(),
                "Currency": "EUR",
                "Merchant": Merchant,
                "Balance": "2",
                "IDRound": "123",
                "BonusActionData": { "action_data": [] }
            }
        },
        {
            "IDUser": IDUser,
            "Event": "Bet",
            "Data": {
                "Amount": getRandomInteger(),
                "AmountOrig": "1",
                "Currency": "EUR",
                "Merchant": Merchant,
                "Balance": "2",
                "IDRound": "123",
                "BonusActionData": { "action_data": [] }
            }
        },
    ];

    return events;
}

function getRandomInteger() {
    return Math.floor(Math.random() * 50) + 1;
}

function getCustomData() {

    const customData = {};
    const userIds = getUserIds();

    for (let i = 0; i < userIds.length; i++) {
        const IDUser = userIds[i];
        const eventArray = getEventArray(IDUser);
        customData[IDUser] = eventArray;
    }

    return customData;
}

const customData = getCustomData();



// ###

const options = {
    _url_path_key: '/Events/Bundle/'
};
// ##################################################

//const refBody = pm.request.body.toJSON();
const refBody = request.data;
console.log('XXXXXXXX');
console.log(refBody);
console.log(pm.request.body);

LOYALTY.go(pm, refBody, customData, ClientKey, ClientPWD, options);
