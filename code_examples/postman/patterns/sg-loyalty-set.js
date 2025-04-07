// ##################################################
// VARS CUSTOM
pm.collectionVariables.set('ROUTE_CURRENT', 'Loyalty/Set');
const ROUTE_CURRENT = pm.collectionVariables.get('ROUTE_CURRENT');
const options = {
    ROUTE_CURRENT: ROUTE_CURRENT,
};
let ClientKey = '';
let ClientPWD = '';
const Merchant = 958;
const customData = {};
// ##################################################
ClientKey = mockup.Kent.ClientKey;
ClientPWD = mockup.Kent.ClientPWD;
// ##################################################

function getCustomRequest() {

    return {
        "TID": "FUNDIST",
        "Audit": {
            "User": { "ID": "277843658", "IP": "91.202.25.124", "Login": "vazovsky" }
        },
        "IDUser": "279814915",
        "Level": "2",
        "Points": "12.0000",
        "NextLevelPoints": "100",
        "BonusRestrictions": {
            "RestrictCasinoBonuses": {
                "State": 1,
                "IDUser": 277843658,
                "Time": "2025-04-07 13:49:49"
            },
            "RestrictSportBonuses": {
                "State": 1,
                "IDUser": 277843658,
                "Time": "2025-04-07 13:49:49"
            },
            "RestrictPokerBonuses": {
                "State": 0,
                "IDUser": 277843658,
                "Time": "2025-04-07 13:49:49"
            }
        },
        // "Hash": "ede5e38512d3278786550984e0e4a29c",
        "req_uniq_id": "site2-deac-qa-1:1508339:1744033789.986:46fb9c1dff9efc467dc533119fb96999"
    };
}

options.customRequest = getCustomRequest();

// ##################################################

// ##################################################

LOYALTY.go(pm, request.data, customData, ClientKey, ClientPWD, options);
