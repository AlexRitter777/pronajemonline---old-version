
/*----------------Global variables-----------------*/

let len = 0; //кол-во добавленных строк с расходами после повторной загрузки страницы
let lenMeters = 0; //кол-во добавленных строк со счетчиками
let lenCoefficient = 0;//кол-во добавленных строк с коэффициентами, не вкл. первую строку
let lenCoefficientAll = 0; //кол-во всех добавленных строк с коэффициентом
let lenDepositItems = 0; //кол-во всех добавленных строк с положками выучтования кауц
let max_fields = 5;//макс. кол-во полей расходов
let max_meters = 5;//макс. кол-во полей счетчиков
let max_coefficients = 3;// максимальное количество полей коэффициентов (глобальная - значение используется в нескольких функциях)
let max_deposit_items = 3;//макс. кол-во полей положек кауц

/*------Определяем, если имеются строки добавленные через PHP после возврата на страницу ----*/

$(window).on('load', function() {

    len = $('.costs_added_after').length; //Паушальные расходы
    lenMeters = $('.meters_added_after').length; //Показания счетчиков
    lenCoefficient = $('.coefficient_added_field').length;//Поля коэффициентов, не включая первое поле
    lenCoefficientAll = $('.coefficient_field').length; // Все поля с коэффициентом
    lenDepositItems = $('.deposit_added_after').length; //Положки выучтования кауц

})


/*---------------Добавление и удаление полей расходов-------------*/
//len - определяется в далее в отдельной функции

//Добавоение рядов

$(document).ready(function () {

  let wrapper = $(".add_input_fields");
  let add_button = $(".add_input_fields_button");
  let x = 1;
  $(add_button).click(function (e) {
    e.preventDefault();
    if ((x + len )< max_fields) {
      x++;
      $(wrapper).append(
        '<div class="add_field" id="' + (x + len) + '">'+
        '<select name="pausalniNaklad[]" class="select-list" id="test' + (x + len) + '" style="width: 55%">'+
        '</select>' +
        '<input type="number" class="right-field" name="servicesCost[]" id="servicesCost' + (x + len) + '" step="any" placeholder="Zadej častku v Kč" />'+
        '<a href="#" class="remove_field">'+
        '<svg class="icon_minus">'+
        '<use xlink: href = "#minus" >' +
        '</use >' +
        '</svg >' +
        '<span class = "icon_title">Odebrat</span>'+
        '</a></div>'
        ); 
      $('#test' + (x + len)).load('/services/simply-services');
    }
    if ((x + len) == max_fields){
      $('.add_input_fields_button').css('display', 'none');
    }
    $('#test' + (x + len)).select2({ //активируем Select2 для добавленнного ряда
      tags: true,
      placeholder: "Vyber ze seznamu nebo napiš vlastní",
      sorter: data => data.sort((a, b) => a.text.localeCompare(b.text))
    });
  });

  //удаление рядов

  //если удаляем ряд не последний, то нужно уменьшить id по порядку и актирвироватиь select2 снова
  $(wrapper).on("click", ".remove_field", function (e) {
    e.preventDefault();
    let removedRow = $(this).parent('div').attr('id');
    $(this).parent('div').remove();
    if (removedRow != (x + len)){

        for (i= (len + x - removedRow); i<=(x + len); i++){
            if ((i !== 1) && (i !== 2)) {
                $('#test' + i).attr('id', 'test' + (i - 1));
                $(wrapper).children('#' + i).attr('id', i - 1);
                $('#servicesCost' + i).attr('id', 'servicesCost' + (i-1));
                $('#test' + (i - 1)).select2({ //активируем Select2 для каждого ряда после удаления одного из рядов
                    tags: true,
                    placeholder: "Vyber ze seznamu nebo napiš vlastní",
                    sorter: data => data.sort((a, b) => a.text.localeCompare(b.text))
                });
            }
        }
    }
    x--;
    if (x + len == max_fields - 1){
      $('.add_input_fields_button').css('display', '');
    }
  });
});


/*---------------Добавление и удаление полей показаний счетчиков-------------*/

//добавление рядов
$(document).ready(function () {

    let y = 1;
    let addMeters = $(".add_meters");
    let addMetersButton = $(".add_meters_button");
    $(addMetersButton).click(function (e) {
    e.preventDefault();
    if (y + lenMeters < max_meters) {
      y++;
      $(addMeters).append(
        '<div class="add_meters_added_field" id="' + ( y + lenMeters) + '">' +
        '<select name="appMeters[]" id="load_php_meters' + (y + lenMeters) + '" style="width: 21%">' +
        '</select>' +
        '<input type="number" class="field right-field" name="initialValue[]" id="initialValue' + (y + lenMeters) + '" step="any" placeholder="Počateční stav" style="width: 16%" />' +
        '<input type="number" class="field last-field" name="endValue[]" id="endValue' + (y + lenMeters) + '" step="any" placeholder="Koneční stav" style="width: 16%" />' +
        '<input type="text" class="field last-field" name="meterNumber[]" id="meterNumber' + (y + lenMeters) + '" placeholder="Číslo měříče" style="width: 27%" />' +
        '<a href="#" class="remove_meters">' +
        '<svg class="icon_minus">' +
        '<use xlink: href = "#minus" >' +
        '</use >' +
        '</svg >' +
        '<span class = "icon_title">Odebrat</span>'+
        '</a></div>'
      );
      $('#load_php_meters' + (y + lenMeters)).load('/services/simply-meters');
    }
    if (y + lenMeters == max_meters) {
      $(addMetersButton).css('display', 'none');
    }
      $('#load_php_meters' + (y + lenMeters)).select2({
      placeholder: "Vyber ze seznamu",
      sorter: data => data.sort((a, b) => a.text.localeCompare(b.text))
    });
  });

  //Удалание рядов
  $(addMeters).on("click", ".remove_meters", function (e) {
    e.preventDefault();
    let removedRow = $(this).parent('div').attr('id');
    $(this).parent('div').remove();
    if (removedRow != (y + lenMeters)){
      for (let i= (lenMeters + y - removedRow); i <= y + lenMeters; i++){
          if(i != 1) {
              $('#load_php_meters' + i).attr('id', 'load_php_meters' + (i - 1));
              $('.add_meters').children('#' + i).attr('id', (i - 1));
              $('#initialValue' + i).attr('id', 'initialValue' + (i - 1));
              $('#endValue' + i).attr('id', 'endValue' + (i - 1));
              $('#meterNumber' + i).attr('id', 'meterNumber' + (i - 1));
              $('#load_php_meters' + (i - 1)).select2({
                  tags: true,
                  placeholder: "Vyber ze seznamu",
                  sorter: data => data.sort((a, b) => a.text.localeCompare(b.text))
              });
          }
      }
    }
    y--;
    if (y + lenMeters == max_meters - 1) {
      $(addMetersButton).css('display', '');
    }
  });
  
});


/*---------------Добавление и удаление полей выучтования кауц----------------*/



$(document).ready(function () {

    let depositItem = $(".add_input_fields_deposit_items");
    let addItemButton = $(".add_input_fields_deposit_items_button");
    let n = 1;
    $(addItemButton).click(function (e) {
        e.preventDefault();
        if ((n + lenDepositItems) < max_deposit_items) {
            n++;
            $(depositItem).append(
                `<div class="add_deposit_added_field" id="${n+lenDepositItems}">
                    <select name="depositItems[]" class="select-list-deposit" id="load_php_deposit_items${n+lenDepositItems}"
                            style="width: 55%">
                    </select>
                    <input type="number" class="right-field" name="depositItemsPrice[]" id="deposit_items_price${n+lenDepositItems}"
                           step="any" placeholder="Zadej častku v Kč" />
                    
                    <a href="#" class="remove_field">
                        <svg class="icon_minus">
                            <use xlink: href = "#minus" >
                            </use >
                        </svg >
                        <span class = "icon_title">Odebrat</span>
                    </a>
                </div>
                <div class="deposit_append" id="deposit_append${n+lenDepositItems}"></div>`
            );
            $('#load_php_deposit_items' + (n + lenDepositItems)).load('/services/simply-deposit-items');
        }

        $('#load_php_deposit_items' + (n + lenDepositItems)).select2({ //активируем Select2 для добавленнного ряда
            tags: true,
            placeholder: "Vyber ze seznamu nebo napiš vlastní",
            //sorter: data => data.sort((a, b) => a.text.localeCompare(b.text))
        });
        $('.add_input_fields_deposit_items_button').css('display', 'none');
    });



    //Удалание рядов // Kauce

    $(depositItem).on("click", ".remove_field", function (e) {
        e.preventDefault();
        let removedRow = $(this).parent('div').attr('id');
        $(this).parent().next().remove();
        $(this).parent().remove();
        $('.add_input_fields_deposit_items_button').css('display', '');

        if (removedRow !== (n + lenDepositItems)){
            for (let i= (lenDepositItems + n - removedRow); i <= (n + lenDepositItems); i++){
                if ((i !== 1) && (i !== 2)) {

                    $(depositItem).children('#' + i).attr('id', (i - 1));
                    $('#load_php_deposit_items' + i).attr('id', 'load_php_deposit_items' + (i - 1));
                    $('#deposit_items_price' + i).attr('id', 'deposit_items_price' + (i - 1));
                    $('#deposit_append' + i).attr('id', 'deposit_append' + (i - 1));
                    $('#itemsStartDate' + i).attr('id', 'itemsStartDate' + (i - 1));
                    $('#itemsFinishDate' + i).attr('id', 'itemsFinishDate' + (i - 1));
                    $('#damageDesc' + i).attr('id', 'damageDesc' + (i - 1));

                    $('#load_php_deposit_items' + (i - 1)).select2({
                        tags: true,
                        placeholder: "Vyber ze seznamu",
                        sorter: data => data.sort((a, b) => a.text.localeCompare(b.text))
                    });
                }
            }
        }
        n--;


    });


});





/*----------------------Выбор варианта с коэфициентом и добавление коэфициентов-------------------------*/

//Переключение ANO/NE, подключение первой строки
$(document).ready(function () {
  var coefficientDiv = $('<div class = "add_coefficient"><div class = "add_coefficient_field" ><input type = "number" class = "coefficient_field" id = "coefficientValue1" name = "coefficientValue[]" step = "any" placeholder = "zadej koeficient"/><br/></div><a href="#" class="add_coefficient_button"><svg class="icon_plus"><use xlink: href = "#plus"></use></svg><span class="icon_title">Přidat koeficient</span></a></div>');
  var checkedAno = $('#ano_coefficient');
  var checkedNe = $('#ne_coefficient');
  var z = 1;
  //макс кол-во полей задано глобально
  $(checkedAno).change(function () {
      $('.coefficient').append(coefficientDiv);
    }
  );
  
  $(checkedNe).change(function () {
    $('.add_coefficient').remove();
  });

// Добавление строк с коэффициентами

  $('.coefficient').on("click", ".add_coefficient_button", function (e) {
    e.preventDefault();
    if (z + lenCoefficient < max_coefficients) {
      z++;
      $('.add_coefficient_field').append('<div class = "coefficient_added_field" id="' + (z + lenCoefficient) + '"><input type="number" class="coefficient_field" id="coefficientValue' + (z + lenCoefficient) + '" name="coefficientValue[]" step="any" placeholder="zadej koeficent" /><a href="#" class="remove_coefficients"><svg class="icon_minus"><use xlink: href = "#minus" ></use ></svg ><span class = "icon_title">Odebrat</span></a></div>');
    }
    if (z + lenCoefficient == max_coefficients) {
      $('.add_coefficient_button').css('display', 'none');
    }


  });


  // Удаление строк с коэффициентами
  $('.coefficient').on("click", ".remove_coefficients", function (e) {
    e.preventDefault();
    let removedRow = $(this).parent('div').attr('id');
    $(this).parent('div').remove();
    if (removedRow != (z + lenCoefficient)){
        for (let i= (lenCoefficient + z - removedRow); i <= (z + lenCoefficient); i++) {
            if (i != 1) {

                $('.add_coefficient_field').children('#' + i).attr('id', i - 1);
                $('#coefficientValue' + i).attr('id', 'coefficientValue' + (i-1));

            }
        }
    }

    z--;

    if (z + lenCoefficient == max_coefficients - 1) {
        $('.add_coefficient_button').css('display', '');
    }
  });
 
});








/*---------------------Всплывающие подсказки---------------------------------*/

$(function () {
	  $('.icon_help').on("mouseenter", function(e){ 
	  	e.preventDefault();
	  	var ypos = $(this).offset().top;
	  	var xpos = $(this).offset().left+20;
	  	var RealHint =  $(this).data('hint');
	  	$(RealHint).css('top',ypos);
	  	$(RealHint).css('left',xpos);
	  	$(RealHint).fadeIn(); 
    })
    $('.icon_help').on("mouseleave", function(e){ 
      $(".real-hint").fadeOut(); 
    })
});

/*----Функции  включения плагина SELECT 2 для элементов имеющихся на странице при ее загрузке.---*/

//Паушальные расходы
$(document).ready(function() {
  $('.select-list').select2({
      tags: true, //возможность вводить свои значения
      placeholder: "Vyber ze seznamu nebo napiš vlastní",
      sorter: data => data.sort((a, b) => a.text.localeCompare(b.text)) //сортировка по АБВ
    });

})

//Показания счетчиков
$(document).ready(function() {
  $('.select-list-meters').select2({
      placeholder: "Vyber ze seznamu",
      sorter: data => data.sort((a, b) => a.text.localeCompare(b.text))
    });

})

//Источники показаний счетчиков
$(document).ready(function() {
  $('.select-list-origin-start').select2({
      placeholder: "Vyber ze seznamu",
      sorter: data => data.sort((a, b) => a.text.localeCompare(b.text))
    });

})

$(document).ready(function() {
  $('.select-list-origin-end').select2({
      placeholder: "Vyber ze seznamu",
      sorter: data => data.sort((a, b) => a.text.localeCompare(b.text))
    });

})

//Источника показаний электро - счетчиков
$(document).ready(function() {
    $('.select-list-origin-electro-start').select2({
      placeholder: "Vyber ze seznamu",
      sorter: data => data.sort((a, b) => a.text.localeCompare(b.text))
    });

})

$(document).ready(function() {
  $('.select-list-origin-electro-end').select2({
      placeholder: "Vyber ze seznamu",
      sorter: data => data.sort((a, b) => a.text.localeCompare(b.text))
    });

})

//Причины завершения договора аренды
$(document).ready(function() {
    $('.select-list-rent_finish_reason').select2({
        placeholder: "Vyber ze seznamu",
        //sorter: data => data.sort((a, b) => a.text.localeCompare(b.text))
    });

})


//Положки выучтования кауц

$(document).ready(function() {
    $('.select-list-deposit').select2({
        placeholder: "Vyber ze seznamu",
        //sorter: data => data.sort((a, b) => a.text.localeCompare(b.text))
    });

})



/*---Функция добавления опций в поля со списком select2 после загрузки плагина, имеющиеся на странице после ее загрузки (первая строка + добавленные через PHP).---*/

//Паушальные расходы
$(window).on('load', function() {

 $.ajax({
      type: "GET",
      url: "/services/services",
      dataType: "json",
      encode: true
      })
      .done(function (data) {
        let countServices = data.length;
        for (i=0; i<=len; i++){
          for (j=0; j<countServices; j++){
            if (data[j] != $('#test' + (i + 1)).val()){
              $('#test' + (i + 1)).append(
                '<option value="' + data[j] + '">' + data[j] + '</option>');
            }
          }
               
        }
      })

})

//Показания счетчиков

$(window).on('load', function() { 

 $.ajax({
      type: "GET",
      url: "/services/meters",
      dataType: "json",
      encode: true,
      })
      .done(function (data) {
        let countMeters = data.length;
        for (i=0; i<=lenMeters; i++){
          for (j=0; j<countMeters; j++){
            if (data[j] != $('#load_php_meters' + (i + 1)).val()){
              $('#load_php_meters' + (i + 1)).append(
                '<option value="' + data[j] + '">' + data[j] + '</option>');
            }
          }
               
        }
          
      });
     
})
  
//Источники показания счетчиков

$(window).on('load', function() { 
  $.ajax({
      type: "GET",
      url: "/services/origins",
      dataType: "json",
      encode: true,
      })
      .done(function (data) {
        let countOrigins = data.length;
       
          for (j=0; j<countOrigins; j++){
            if (data[j] != $('#load_php_origin_start').val())
            {
              $('#load_php_origin_start').append(
                '<option value="' + data[j] + '">' + data[j] + '</option>');
            }
          }

           for (i=0; i<countOrigins; i++){
            if (data[i] != $('#load_php_origin_end').val())
            {
              $('#load_php_origin_end').append(
                '<option value="' + data[i] + '">' + data[i] + '</option>');
            }
          }
               
      });   
 
})

//Источники показаний счетчиков электрики

$(window).on('load', function() {
    $.ajax({
        type: "GET",
        url: "/services/origins-electro",
        dataType: "json",
        encode: true,
    })
        .done(function (data) {
            let countOrigins = data.length;

            for (j=0; j<countOrigins; j++){
                if (data[j] != $('#load_php_origin_electro_start').val())
                {
                    $('#load_php_origin_electro_start').append(
                        '<option value="' + data[j] + '">' + data[j] + '</option>');
                }
            }

            for (i=0; i<countOrigins; i++){
                if (data[i] != $('#load_php_origin_electro_end').val())
                {
                    $('#load_php_origin_electro_end').append(
                        '<option value="' + data[i] + '">' + data[i] + '</option>');
                }
            }

        });

})


//Причины завершения договора
$(window).on('load', function() {
    $.ajax({
        type: "GET",
        url: "/services/rent-finish-reasons",
        dataType: "json",
        encode: true,
    })
        .done(function (data) {
            let countRentFinishResons = data.length;
            for (j = 0; j < countRentFinishResons; j++) {
                if (data[j] != $('#load_php_rent_finish_reason').val()) {
                    $('#load_php_rent_finish_reason').append(
                        '<option value="' + data[j] + '">' + data[j] + '</option>');
                }
            }

        })

})

//Положки выучтовани

$(window).on('load', function() {

    $.ajax({
        type: "GET",
        url: "/services/deposit-items",
        dataType: "json",
        encode: true
    })
        .done(function (data) {
            let countServices = data.length;
            for (i=0; i<=lenDepositItems; i++){
                for (j=0; j<countServices; j++){
                    if (data[j] != $('#load_php_depositItems' + (i + 1)).val()){
                        $('#load_php_deposit_items' + (i + 1)).append(
                            '<option value="' + data[j] + '">' + data[j] + '</option>');
                    }
                }

            }
        })

})




/*-----Функции для удаления кнопки "Добавить ряд" при добавлении через PHP максимального количества рядов ------*/

//Паушальные расходы
$(window).on('load', function() {
  costsAddedFieldsCount = $('.costs_added_after').length;//кол-во добавленных полей расходов не включая первое поле
  if (costsAddedFieldsCount + 1 == max_fields) {
    $('.add_input_fields_button').css('display', 'none');
  } // убрать кнопку Добавить при возврате на форму при макс. значении полей расходов.

})


//Показания счетчиков
$(window).on('load', function() { 
  metersAddedFieldsCount = $('.meters_added_after').length;//кол-во добавленных полей счетчиков, не включая первое поле
  if (metersAddedFieldsCount + 1 == max_meters) {
    $('.add_meters_button').css('display', 'none');
  } // убрать кнопку Добавить при возврате на форму при макс. значении полей расходов.

})

//Кауце
$(window).on('load', function() {
    depositAddedFieldsCount = $('.deposit_added_after').length;//кол-во добавленных полей депозита, не включая первое поле
    if (depositAddedFieldsCount + 1 == max_deposit_items) {
        $('.add_input_fields_deposit_items_button').css('display', 'none');
    } // убрать кнопку Добавить при возврате на форму при макс. значении полей депозита.

})

//Поля с коэффициентами

$(window).on('load', function() {

// Выбор ANO/NE при загрузке страницы
    if (lenCoefficientAll !== 0) {
        $('#ano_coefficient').prop('checked', true);
    } else {
        $('#ne_coefficient').prop('checked', true);
    }



//Кнопка "Добавить"
  if (lenCoefficient + 1 == max_coefficients) {
    $('.add_coefficient_button').css('display', 'none');
  } // убрать кнопку Добавить при возврате на форму при макс. значении полей коэфф.

})


/*----------------------------Добавление данных под положки депозита------------------------*/


$(document).ready(function (){


    $(".add_input_fields_deposit_items").on("change", ".select-list-deposit", function (e){


        let data = $(this).val();
        let idItem = $(this).parent('div').attr('id');
        let appendDiv = `
        <div class="dates_append">
            <label class="label_text">Vyúčtování za období</label>
            <input type="date" name="itemsStartDate[]" class="field-deposit" id="itemsStartDate${idItem}" class="field"/>
            <input type="date" name="itemsFinishDate[]" class="field-deposit" id="itemsFinishDate${idItem}" class="field"/>
        </div>
        <!-- /.dates_append-->
        <div class="description_append">
            <label class="label_text">Popis závady/poškození</label>
            <input type="text" name="damageDesc[]" class="description_field" id="damageDesc${idItem}"/>
        </div>
        <!-- /.description_append-->
        <div class="border"></div>`

        $('#deposit_append' + idItem).empty().append(appendDiv);

        if((data === 'Přeplatek z vyúčtování služeb') || (data === 'Nedoplatek z vyúčtování služeb') || (data === 'Přeplatek z vyúčtování spotřeby elektřiny') || (data === 'Nedoplatek z vyúčtování spotřeby elektřiny')) {


            $('#deposit_append' + idItem).children('.description_append').css('display', 'none')}

        else {

            $('#deposit_append' + idItem).children('.dates_append').css('display', 'none');
         }
        if(idItem == max_deposit_items) {
            $('.add_input_fields_deposit_items_button').css('display', 'none');
        } else {
            $('.add_input_fields_deposit_items_button').css('display', '');
        }

    })



})






/*----Перезагрузка страницы при нажатии "Обновить" ---------*/

$(document).ready(function() {
  $('#btn_clear').click(function (e){
    location.reload(true);

  })
})

