// ##################################################
// VARS CUSTOM
pm.collectionVariables.set('ROUTE_CURRENT', 'Tournaments/Select');
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

function getCustomRequest() {
    const IDTournament = 707304;
    const IDUser = 281216149;
    const Status = 1;
    const Balance = 500;
    
    return {
        IDTournament,
        IDUser,
        Status,
        Balance,
    };
}

options.customRequest = getCustomRequest();

// ##################################################

LOYALTY.go(pm, request.data, ClientKey, ClientPWD, options);
