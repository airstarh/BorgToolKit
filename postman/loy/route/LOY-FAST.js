1; // ##################################################
// VARS CUSTOM
pm.collectionVariables.set(
  "ROUTE_CURRENT",
  "Loyalty/GetBonusesManuallyActivated"
);
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
    TID: "SEWA",
    Source: "Fundist",
    Audit: {
      User: {
        ID: "281674407",
        IP: "10.110.0.12",
        Login: "adm_vazovsky",
      },
    },
    From: "12.04.2026",
    To: "12.05.2026",
    IDOrName: "14267607",
    // TotalSum: "1",
    PageLength: "50",
    Order: {
      AddDate: "DESC",
    },
    Hash: "",
  };

  return customData;
}

options.customRequest = getCustomData();

// ##################################################

LOYALTY.go(pm, request.data, ClientKey, ClientPWD, options);
