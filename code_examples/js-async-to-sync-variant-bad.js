function getAllFRMerchants(data, success = null) {

    let response = cacheManager.getResponse('getAllFRMerchants', data);

    if (typeof response === 'object' && Object.keys(response).length) {
        if (success) {
            success(response);
        }
        return response;
    } else {
        response = undefined;
    }

    for (let counter = 0;
         counter <= 2
         && response === undefined;
         counter++) {
        $.ajax({
            url: URL_ROOT + '/Merchants/GetFrMerchants',
            type: 'POST',
            data: data,
            async: false,
            success: function (answ) {
                cacheManager.saveRequest('getAllFRMerchants', data, answ);
                response = cacheManager.getResponse('getAllFRMerchants', data);

                if (typeof response === 'object' && Object.keys(response).length) {
                    if (success) {
                        success(response);
                    }
                    return response;
                } else {
                    response = undefined;
                }
            }
        });
    }

    return response;
}