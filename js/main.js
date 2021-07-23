
$(document).ready(function () {
  var max_fields = 4;
  var wrapper = $(".add_input_fields");
  var add_button = $(".add_input_fields_button");
  var x = 1;

  $(add_button).click(function (e) {
    e.preventDefault();
    if (x < max_fields) {
      x++;
      console.log('OK');
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
    console.log('Ready to del');
    $(this).parent('div').remove();
    x--;
    if (x == max_fields - 1){
      $('.add_input_fields_button').css('display', '');
    }
  })
});

