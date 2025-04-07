const uuid = require('uuid');
const crypto = require('crypto-js');

LOYALTY = {

    notDefined: 'NOT_DEFINED_AT_ALL',

    go: function (pm, pmRequestBody, customData, ClientKey, ClientPWD, options = {}) {

        // VARS AUTO
        const TID = uuid.v4();
        const hashArray = [];
        let counter = 0;

        // REQUEST BODY
        Object.keys(pmRequestBody).sort().forEach(PostKey => {

            switch (PostKey) {
                case 'Hash':
                    return;
                    break;

                case 'TID':
                    pmRequestBody['TID'] = TID;
                    pm.collectionVariables.set('TID', TID);
                    break;

                case 'Data':

                    if (options.processEvent) {
                        for (IdUserKey in customData) {
                            customData[IdUserKey].map(event => {

                                counter++;

                                event.ID = new Date().getTime() + counter;

                            })
                        }
                    }

                    pmRequestBody['Data'] = JSON.stringify(customData);
                    pm.collectionVariables.set('Data', pmRequestBody['Data']);

                    break;

                default:
                    let val = options[PostKey] || this.notDefined;
                    if (val !== this.notDefined) {
                        pmRequestBody[PostKey] = val;
                        //pm.collectionVariables.set(PostKey, pmRequestBody[PostKey]);
                    }
                    break;
            }

            hashArray.push(`${PostKey}=${pmRequestBody[PostKey]}`);
        });

        const hash = this.getHash(
            ClientKey,
            options.ROUTE_CURRENT,
            hashArray,
            ClientPWD
        );

        pm.collectionVariables.set('Hash', hash);
        pm.collectionVariables.set('ClientKey', ClientKey);

    },

    // ##################################################
    // region SYSTEM

    getHash: function (ClientKey, ROUTE_CURRENT, reqArray, ClientPWD) {
        const hashArray = [
            ClientKey,
            ROUTE_CURRENT,
            ...reqArray,
            ClientPWD
        ];
        const hashString = hashArray.join('/');
        const hash = crypto.MD5(hashString).toString();
        return hash;

    },

    pm: {},

    request: {},

    _pm: function (pm) {
        if (typeof pm !== 'undefined') {
            this.pm = pm;
        }

        return this.pm;
    },

    setPmRequest: function (obj) {
        for (const [key, value] of Object.entries(obj)) {
            this.pm.request.set();
        }
    },

    getBodyEnabledKeys: function () {
        const enabledParams = pm.request.body.urlencoded.filter(el => !el.disabled);
        return enabledParams;
    },

    // eend region SYSTEM
    // ##################################################
    // region URILS

    getRandomInteger: function () {
        return Math.floor(Math.random() * 50) + 1;
    },

    // endregion URILS
    // ##################################################
};