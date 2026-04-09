1; // ##################################################
// VARS CUSTOM
pm.collectionVariables.set("ROUTE_CURRENT", "Lotteries/Get");
const ROUTE_CURRENT = pm.collectionVariables.get("ROUTE_CURRENT");
const options = {
  ROUTE_CURRENT: ROUTE_CURRENT,
};
let ClientKey = "";
let ClientPWD = "";
const Merchant = 958;
let counter = 0;

// ##################################################
ClientKey = mockup.Devcasino.ClientKey;
ClientPWD = mockup.Devcasino.ClientPWD;
// ##################################################

function getCustomData() {
  const XSS = "<script>a=b</script>";
  const NAME = "XXX 1000";
  const DATE_1 = "2026-04-10 16:21:59";
  const DATE_2 = "2026-04-11 16:21:59";
  const DATE_3 = "2026-04-11 17:21:59";

  const customData = {
    ForWLC: "1",
    OnlyPastWithMembers: "1",
    Period: "front-current",
    Currency: "EUR",
    WithWinners: "1",
    WinnersLimit: "10",
    PageLength: "1",
    TID: "",
    Hash: "",
    req_uniq_id:
      "fundist-loyalty-qa1-697868b847-ggkqv:21:d164cd44c632f83e25b7dd0c9c8c9da6",
  };

  return customData;
}

options.customRequest = getCustomData();

// ##################################################

LOYALTY.go(pm, request.data, ClientKey, ClientPWD, options);
