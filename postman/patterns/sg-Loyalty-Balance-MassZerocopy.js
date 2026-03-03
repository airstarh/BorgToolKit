// ##################################################
// VARS CUSTOM
pm.collectionVariables.set('ROUTE_CURRENT', 'Loyalty/Balance/MassReset');
const ROUTE_CURRENT = pm.collectionVariables.get('ROUTE_CURRENT');
const options = {
    ROUTE_CURRENT: ROUTE_CURRENT,
};
let ClientKey = '';
let ClientPWD = '';
const Merchant = 958;
let counter = 0;

// ##################################################
ClientKey = mockup.vasovsky.ClientKey;
ClientPWD = mockup.vasovsky.ClientPWD;
// ##################################################

function getCustomData() {
    let customData = {
        list: [
            175382404967,
            { a: 'a' },
            [1,2,3],
            -1,
            '-100',
            'asdf',
            null,
            "175393244208",
            175393244209,
            175393244210,
            175393244211,
            175393244212,
            175393244213,
            175393244214,
            175393244215,
            175393244216,
            175393244217,
        ]
    }
    return customData;
}

options.customRequest = {};
options.customRequest = getCustomData();

// ##################################################

LOYALTY.go(pm, request.data, ClientKey, ClientPWD, options);
