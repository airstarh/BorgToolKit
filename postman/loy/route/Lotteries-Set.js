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
  const ID = 54738;
  const XSS = "<script>a=b</script>";
  const NAME = "Name XXX 1000...";
  const NAME_CYR = "Имя Кириллические символы... ¯_(ツ)_/¯";
  const DESCTIPTION = "Description XXX 1000...";
  const DESCTIPTION_CYR = "Описание Кириллические символы... ¯_(ツ)_/¯";
  const ALIAS = "Only_Latin-letters";
  const DATE_1 = "2026-04-17 16:21:59";
  const DATE_2 = "2026-04-18 16:21:59";
  const DATE_3 = "2026-04-18 17:21:59";

  const customData = {
    JSON: {
      ID: ID,
      Name: {
        en: `${NAME}`,
        ru: `${NAME_CYR}`,
      },
      Description: {
        en: `${DESCTIPTION}`,
        ru: DESCTIPTION_CYR,
      },
      Terms: {
        en: "month terms322",
      },
      Images: {
        main: "https://tes222.com/url",
        description: "https://te222st.com/url",
      },
      LimitTicketsPerDeposit: 5,
      CancelUponWithdrawal: {
        EUR: 1,
        RUB: 1,
        USD: 1,
      },
      Price: {
        EUR: 1,
        RUB: 1,
        USD: 1,
      },
      DateStart: DATE_1,
      DateEnd: DATE_2,
      DrawingDate: DATE_3,
      Repeat: "month",
      Alias: `${ALIAS}`,
      Conditions: {
        Levels: [],
        DuplicateLevels: [],
        LanguageRestrictType: 0,
        Languages: [],
        RegionRestrictType: 0,
        Regions: [],
        CategoriesRestrictType: 0,
        Categories: [],
      },
      Results: [
        {
          Place: 1,
          Count: 2,
          Type: "bonus",
          Value: 5,
        },
      ],
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
