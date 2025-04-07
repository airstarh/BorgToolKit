const uuid = require('uuid');
const crypto = require('crypto-js');

LOYALTY = {

    notDefined: 'NOT_DEFINED_AT_ALL',

    pm: {},

    go: function (pm, pmRequestBody, ClientKey, ClientPWD, options = {}) {

        // VARS AUTO
        this.pm = pm;
        const TID = uuid.v4();
        const hashArray = [];

        // ~...
        if (options.customRequest) {
            Object.assign(pmRequestBody, options.customRequest);
        }

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

                default:
                    let val = options?.customRequest[PostKey] || this.notDefined;
                    if (val !== this.notDefined) {

                        if (val && typeof val === 'object') {
                            val = JSON.stringify(val);
                        }

                        pmRequestBody[PostKey] = val;
                        //pm.collectionVariables.set(PostKey, pmRequestBody[PostKey]);
                    }
                    break;
            }

            const PostValue = pmRequestBody[PostKey];
            hashArray.push(`${PostKey}=${PostValue}`);

        });

        const hash = this.getHash(
            ClientKey,
            options.ROUTE_CURRENT,
            hashArray,
            ClientPWD
        );

        pmRequestBody.Hash = hash;
        pm.collectionVariables.set('Hash', hash);
        pm.collectionVariables.set('ClientKey', ClientKey);

        //TODO: Make for various types of Body.
        this.setPmRequestBodyUrlencoded(pmRequestBody);
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

    setPmRequestBodyUrlencoded: function (json) {
        const res = [];
        for (const [key, value] of Object.entries(json)) {
            res.push({ key: key, value: value });
        }

        this.pm.request.body.update({
            mode: "urlencoded",
            urlencoded: res
        });

        return this.pm.request.body;
    },

    getBodyEnabledKeys: function () {
        const enabledParams = this.pm.request.body.urlencoded.filter(el => !el.disabled);
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