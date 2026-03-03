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

    getEventId: function (counter) {
        return new Date().getTime() + counter;
    },

    // endregion URILS
    // ##################################################
    // region IN TEST

    /*
    * AI Edition
    +
    */
    convertPmRequestToFlatJson: function () {
        let bodyData;

        if (pm.request.body) { // Check if a body exists

            const bodyMode = pm.request.body.mode;

            switch (bodyMode) {
                case 'raw':
                    try {
                        bodyData = JSON.parse(pm.request.body.raw); // Try parsing as JSON
                        // Now you can iterate through the object properties:
                        if (typeof bodyData === 'object' && bodyData !== null) { // Check it's a valid object
                            for (const key in bodyData) {
                                if (bodyData.hasOwnProperty(key)) {
                                    const value = bodyData[key];
                                    console.log(`Raw (JSON) - Key: ${key}, Value: ${value}`);
                                    // Do something with key and value, e.g., set an environment variable:
                                    pm.environment.set(`body_${key}`, value);
                                }
                            }
                        } else {
                            console.log("Raw body is not a JSON object.");
                            console.log("Raw body is: ", pm.request.body.raw); // Print the raw body
                        }

                    } catch (e) {
                        console.log("Raw body is not valid JSON.  Processing as plain text.");
                        console.log("Raw body is: ", pm.request.body.raw); // Print the raw body
                        // Handle raw body as plain text if JSON parsing fails.
                        // Example:  Set a variable with the entire raw body content
                        pm.environment.set("rawBodyContent", pm.request.body.raw);
                    }
                    break;

                case 'formdata':
                    bodyData = pm.request.body.formdata;
                    // Iterate through the formdata entries:
                    bodyData.each(function (item) {
                        console.log(`Formdata - Key: ${item.key}, Value: ${item.value}`);

                        // Handle multiple values for the same key (common for file uploads)
                        if (Array.isArray(item.value)) {
                            item.value.forEach((val, index) => {
                                console.log(`  Value ${index}: ${val}`);
                                pm.environment.set(`formdata_${item.key}_${index}`, val);
                            });
                        } else {
                            pm.environment.set(`formdata_${item.key}`, item.value);
                        }

                    });
                    break;

                case 'urlencoded':
                    bodyData = pm.request.body.urlencoded;
                    // Iterate through the urlencoded entries:
                    bodyData.each(function (item) {
                        console.log(`Urlencoded - Key: ${item.key}, Value: ${item.value}`);
                        pm.environment.set(`urlencoded_${item.key}`, item.value);
                    });
                    break;

                case 'graphql':
                    try {
                        bodyData = JSON.parse(pm.request.body.graphql.variables); // Access variables
                        // Iterate through the variables object
                        if (typeof bodyData === 'object' && bodyData !== null) {
                            for (const key in bodyData) {
                                if (bodyData.hasOwnProperty(key)) {
                                    const value = bodyData[key];
                                    console.log(`GraphQL Variables - Key: ${key}, Value: ${value}`);
                                    pm.environment.set(`graphql_var_${key}`, value);
                                }
                            }
                        }

                        const query = pm.request.body.graphql.query; // Access the GraphQL query
                        console.log("GraphQL Query:", query);
                        pm.environment.set("graphql_query", query);

                    } catch (e) {
                        console.error("Error parsing GraphQL variables:", e);
                    }
                    break;

                default:
                    console.log("Unknown body mode:", bodyMode);
            }
        } else {
            console.log("No request body found.");
        }
    }
    // endregion IN TEST
    // ##################################################
};