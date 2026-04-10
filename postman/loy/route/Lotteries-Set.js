1; // ##################################################
// VARS CUSTOM
pm.collectionVariables.set("ROUTE_CURRENT", "Lotteries/Set");
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
  const ALIAS = "ALIAS";
  const DATE_1 = "2026-04-10 16:21:59";
  const DATE_2 = "2026-04-11 16:21:59";
  const DATE_3 = "2026-04-11 17:21:59";

  const customData = {
    JSON: {
      ID: 54738,
      Name: {
        en: `${NAME}`,
        ru: `${NAME}`,
        // ru: `${NAME} ${XSS}`,
      },
      Description: {
        // en: `${NAME}`,
        en: `${NAME}`,
        ru: `${NAME}`,
        // ru: `${NAME} ${XSS}`,
      },
      Images: {
        description: "http://as.as/?s=1&a=2",
        main: "",
      },
      Price: {
        EUR: 1,
        RUB: 0.12,
        USD: 0.1,
        BYN: "+0.1",
      },
      DateStart: DATE_1,
      DateEnd: DATE_2,
      DrawingDate: DATE_3,
      Repeat: "once",
      Alias: `${ALIAS}`,
      // Alias: `${NAME} ${XSS}`,
      Conditions: {
        Levels: [1, 2],
        DuplicateLevels: [3],
        LanguageRestrictType: 1,
        Languages: ["bg", "fr", "de"],
        RegionRestrictType: 1,
        Regions: ["ru"],
        CategoriesRestrictType: 1,
        Categories: [1, 2],
      },
      Results: [
        {
          Type: "product",
          Count: 1,
          Name: {
            en: "QATEST_LOTTERY_RESTRICTIONS",
            // ru: `${XSS}`,
          },
          Place: 1,
        },
      ],
      LimitTicketsPerDeposit: 0,
    },
    TID: "",
    Hash: "",
    qatest: "1",
    // "req_uniq_id": "site11-retn-dev-2:1138219:1775492519.063:ae7bc1038da095f11a8800cb1d9b29be"
  };

  return customData;
}

options.customRequest = getCustomData();

// ##################################################

LOYALTY.go(pm, request.data, ClientKey, ClientPWD, options);
