$(document).ready(function () {
  
  $("form").on('submit', function(e){ 
    
    $(".errors").remove(); 

    e.preventDefault();
    var form = this;
    $form = $(form);

    var servicesCostName_array = new Array();//creating array of services costs names
    var servicesCost_array = new Array();//creating array of services costs values
    var appMeters_array = new Array();//creating array of meters types
    var initialValue_array = new Array();//creating array of start meteres values
    var endValue_array = new Array();//creating array of end meteres values
    var meterNumber_array = new Array();//creating array of meteres numbers
    var coefficientValue_array = new Array();//creating array of coefficients values
    //filling these arrays
    $('select[name="pausalniNaklad[]"]').each(function(){
    servicesCostName_array.push($(this).val());
    });
    $('input[name="servicesCost[]"]').each(function(){
    servicesCost_array.push($(this).val());
    });
    $('select[name="appMeters[]"]').each(function(){
    appMeters_array.push($(this).val());
    });
    $('input[name="initialValue[]"]').each(function(){
    initialValue_array.push($(this).val());
    });
    $('input[name="endValue[]"]').each(function(){
    endValue_array.push($(this).val());
    });
    $('input[name="meterNumber[]"]').each(function(){
    meterNumber_array.push($(this).val());
    });
    $('input[name="coefficientValue[]"]').each(function(){
    coefficientValue_array.push($(this).val());
    });

    //collecting values from form to one Object variable
    var formData = {
      landlordName: $("#landlordName").val(),
      landlordAddress: $("#landlordAddress").val(),
      accountNumber: $("#accountNumber").val(),
      propertyAddress: $("#propertyAddress").val(),
      propertyType: $('#propertyType').val(),
      tenantName: $('#tenantName').val(),
      tenantAddress: $('#tenantAddress').val(),
      adminName: $('#adminName').val(),
      calcStartDate: $("#calcStartDate").val(),
      calcFinishDate: $("#calcFinishDate").val(),
      rentStartDate: $("#rentStartDate").val(),
      rentFinishDate: $("#rentFinishDate").val(),
      servicesCostName_array: servicesCostName_array,      
      servicesCost_array: servicesCost_array,
      appMeters_array: appMeters_array,
      initialValue_array: initialValue_array,
      endValue_array: endValue_array,
      meterNumber_array: meterNumber_array,
      coefficientValue_array: coefficientValue_array,
      constHotWaterPrice: $("#constHotWaterPrice").val(),
      constHeatingPrice: $("#constHeatingPrice").val(),
      hotWaterPrice: $("#hotWaterPrice").val(),
      coldWaterPrice: $("#coldWaterPrice").val(),
      coldForHotWaterPrice: $("#coldForHotWaterPrice").val(),
      heatingPrice: $("#heatingPrice").val(),
      advancedPayments: $('#advancedPayments').val()
    };

    
    //sending ajax request to server
    $.ajax({
      type: "POST",
      url: "validation_ajax.php",
      data: formData,
      dataType: "json",
      encode: true,
      })
      .done(function (data) { //in case of request was succesfull
        console.log(data); // for debuging
        
        $(".errors_field").append(
          '<ul class = "errors" id = "errors"></ul>'
        );
        if (!data.success) {
          //Functions for processing errors messages from server

          //errors after cheking incoming Value and Length
          //not allowed symbols validation
          function ValidateValueLengthChar(errorValue, errorLength, errorChar){
            if (data['errors'][errorValue]) {
              $("#errors").append(
              '<li id="er">' + data['errors'][errorValue] + '</li>' 
              );
              $('#' + errorValue).addClass("error_field_form");
            }
            else if (data['errors'][errorLength]) {
              $("#errors").append(
              '<li id="er">' + data['errors'][errorLength]  + '</li>'
              );
              $('#' + errorValue).addClass("error_field_form");
            }  
            else if (data['errors'][errorChar]) {  
              $("#errors").append(
                '<li id="er">' + data['errors'][errorChar] + '</li>' 
                );
                $('#' + errorValue).addClass("error_field_form");
              }
            else {
              $('#' + errorValue).removeClass("error_field_form");
            }
          }


          //errors after validation incoming Value, Length and comparing with zero
          function ValidateValueLengthZero (errorValue, errorLength, errorBelowZero){
            if (data['errors'][errorValue]) {
              $("#errors").append(
              '<li id="er">' + data['errors'][errorValue] + '</li>' 
              );
              $('#' + errorValue).addClass("error_field_form");
            }
            else if (data['errors'][errorLength]) {
              $("#errors").append(
              '<li id="er">' + data['errors'][errorLength]  + '</li>'
              );
              $('#' + errorValue).addClass("error_field_form");
            }
            else if (data['errors'][errorBelowZero]){
              $("#errors").append(
              '<li id="er">' + data['errors'][errorBelowZero]  + '</li>'
              );
              $('#' + errorValue).addClass("error_field_form");
            }
            else {
              $('#' + errorValue).removeClass("error_field_form");
            }
          }
          //errors after validation only Length and comparing with zero
          function ValidateLengthAndZero (errorValue, errorLength, errorBelowZero){
            if (data['errors'][errorLength]) {
              $("#errors").append(
              '<li id="er">' + data['errors'][errorLength]  + '</li>'
              );
              $('#' + errorValue).addClass("error_field_form");
            }
            else if (data['errors'][errorBelowZero]){
              $("#errors").append(
              '<li id="er">' + data['errors'][errorBelowZero]  + '</li>'
              );
              $('#' + errorValue).addClass("error_field_form");
            }
            else {
              $('#' + errorValue).removeClass("error_field_form");
            }
          }

          //errors for account number validation
          function accNumberVal(errorValue, errorWrite, errorMinus) {
            if (data['errors'][errorWrite]){
              $("#errors").append(
              '<li id="er">' + data['errors'][errorWrite]  + '</li>'
              );
              $('#' + errorValue).addClass("error_field_form");
            }
            else if (data['errors'][errorMinus]) {
              $("#errors").append(
              '<li id="er">' + data['errors'][errorMinus]  + '</li>'
              );
              $('#' + errorValue).addClass("error_field_form");
            }
            else {
               $('#' + errorValue).removeClass("error_field_form");
            }
          }


          //errors after two dates validation
          function twoDatesVal(errorValueStart, errorValueFinish, errorDifDate, errorDifDateYear) {
            if (data['errors'][errorDifDate]) {
              $("#errors").append(
              '<li id="er">' + data['errors'][errorDifDate]  + '</li>' 
              );
              $('#' + errorValueStart).addClass("error_field_form");
              $('#' + errorValueFinish).addClass("error_field_form");
            }
            else if (data['errors'][errorDifDateYear]) {
              $("#errors").append(
              '<li id="er">' + data['errors'][errorDifDateYear]  + '</li>' 
              );
              $('#' + errorValueStart).addClass("error_field_form");
              $('#' + errorValueFinish).addClass("error_field_form");
            }
            else { 
              if(data['errors'][errorValueStart]) {
                $("#errors").append(
                '<li id="er">' + data['errors'][errorValueStart]  + '</li>' 
                );
                $('#' + errorValueStart).addClass("error_field_form");
              }
              else {
                $('#' + errorValueStart).removeClass("error_field_form");
              }
              if (data['errors'][errorValueFinish]) {
                $("#errors").append(
                '<li id="er">' + data['errors'][errorValueFinish]  + '</li>' 
                );
                $('#' + errorValueFinish).addClass("error_field_form");
              }       
              else {
                $('#' + errorValueFinish).removeClass("error_field_form");
              }
            }
          }

          //errors after validations of values count of their is not difinded (added fields)
          function runningValuesStringSelect2Validator(errorValue, errorLength, errorChar, valuesArray, ID){
            if (data['errors'][errorValue]) {
              $("#errors").append(
              '<li id="er">' + data['errors'][errorValue]  + '</li>' 
              );
            } 
            if (data['errors'][errorLength]) {
              $("#errors").append(
              '<li id="er">' + data['errors'][errorLength]  + '</li>' 
              );
            }
            if (data['errors'][errorChar]) {
              $("#errors").append(
              '<li id="er">' + data['errors'][errorChar]  + '</li>' 
              );
            }
            for(var i=1; i<=valuesArray.length; i++) {
              if ((data['errors'][errorValue + i]) || (data['errors'][errorLength + i]) || (data['errors'][errorChar + i])) {
                $("[aria-controls='select2-" + ID + i + "-container']").attr('style', 'border: 1.5px solid #c00!important');
              }
              else {
                $("[aria-controls='select2-" + ID + i + "-container']").attr('style', ''); 
              }
            }
          }


          //errors after validations of values count of their is not difinded (added fields)
          function runningValuesValidator(errorValue, errorLength, errorValueBelowZero, valuesArray){
            if (data['errors'][errorValue]) {
              $("#errors").append(
              '<li id="er">' + data['errors'][errorValue]  + '</li>' 
              );
            } 
            if (data['errors'][errorLength]) {
              $("#errors").append(
              '<li id="er">' + data['errors'][errorLength]  + '</li>' 
              );
            }
            if (data['errors'][errorValueBelowZero]) {
              $("#errors").append(
              '<li id="er">' + data['errors'][errorValueBelowZero]  + '</li>' 
              );
            }
            for(var i=1; i<=valuesArray.length; i++) {
              if ((data['errors'][errorValue + i]) || (data['errors'][errorLength + i]) || (data['errors'][errorValueBelowZero + i])) {
                $('#' + errorValue + i).addClass("error_field_form");
              }
              else {
              $('#' + errorValue + i).removeClass("error_field_form");
              }
            }
          }


          function runningValuesStringValidator(errorValue, errorLength, errorChar, valuesArray){
            if (data['errors'][errorValue]) {
              $("#errors").append(
              '<li id="er">' + data['errors'][errorValue]  + '</li>' 
              );
            } 
            if (data['errors'][errorLength]) {
              $("#errors").append(
              '<li id="er">' + data['errors'][errorLength]  + '</li>' 
              );
            }
            if (data['errors'][errorChar]) {
              $("#errors").append(
              '<li id="er">' + data['errors'][errorChar]  + '</li>' 
              );
            }
            for(var i=1; i<=valuesArray.length; i++) {
              if ((data['errors'][errorValue + i]) || (data['errors'][errorLength + i]) || (data['errors'][ errorChar + i])) {
                $('#' + errorValue + i).addClass("error_field_form");
              }
              else {
              $('#' + errorValue + i).removeClass("error_field_form");
              }
            }
          }  







          ValidateValueLengthChar('landlordName', 'landlordNameLength', 'landlordNameChar');
          ValidateValueLengthChar('landlordAddress', 'landlordAddressLength', 'landlordAddressChar');
          ValidateValueLengthChar('propertyAddress', 'propertyAddressLength', 'propertyAddressChar');
          ValidateValueLengthChar('propertyType', 'propertyTypeLength', 'propertyTypeChar');
          ValidateValueLengthChar('tenantName', 'tenantNameLength', 'tenantNameChar');
          ValidateValueLengthChar('tenantAddress', 'tenantAddressLength', 'tenantAddressChar');
          ValidateValueLengthChar('adminName', 'adminNameLength', 'adminNameChar');
          accNumberVal('accountNumber', 'accountNumberWrite', 'accountNumberMinus'); 
          
          twoDatesVal('calcStartDate', 'calcFinishDate', 'calcDifDate', 'calcDifDateYear');
          twoDatesVal('rentStartDate', 'rentFinishDate', 'rentDifDate', 'rentDifDateYear');

          runningValuesStringSelect2Validator('servicesCostName' , 'servicesCostNameLen' , 'servicesCostNameChar' , servicesCostName_array , 'test');

          runningValuesValidator('servicesCost',  'servicesCostLen', 'servicesCostBelowZero', servicesCost_array);

          runningValuesStringSelect2Validator('appMeters' , 'appMetersLen' , 'appMetersChar' , appMeters_array , 'load_php_meters');

          runningValuesValidator('initialValue',  'initialValueLen', 'initialValueBelowZero', initialValue_array);
          runningValuesValidator('endValue',  'endValueLen', 'endValueBelowZero', endValue_array);

          runningValuesStringValidator('meterNumber' , 'meterNumberLen' , 'meterNumberChar' , meterNumber_array);          
          
          //errors after comparing two values count of their is not definded (added fields)
          if (data.errors.difValues) {
              $("#errors").append(
              '<li id="er">' + data.errors.difValues  + '</li>' 
              );
          } 
          for(var i=1; i<=endValue_array.length; i++) {
            if (data['errors']['difValues' + i])  {
                $('#initialValue' + i).addClass("error_field_form");
                $('#endValue' + i).addClass("error_field_form");
              }
          }
          
          runningValuesValidator('coefficientValue', 'coefficientValueLen', 'coefficientValueBelowZero',coefficientValue_array);  

          ValidateValueLengthZero('constHotWaterPrice', 'constHotWaterPriceLen', 'constHotWaterPriceBelowZero');
          ValidateValueLengthZero('constHeatingPrice', 'constHeatingPriceLen', 'constHeatingPriceBelowZero');

          ValidateValueLengthZero('hotWaterPrice', 'hotWaterPriceLen', 'hotWaterPriceBelowZero');
          ValidateValueLengthZero('coldWaterPrice', 'coldWaterPriceLen', 'coldWaterPriceBelowZero');
          ValidateValueLengthZero('coldForHotWaterPrice', 'coldForHotWaterPriceLen', 'coldForHotWaterPriceBelowZero');          
          ValidateValueLengthZero('heatingPrice', 'heatingPriceLen', 'heatingPriceBelowZero');

          ValidateLengthAndZero ('advancedPayments', 'advancedPaymentsLen', 'advancedPaymentsBelowZero');
  

      } else {
        $form.attr('action', 'calculate.php').off('submit').submit();
      }
      })
      .fail(function(data){
        console.log("error");
        $(".errors_field").append(
          '<span class = "errors">Server conection error! Please try later!</span>'
        );
      })  
  });
});