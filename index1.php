<?php
  require "includes/services.php";
?>

<!DOCTYPE html>
<html lang="cz">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;600&display=swap" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!--<link rel="stylesheet" href="css/normalize.css">-->
  
  <title>Vyučtování</title>
</head>

<body>
  <div class="container">
    <h1 class="title">Vyučtování služeb spojených s uživaním bytu</h1>
    <form method="POST" action="calculate.php" class="form">

      <h2 class="subtitle">I. Pronajmatel</h2>
      <label class="text">Jméno a přímení</label><br/>
      <input type="text" name="landlordName" placeholder="Zadej jmeno/nazev firmy" class="pole"><br/>
      <label class="text">Adresa</label><br/>
      <input type="text" name="landLordAddress" placeholder="Zadej adresu/sidlo firmy" class="pole"><br/>
      <label class="text">Adresa nemosvitosti</label><br/>
      <input type="text" name="propertyAddress" placeholder="Zadej adresu pronajaté nemovitosti" class="pole"><br/>
      <label class="text">Popis nemovitosti</label><br/>
      <input type="text" name="propertyType" placeholder="Popis nemovitosi (Byt 1kk, Atelier 2kk, Rodinný dům atd.)"
        class="pole"><br/>

      <h2 class="subtitle">II. Nájemnik</h2>
      <label class="text">Jméno a přímení</label><br/>
      <input type="text" name="renterName" placeholder="Zadej jmeno/nazev firmy" class="pole"><br/>
      <label class="text">Adresa</label><br/>
      <input type="text" name="renterAddress" placeholder="Zadej adresu/sidlo firmy" class="pole"><br/>

      <h2 class="subtitle">III. Vyučtivání za období</h2>
      <label class="text">Počatečný datum</label><br/>
      <input type="date" name="startDate" class="pole"><br/>
      <label class="text">Koneční datum</label><br/>
      <input type="date" name="finishDate" class="pole"><br/>

      <h2 class="subtitle">IV. Paušalní náklady</h2>

      <label class="text">Vyberte náklad a zadejte částku</label><br/>

      <div class="add_input_fields">
        
          <select name="pausalniNaklad[]">
            <?php
              $servicesCount = count($services);
              $i = 1;
              while ($i < $servicesCount)
              {
                  echo("<option value =" . $i . ">" . $services[$i] . "</option>");
                  $i++;
              }
            ?>
          </select>
          <input type="number" class="currency" name="servicesCost[]" step="any" placeholder="zadej vyši nákladu"/>

        
      </div>

      <button type="button" class="add_input_fields_button"><i class="add_title">Přidat řadek</i></button><br/>

      <!--Добавление/удаление рядов расходов  начало--> 
      <script type="text/javascript"> 
        $(document).ready(function () {
          var max_fields = 10;
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
                '<select name = "pausalniNaklad[]" class="add_select" >'+
                <?php // список служеб из массива в services.php
                  $servicesCount = count($services);
                  $i = 1;
                  while ($i < $servicesCount)
                  {
                      echo("'<option value =" . $i . ">" . $services[$i] . "</option>'+");
                      $i++;
                  }
                ?>
                '</select>'+
                '<input type="number" class="currency" name="servicesCost[]" step="any" placeholder="zadej vyši nákladu"/>'+
                '<a href="#" class="remove_field">'+
                '<i class="fa fa-times"></i>'+
                '</a></div>'
              ); 
     
            }
          });

          $(wrapper).on("click", ".remove_field", function (e) {
            e.preventDefault();
            console.log('Ready to del');
            $(this).parent('div').remove();
            x--;
          })
        });
      </script> 

      <input type="submit" value="Odeslat"/>
      
    
    


    </form>



  </div>



</body>

</html>