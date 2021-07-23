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
  <title>Vyúčtování</title>
</head>

<body>
  <div class="container">
    <h1 class="title">Vyúčtování služeb spojených s užíváním bytu </h1>
    <form method="POST" action="calculate.php" class="form">

      <h2 class="subtitle">I. Pronajímatel </h2>

      <label class="label_text">Jméno a přímení</label><br/>
      <input type="text" name="landlordName" placeholder="Zadej jméno/název firmy" class="field"><br/>

      <label class="label_text">Adresa</label><br/>
      <input type="text" name="landlordAddress" placeholder="Zadej adresu/sídlo firmy" class="field"><br/>

      <label class="label_text">Adresa nemovitosti</label><br/>
      <input type="text" name="propertyAddress" placeholder="Zadej adresu pronajaté nemovitosti" class="field"><br/>

      <label class="label_text">Popis nemovitosti</label><br/>
      <input type="text" name="propertyType" placeholder="Popis nemovitosi (Byt 1kk, Atelier 2kk, Rodinný dům atd.)" class="field"><br/>

      <h2 class="subtitle">II. Nájemník </h2>

      <label class="label_text">Jméno a přímení</label><br/>
      <input type="text" name="tenantName" placeholder="Zadej jméno/název firmy" class="field"><br/>

      <label class="label_text">Adresa</label><br/>
      <input type="text" name="tenantAddress" placeholder="Zadej adresu/sídlo firmy" class="field"><br/>

      <h2 class="subtitle">III. Vyúčtování za období</h2>

      <label class="label_text">Počáteční datum</label><br/>
      <input type="date" name="rentStartDate" class="field"><br/>

      <label class="label_text">Koneční datum</label><br/>
      <input type="date" name="rentFinishDate" class="field"><br/>

      <h2 class="subtitle">IV. Paušální náklady  </h2>

      <label class="label_text">Vyberte náklad a zadejte částku</label><br/>

      <div class="add_input_fields">
        <select name="pausalniNaklad[]">
          <?php include 'services_list.php';?>
        </select>
        <input type="number" class="field" name="servicesCost[]" step="any" placeholder="Zadej výši nákladu"/>   
      </div>
     
      <button type="button" class="add_input_fields_button"><i class="add_title">Přidat řádek</i></button><br/>
      

      <input type="submit" class="submit_button" value="Odeslat"/>
      
         


    </form>



  </div>

<script src="js/main.js"></script>


</body>

</html>