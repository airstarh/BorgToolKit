1; // ##################################################
// VARS CUSTOM
pm.collectionVariables.set("ROUTE_CURRENT", "Store/Items/List");
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
    TID: "FUNDIST",
    ID: "252838",
    Hash: "",
    req_uniq_id:
      "site11-retn-dev-2:3740439:1775755970.734:662feadfd4e54eb939c07f59d6f30834",
  };

  return customData;
}

options.customRequest = getCustomData();

// ##################################################

LOYALTY.go(pm, request.data, ClientKey, ClientPWD, options);
