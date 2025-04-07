// ##################################################
// VARS CUSTOM
pm.collectionVariables.set('ROUTE_CURRENT', 'Events/Bundle');
const ROUTE_CURRENT = pm.collectionVariables.get('ROUTE_CURRENT');
const options = {
    ROUTE_CURRENT: ROUTE_CURRENT,
};
let ClientKey = '';
let ClientPWD = '';
const Merchant = 958;

// ##################################################
ClientKey = mockup.Devcasino.ClientKey;
ClientPWD = mockup.Devcasino.ClientPWD;
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
                "Amount": LOYALTY.getRandomInteger(),
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
                "AmountOrig": LOYALTY.getRandomInteger(),
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
                "Amount": LOYALTY.getRandomInteger(),
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

options.customData = getCustomData();

// ##################################################

LOYALTY.go(pm, request.data, ClientKey, ClientPWD, options);
