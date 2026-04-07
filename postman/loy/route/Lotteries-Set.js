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
  const customData = {
    JSON: {
      Name: {
        en: "XXX 1001",
      },
      Images: {
        description: "",
        main: "",
      },
      Price: {
        EUR: 1,
      },
      DateStart: "2026-04-06 16:21:59",
      DateEnd: "2026-04-07 16:21:59",
      DrawingDate: "2026-04-07 17:21:59",
      Repeat: "once",
      Alias: "XXX 1001",
      Conditions: {
        Levels: [3, 5],
        DuplicateLevels: [3],
        LanguageRestrictType: 1,
        Languages: ["bg", "fr", "de"],
        RegionRestrictType: 1,
        Regions: ["ru"],
        CategoriesRestrictType: 1,
        Categories: [7, 10],
      },
      Results: [
        {
          Type: "product",
          Count: 1,
          Name: {
            en: "QATEST_LOTTERY_RESTRICTIONS",
          },
          Place: 1,
        },
      ],
    },
    TID: "",
    qatest: "1",
    Hash: "",
    // "req_uniq_id": "site11-retn-dev-2:1138219:1775492519.063:ae7bc1038da095f11a8800cb1d9b29be"
  };

  return customData;
}

options.customRequest = getCustomData();

// ##################################################

LOYALTY.go(pm, request.data, ClientKey, ClientPWD, options);
