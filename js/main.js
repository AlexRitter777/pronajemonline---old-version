
$(document).ready(function () {
  var max_fields = 4;
  var wrapper = $(".add_input_fields");
  var add_button = $(".add_input_fields_button");
  var x = 1;

  $(add_button).click(function (e) {
    e.preventDefault();
    if (x < max_fields) {
      x++;
      $(wrapper).append(
        '<div class="add_field">'+
        '<select name="pausalniNaklad[]" class="add_select" id="test' + x + '">'+
        '</select>' +
        '<input type="number" class="currency" name="servicesCost[]" step="any" placeholder="zadej vyši nákladu" />'+
        '<a href="#" class="remove_field">'+
        '<i class="fa fa-times"></i>'+
        '</a></div>'
        ); 
      $('#test' + x).load('services_list.php');
    }
    if (x == max_fields){
      $('.add_input_fields_button').css('display', 'none');
    }
  });
    
  $(wrapper).on("click", ".remove_field", function (e) {
    e.preventDefault();
    $(this).parent('div').remove();
    x--;
    if (x == max_fields - 1){
      $('.add_input_fields_button').css('display', '');
    }
  });

});

$(document).ready(function () {
  var max_meters = 4;
  var y = 1;
  var addMeters = $(".add_meters");
  var addMetersButton = $(".add_meters_button");
  $(addMetersButton).click(function (e) {
    e.preventDefault();
    if (y < max_meters) {
      y++;
      $(addMeters).append(
        '<div class="add_meters_added_field">' +
        '<select name="meters[]" class="add_select" id="load_php_meters' + y + '">' +
        '</select>' +
        '<input type="number" class="field" name="initialValue[]" step="any" placeholder="Zadej počateční stav" />' +
        '<input type="number" class="field" name="endValue[]" step="any" placeholder="Zadej koneční stav"/>' +
        '<a href="#" class="remove_meters">' +
        '<i class="fa fa-times"></i>' +
        '</a></div>'
      );
      $('#load_php_meters' + y).load('meters_list.php');
    }
    if (y == max_meters) {
      $(addMetersButton).css('display', 'none');
    }
  });
  
  $(addMeters).on("click", ".remove_meters", function (e) {
    e.preventDefault();
    $(this).parent('div').remove();
    y--;
    if (y == max_meters - 1) {
      $(addMetersButton).css('display', '');
    }
  });
  
});

$(document).ready(function () {
  var coefficientDiv = $('<div class = "add_coefficient"><div class = "add_coefficient_field"><input type = "number" class = "coefficient_field" id = "coefficient_field" name = "coefficient[]" step = "any" placeholder = "zadej koeficent"/><br/></div><button type="button" class="add_coefficient_button"><i class="add_title">Přidat koeficient</i></button><br/></div>');
  var deleteCoefficientButton = $('<a href = "#" class= "remove_coefficient"> <i class="fa fa-times"></i></a>');
  var checkedAno = $('#ano_coefficient');
  var checkedNe = $('#ne_coefficient');
  var z = 1;
  var max_coefficients = 3;

  $(checkedAno).change(function () {
      $('.coefficient').append(coefficientDiv);
    }
  );
  
  $(checkedNe).change(function () {
    $('.add_coefficient').remove();
  }

  );

  $('.coefficient').on("click", ".add_coefficient_button", function (e) {
    e.preventDefault();
    if (z < max_coefficients) {
      z++;
      console.log('ok1');
      $('.add_coefficient_field').append('<div class = "coefficient_added_field"><input type="number" class="coefficient_field" id="coefficient_field" name="coefficient[]" step="any" placeholder="zadej koeficent" /><a href="#" class="remove_coefficients"><i class="fa fa-times"></i></a></div>');
    }
    if (z == max_coefficients) {
      $('.add_coefficient_button').css('display', 'none');
    }


  });

  $('.coefficient').on("click", ".remove_coefficients", function (e) {
    e.preventDefault();
    $(this).parent('div').remove();
    z--;
    if (z == max_coefficients - 1) {
    $('.add_coefficient_button').css('display', '');
    }
  });
    


});