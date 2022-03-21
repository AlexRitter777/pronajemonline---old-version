$(document).ready(function (){

    $("form").on('submit', function(e) {

        $(".errors").remove();

        e.preventDefault();
        var form = this;
        $form = $(form);

        const validator = new Validator();

        //validator.form = form;

        var name = $("form").attr("name");

        switch(name){
            case "services":
                validator.ajaxValidation('services', $form);
                break;
            case "electro":
                validator.ajaxValidation('electro', $form);
                break;
            case "deposit":
                validator.ajaxValidation('deposit', $form);

        }



    })

})