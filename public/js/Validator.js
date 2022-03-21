class Validator {

    pausalniNaklad = [];
    servicesCost = [];
    appMeters = [];
    initialValue = [];
    endValue = [];
    meterNumber = [];
    coefficientValue = [];
    depositItems = [];
    depositItemsPrice = [];
    itemsStartDate = [];
    itemsFinishDate = [];
    damageDesc = [];
    itemsStartDateStyle = [];
    itemsFinishDateStyle = [];
    damageDescStyle = [];
    formData;



    constructor() {

        let pausalniNaklad = [];
        $('[name="pausalniNaklad[]"]').each(function(){pausalniNaklad.push($(this).val());})
        this.pausalniNaklad = pausalniNaklad;

        let servicesCost = [];
        $('[name="servicesCost[]"]').each(function (){servicesCost.push($(this).val());});
        this.servicesCost = servicesCost;

        let appMeters = [];
        $('[name="appMeters[]"]').each(function(){appMeters.push($(this).val());});
        this.appMeters = appMeters;

        let initialValue = [];
        $('[name="initialValue[]"]').each(function (){initialValue.push($(this).val());});
        this.initialValue = initialValue;

        let endValue = [];
        $('[name="endValue[]"]').each(function(){endValue.push($(this).val());});
        this.endValue = endValue;

        let meterNumber = [];
        $('[name="meterNumber[]"]').each(function(){meterNumber.push($(this).val());});
        this.meterNumber = meterNumber;

        let coefficientValue = [];
        $('[name="coefficientValue[]"]').each(function (){coefficientValue.push($(this).val());});
        this.coefficientValue = coefficientValue;

        let depositItems = [];
        $('[name="depositItems[]"]').each(function (){depositItems.push($(this).val());});
        this.depositItems =  depositItems;

        let depositItemsPrice = [];
        $('[name="depositItemsPrice[]"]').each(function (){depositItemsPrice.push($(this).val());});
        this.depositItemsPrice =  depositItemsPrice;

        let itemsStartDate = [];
        $('[name="itemsStartDate[]"]').each(function (){itemsStartDate.push($(this).val());});
        this.itemsStartDate =  itemsStartDate;

        let itemsStartDateStyle = [];
        $('[name="itemsStartDate[]"]').each(function (){itemsStartDateStyle.push($(this).parent('div').attr('style'));});
        this.itemsStartDateStyle =  itemsStartDateStyle;

        let itemsFinishDate = [];
        $('[name="itemsFinishDate[]"]').each(function (){itemsFinishDate.push($(this).val());});
        this.itemsFinishDate =  itemsFinishDate;

        let itemsFinishDateStyle = [];
        $('[name="itemsFinishDate[]"]').each(function (){itemsFinishDateStyle.push($(this).parent('div').attr('style'));});
        this.itemsFinishDateStyle =  itemsFinishDateStyle;

        let damageDesc = [];
        $('[name="damageDesc[]"]').each(function (){damageDesc.push($(this).val());});
        this.damageDesc =  damageDesc;

        let damageDescStyle = [];
        $('[name="damageDesc[]"]').each(function (){damageDescStyle.push($(this).parent('div').attr('style'));});
        this.damageDescStyle =  damageDescStyle;

    }

    createRequestServices () {

        this.formData = {
            landlordName: $("#landlordName").val(), //S, E, D
            landlordAddress: $("#landlordAddress").val(), //S, E, D
            accountNumber: $("#accountNumber").val(), //S, E, D
            propertyAddress: $("#propertyAddress").val(), //S, E, D
            propertyType: $('#propertyType').val(), //S, E, D
            tenantName: $('#tenantName').val(), //S, E, D
            tenantAddress: $('#tenantAddress').val(), //S, E, D
            adminName: $('#adminName').val(), //S
            supplierName: $('#supplierName').val(), //E
            calcStartDate: $("#calcStartDate").val(), //S
            calcFinishDate: $("#calcFinishDate").val(), //S
            rentStartDate: $("#rentStartDate").val(), //S, E, D
            rentFinishDate: $("#rentFinishDate").val(), //S, E, D
            rentFinishReason: $("#rentFinishReason").val(), //D
            initialValueOne: $("#initialValueOne").val(), //E
            endValueOne: $("#endValueOne").val(), //E
            meterNumberOne: $("#meterNumberOne").val(), //E
            electroPriceKWh: $("#electroPriceKWh").val(), //E
            electroPriceMonth: $("#electroPriceMonth").val(), //E
            pausalniNaklad: this.pausalniNaklad, //S
            servicesCost: this.servicesCost, //S
            appMeters: this.appMeters, //S
            initialValue: this.initialValue, //S
            endValue: this.endValue, //S
            meterNumber: this.meterNumber, //S
            depositItems: this.depositItems, //D
            depositItemsPrice: this.depositItemsPrice, //D
            itemsStartDate: this.itemsStartDate, //D
            itemsStartDateStyle: this.itemsStartDateStyle, //D
            itemsFinishDate: this.itemsFinishDate, //D
            itemsFinishDateStyle: this.itemsFinishDateStyle, //D
            damageDesc: this.damageDesc, //D
            damageDescStyle: this.damageDescStyle, //D
            coefficientValue: this.coefficientValue, //S
            constHotWaterPrice: $("#constHotWaterPrice").val(), //S
            constHeatingPrice: $("#constHeatingPrice").val(), //S
            hotWaterPrice: $("#hotWaterPrice").val(), //S
            coldWaterPrice: $("#coldWaterPrice").val(), //S
            coldForHotWaterPrice: $("#coldForHotWaterPrice").val(), //S
            heatingPrice: $("#heatingPrice").val(), //S
            advancedPayments: $('#advancedPayments').val(), //S, E
            deposit: $('#deposit').val() //D


        };

    }


    ajaxValidation(name, form){
        this.createRequestServices();
        $.ajax({
            type: "POST",
            url: `/validator/${name}-validation`,
            data: this.formData,
            dataType: "json",
            encode: true,
        })
            .done((data) => {
                console.log(data);
                $(".errors_field").append(
                    '<ul class = "errors" id = "errors"></ul>'
                );
                this.data = data;
                if (!data.success) {
                    switch (name) {
                        case "services":
                            this.validateServicesForm();
                            break;
                        case  "electro":
                            this.validateElectroForm();
                            break;
                        case  "deposit":
                            this.validateDepositForm();


                    }
                } else {
                    form.attr('action', `/applications/${name}-calc`).off('submit').submit();
                }
            })
            .fail(function(data){
                console.log("error");
                $(".errors_field").append(
                    '<p class = "errors">Server connection error! Please try later!</p>'
                );
            })

    }



   validateServicesForm(){

        this.processResponse('landlordName');
        this.processResponse('landlordAddress');
        this.processResponse('accountNumber');
        this.processResponse('propertyAddress');
        this.processResponse('propertyType');
        this.processResponse('tenantName');
        this.processResponse('tenantAddress');
        this.processResponse('adminName');
        this.processResponse('calcStartDate');
        this.processResponse('calcFinishDate');
        this.processResponse('rentStartDate');
        this.processResponse('rentFinishDate');
        this.processResponse('constHotWaterPrice');
        this.processResponse('constHeatingPrice');
        this.processResponse('hotWaterPrice');
        this.processResponse('coldWaterPrice');
        this.processResponse('coldForHotWaterPrice');
        this.processResponse('heatingPrice');
        this.processResponse('advancedPayments');

        this.processTwoDatesResponse('calcDiffDates', 'calcStartDate', 'calcFinishDate');
        this.processTwoDatesResponse('rentDiffDates', 'rentStartDate', 'rentFinishDate');
        this.processTwoDatesResponse('calcIntervalDates','calcStartDate', 'calcFinishDate');

        this.processAddedRowsSelect2Response('pausalniNaklad', 'test', ['Value','Char','Length']);
        this.processAddedRowsSelect2Response('appMeters', 'load_php_meters', ['Value']);

        this.processAddedRowsResponse('servicesCost', 'servicesCost', ['Value','Length','Zero']);
        this.processAddedRowsResponse('initialValue', 'initialValue', ['Value','Length','Zero']);
        this.processAddedRowsResponse('endValue', 'endValue', ['Value','Length','Zero']);
        this.processAddedRowsResponse('meterNumber', 'meterNumber', ['Value','Length','Zero']);
        this.processAddedRowsResponse('coefficientValue', 'coefficientValue', ['Value','Length','Zero']);

    }

    validateElectroForm(){

        this.processResponse('landlordName');
        this.processResponse('landlordAddress');
        this.processResponse('accountNumber');
        this.processResponse('propertyAddress');
        this.processResponse('propertyType');
        this.processResponse('tenantName');
        this.processResponse('tenantAddress');
        this.processResponse('supplierName');
        this.processResponse('rentStartDate');
        this.processResponse('rentFinishDate');
        this.processResponse('initialValueOne');
        this.processResponse('endValueOne');
        this.processResponse('meterNumberOne');
        this.processResponse('electroPriceKWh');
        this.processResponse('electroPriceMonth');
        this.processResponse('advancedPayments');

        this.processTwoDatesResponse('rentDiffDates', 'rentStartDate', 'rentFinishDate');


    }


    validateDepositForm() {

        this.processResponse('landlordName');
        this.processResponse('landlordAddress');
        this.processResponse('accountNumber');
        this.processResponse('propertyAddress');
        this.processResponse('propertyType');
        this.processResponse('tenantName');
        this.processResponse('tenantAddress');
        this.processResponse('rentStartDate');
        this.processResponse('rentFinishDate');
        this.processResponse('deposit');

        this.processTwoDatesResponse('rentDiffDates', 'rentStartDate', 'rentFinishDate');

        this.processAddedRowsSelect2Response('depositItems', 'load_php_deposit_items', ['Value']);

        this.processAddedRowsResponse('depositItemsPrice', 'deposit_items_price', ['Value','Length','Zero']);
        this.processAddedRowsResponse('itemsStartDate', 'itemsStartDate', ['Value']);
        this.processAddedRowsResponse('itemsFinishDate', 'itemsFinishDate', ['Value']);
        this.processAddedRowsResponse('damageDesc', 'damageDesc', ['Value', 'Length', 'Char']);

    }



   processResponse(name) {

        if (this.data['errors'][name]){
            $("#errors").append(
                '<li id="er">' + this.data['errors'][name] + '</li>'
            );
            $('#' + name).addClass("error_field_form");
        } else {
            $('#' + name).removeClass("error_field_form");
        }
   }


    processTwoDatesResponse(name, startDateName, finishDateName){
        if (this.data['errors'][name]){
            $("#errors").append(
                '<li id="er">' + this.data['errors'][name] + '</li>'
            );
            $('#' + startDateName).addClass("error_field_form");
            $('#' + finishDateName).addClass("error_field_form");
        } /*else {
              $('#' + startDateName).removeClass("error_field_form");
              $('#' + finishDateName).removeClass("error_field_form");
            }*/
    }



    processAddedRowsSelect2Response(name, ID, errors = []) {

        errors.forEach((item) => {

            if (this.data['errors'][name + item]) {

                $("#errors").append(
                    '<li id="er">' + this.data['errors'][name + item] + '</li>'
                );
            }

        })


        for (var i = 1; i <= this[name].length; i++) {
            errors.forEach((item) => {

                if (this.data['errorsBool'][name + item][i] || $("#" + ID + i).hasClass('val_err')) {

                    $("[aria-controls='select2-" + ID + i + "-container']").attr('style', 'border: 1.5px solid #c00!important');
                    $("#" + ID + i).addClass("val_err");

                } else {
                    $("[aria-controls='select2-" + ID + i + "-container']").attr('style', '');
                    $("#" + ID + i).removeClass("val_err");

                }

            })
            $("#" + ID + i).removeClass("val_err");
        }
    }

    processAddedRowsResponse(name, ID, errors = []) {

        errors.forEach((item) => {

            if (this.data['errors'][name + item]) {

                $("#errors").append(
                    '<li id="er">' + this.data['errors'][name + item] + '</li>'
                );
            }

        })


        for (let i = 1; i <= this[name].length; i++) {
            errors.forEach((item) => {

                if (this.data['errorsBool'][name + item][i] || $("#" + ID + i).hasClass('val_err')) {

                    $("#" + ID + i).addClass("error_field_form");
                    $("#" + ID + i).addClass("val_err");

                } else {
                    $("#" + ID + i).removeClass("error_field_form");
                    $("#" + ID + i).removeClass("val_err");

                }

            })
            $("#" + ID + i).removeClass("val_err");

        }
    }









}