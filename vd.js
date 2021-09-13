$(document).ready(function () {
  
  $("form").on('submit', function(e){ 
    
    $(".errors").remove(); 

    e.preventDefault();
    var form = this;
    $form = $(form);

    var servicesCost_array = new Array();//creating array of services costs
    var initialValue_array = new Array();//creating array of start meteres values
    var endValue_array = new Array();//creating array of end meteres values
    var coefficientValue_array = new Array();//creating array of coefficients values
    //filling these arrays
    $('input[name="servicesCost[]"]').each(function(){
    servicesCost_array.push($(this).val());
    });
    $('input[name="initialValue[]"]').each(function(){
    initialValue_array.push($(this).val());
    });
    $('input[name="endValue[]"]').each(function(){
    endValue_array.push($(this).val());
    });
    $('input[name="coefficientValue[]"]').each(function(){
    coefficientValue_array.push($(this).val());
    });

    //collecting values from form to one variable
    var formData = {
      landlordName: $("#landlordName").val(),
      landlordAddress: $("#landlordAddress").val(),
      propertyAddress: $("#propertyAddress").val(),
      propertyType: $('#propertyType').val(),
      tenantName: $('#tenantName').val(),
      tenantAddress: $('#tenantAddress').val(),
      calcStartDate: $("#calcStartDate").val(),
      calcFinishDate: $("#calcFinishDate").val(),
      rentStartDate: $("#rentStartDate").val(),
      rentFinishDate: $("#rentFinishDate").val(),
      servicesCost_array: servicesCost_array,
      initialValue_array: initialValue_array,
      endValue_array: endValue_array,
      coefficientValue_array: coefficientValue_array,
      constHotWaterPrice: $("#constHotWaterPrice").val(),
      constHeatingPrice: $("#constHeatingPrice").val(),
      hotWaterPrice: $("#hotWaterPrice").val(),
      coldWaterPrice: $("#coldWaterPrice").val(),
      heatingPrice: $("#heatingPrice").val(),
      advancedPayments: $('#advancedPayments').val()
    };
    //sending ajax request to server
    $.ajax({
      type: "POST",
      url: "val.php",
      data: formData,
      dataType: "json",
      encode: true,
      })
      .done(function (data) { //in case of request was succesfull
        console.log(data);
        
        $(".errors_field").append(
          '<ul class = "errors" id = "errors"></ul>'
        );
        if (!data.success) {
          //Functions for processing errors messages from server
          //errors after cheking incoming Value and Length
          function ValidateValueAndLength(errorValue, errorLength){
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

          ValidateValueAndLength('landlordName', 'landlordNameLength');
          ValidateValueAndLength('landlordAddress', 'landlordAddressLength');
          ValidateValueAndLength('propertyAddress', 'propertyAddressLength');
          ValidateValueAndLength('propertyType', 'propertyTypeLength');

          ValidateValueAndLength('tenantName', 'tenantNameLength');
          ValidateValueAndLength('tenantAddress', 'tenantAddressLength');
          
          twoDatesVal('calcStartDate', 'calcFinishDate', 'calcDifDate', 'calcDifDateYear');
          twoDatesVal('rentStartDate', 'rentFinishDate', 'rentDifDate', 'rentDifDateYear');

          runningValuesValidator('servicesCost',  'servicesCostLen', 'servicesCostBelowZero', servicesCost_array);

          runningValuesValidator('initialValue',  'initialValueLen', 'initialValueBelowZero', initialValue_array);
          runningValuesValidator('endValue',  'endValueLen', 'endValueBelowZero', endValue_array);
          
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