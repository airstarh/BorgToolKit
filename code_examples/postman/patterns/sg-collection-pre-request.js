
const uuid = require('uuid');
const crypto = require('crypto-js')

LOYALTY = {

    notDefined: 'NOT_DEFINED_AT_ALL',

    go: function (pm, refBody, customData, ClientKey, ClientPWD, options = {}) {

        // VARS AUTO
        const TID = uuid.v4();

        let hashString = '';
        const hashArray = [];
        let counter = 0;

        // REQUEST BODY
        Object.keys(refBody).sort().forEach(PostKey => {

            switch (PostKey) {
                case 'Hash':
                    return;
                    break;

                case 'TID':
                    refBody['TID'] = TID;
                    pm.collectionVariables.set('TID', TID);
                    break;

                case 'Data':
                    for (IdUserKey in customData) {
                        customData[IdUserKey].map(event => {

                            counter++;

                            event.ID = new Date().getTime() + counter;

                        })
                    }

                    refBody['Data'] = JSON.stringify(customData);
                    pm.collectionVariables.set('Data', refBody['Data']);

                    break;

                default:
                    let val = options[PostKey] || LOYALTY.notDefined;
                    if (val !== LOYALTY.notDefined) {
                        refBody[PostKey] = val;
                        pm.collectionVariables.set(PostKey, refBody[PostKey]);
                    }
                    break;
            }

            hashArray.push(PostKey + '=' + refBody[PostKey]);
        });

        hashString = hashArray.join('/');
        hashString = ClientKey + options._url_path_key + hashString + '/' + ClientPWD;
        const hash = crypto.MD5(hashString).toString();

        pm.collectionVariables.set('Hash', hash);
        pm.collectionVariables.set('ClientKey', ClientKey);

        // endregion QUERY
        // ##################################################

    },

    getBodyEnabledKeys: function () {
        const enabledParams = pm.request.body.urlencoded.filter(el => !el.disabled);
        const objBody = {};
    },
};

