// ##################################################
// VARS CUSTOM
pm.collectionVariables.set('ROUTE_CURRENT', 'Bonuses/Canceled');
const ROUTE_CURRENT = pm.collectionVariables.get('ROUTE_CURRENT');
const options = {
    ROUTE_CURRENT: ROUTE_CURRENT,
};
let ClientKey = '';
let ClientPWD = '';
const Merchant = 958;
// ##################################################
ClientKey = mockup.JackpotCasino.ClientKey;
ClientPWD = mockup.JackpotCasino.ClientPWD;
// ##################################################

function getCustomRequest() {

    return {
        "LimitStart": "0",
        "LimitTotal": "10000",
        "EndDateFrom": "11.04.2023",
        "EndDateTo": "11.04.2025",
        "IDBonus": "2948945",
        "Order": { "CanceledWageringInEur": "DESC" },
        "TID": "FUNDIST",
        "Source": "Fundist",
        "Audit": {
            "User": { "ID": "277843658", "IP": "91.202.25.124", "Login": "vazovsky" }
        },
        "Hash": "01727d73b158427975367da5dcd60d4f",
        "req_uniq_id": "site11-retn-dev-2:2235918:1744339953.520:55209967f7937c6473828b93ec8bd753"
    }
        ;
}

options.customRequest = getCustomRequest();

// ##################################################

// ##################################################

LOYALTY.go(pm, request.data, ClientKey, ClientPWD, options);
