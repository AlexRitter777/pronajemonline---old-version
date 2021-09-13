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
  <script src="vd.js"></script>
  <title>Vyúčtování</title>
</head>

<body>
  <svg style="display: none;">
    <symbol id="minus" viewBox="0 0 32 32"> <!--Иконка Minus-->
      <g>
        <path d="M20,17h-8c-0.5522461,0-1-0.4472656-1-1s0.4477539-1,1-1h8c0.5522461,0,1,0.4472656,1,1S20.5522461,17,20,17z"/></g><g><path d="M24.71875,29H7.28125C4.9204102,29,3,27.0791016,3,24.71875V7.28125C3,4.9208984,4.9204102,3,7.28125,3h17.4375    C27.0795898,3,29,4.9208984,29,7.28125v17.4375C29,27.0791016,27.0795898,29,24.71875,29z M7.28125,5    C6.0234375,5,5,6.0234375,5,7.28125v17.4375C5,25.9765625,6.0234375,27,7.28125,27h17.4375    C25.9765625,27,27,25.9765625,27,24.71875V7.28125C27,6.0234375,25.9765625,5,24.71875,5H7.28125z"/>
      </g>
    </symbol>
  </svg>
  <svg style="display: none;">
    <symbol id="plus" viewBox="0 0 96 96"> <!--Иконка Plus-->
      <g>
        <path d="M80,4H16C9.37,4,4,9.37,4,16v64c0,6.63,5.37,12,12,12h64c6.63,0,12-5.37,12-12V16C92,9.37,86.63,4,80,4z M84,80  c0,2.21-1.79,4-4,4H16c-2.21,0-4-1.79-4-4V16c0-2.21,1.79-4,4-4h64c2.21,0,4,1.79,4,4V80z"/><path d="M64,44H52V32c0-2.209-1.791-4-4-4s-4,1.791-4,4v12H32c-2.209,0-4,1.791-4,4s1.791,4,4,4h12v12c0,2.209,1.791,4,4,4  s4-1.791,4-4V52h12c2.209,0,4-1.791,4-4S66.209,44,64,44z"/>
      </g>
    </symbol>
  </svg>
  <svg style="display:none;"> <!--Иконка Help-->
   <symbol id="help" viewBox="0 0 24 24"> 
      <g>
        <path d="M0 0h24v24H0z" fill="none"/>
        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 17h-2v-2h2v2zm2.07-7.75l-.9.92C13.45 12.9 13 13.5 13 15h-2v-.5c0-1.1.45-2.1 1.17-2.83l1.24-1.26c.37-.36.59-.86.59-1.41 0-1.1-.9-2-2-2s-2 .9-2 2H8c0-2.21 1.79-4 4-4s4 1.79 4 4c0 .88-.36 1.68-.93 2.25z"/>
      </g>
    </symbol>
  </svg>


  <div class="container">
    <h1 class="title">Vyúčtování služeb spojených s užíváním bytu </h1>
    <form method="POST" class="form">

      <h2 class="subtitle">I. Pronajímatel </h2>

      <label class="label_text">Jméno a přímení / Název firmy *</label><br/>
      <input type="text" name="landlordName" id = "landlordName" class="field-1" ><br/>
      
      <label class="label_text">Adresa *</label><br/>
      <input type="text" name="landlordAddress" id="landlordAddress" class="field-1"><br/>

      <label class="label_text">Adresa nemovitosti *</label><br/>
      <input type="text" name="propertyAddress" id="propertyAddress" class="field-1"><br/>

      <div class="text-help">
        <label class="label_text">Popis nemovitosti</label><br/>
        <svg class="icon_help help-right-text" data-hint="#real-hint-1"> 
          <use xlink: href = "#help"></use>
        </svg>
      </div>
      <input type="text" name="propertyType" id="propertyType" class="field-1">
        
      <h2 class="subtitle">II. Nájemník </h2>

      <label class="label_text">Jméno a přímení / Název firmy *</label><br/>
      <input type="text" name="tenantName" id="tenantName" class="field-1"><br/>

      <label class="label_text">Adresa *</label><br/>
      <input type="text" name="tenantAddress" id="tenantAddress" class="field-1"><br/>

      <h2 class="subtitle">III. Vyúčtování za období</h2>

      <div class="text-help">
        <h3 class="h3-subtitle">Vyučtování spravce zpracovano za období:</h3>
        <svg class="icon_help help-right-text" data-hint="#real-hint-2"> 
          <use xlink: href = "#help"></use>
        </svg>
      </div>  


      <label class="label_text">Počáteční datum</label><br/>
      <input type="date" name="calcStartDate" id="calcStartDate" class="field"><br/>

      <label class="label_text">Koneční datum</label><br/>
      <input type="date" name="calcFinishDate" id="calcFinishDate" class="field"><br/>

      <div class="text-help">
        <h3 class="h3-subtitle">Vyučtování pronajmatele zpracovano za období:</h3>
        <svg class="icon_help help-right-text" data-hint="#real-hint-3"> 
          <use xlink: href = "#help"></use>
        </svg>
      </div>  

      <label class="label_text">Počáteční datum</label><br/>
      <input type="date" name="rentStartDate"  id="rentStartDate" class="field"><br/>

      <label class="label_text">Koneční datum</label><br/>
      <input type="date" name="rentFinishDate"  id="rentFinishDate" class="field"><br/>


      <h2 class="subtitle">IV. Paušální náklady  </h2>
      
      <div class="text-help">
        <label class="label_text">Vyberte náklad a zadejte částku</label><br/>
        <svg class="icon_help help-right-text" data-hint="#real-hint-4"> 
          <use xlink: href = "#help"></use>
        </svg>
      </div>

      <div class="add_input_fields">
        <div class="add_field">
          <select name="pausalniNaklad[]">
            <?php include 'services_list.php';?>
          </select>
          <input type="number" class="field" name="servicesCost[]" id="servicesCost1" step="any" placeholder="Zadej častku v Kč"/>   
        </div>    
      </div>
      
      <a href="#" class="add_input_fields_button">
        <svg class="icon_plus">
          <use xlink: href = "#plus"></use>
        </svg>
        <span class = "icon_title">Přidat náklad</span>
      </a>
        
     
      <h2 class="subtitle">V. Odečty měřičů</h2>

      <div class="text-help">
        <label class="label_text">Vyberte si druh měřiče a zadejte počáteční a koneční stavy</label><br/>
        <svg class="icon_help help-right-text" data-hint="#real-hint-5"> 
          <use xlink: href = "#help"></use>
        </svg>
      </div>

      <div class="add_meters">
        <div class="add_meters_added_field">
          <select name="appMeters[]">
            <?php include 'meters_list.php';?>
          </select>
          <input type="number" class="field" name="initialValue[]" id="initialValue1" step="any" placeholder="Zadej počateční stav"/>
          <input type="number" class="field" name="endValue[]" id="endValue1" step="any" placeholder="Zadej koneční stav"/>
        </div>
      </div>
     
      <a href="#" class="add_meters_button">
        <svg class="icon_plus">
          <use xlink: href = "#plus"></use>
        </svg>
        <span class = "icon_title">Přidat meřič</span>
      </a>
      
      <div class = "coefficient_label_text text-help">
          <label class="label_text ">
            <span>Byly ve vyúčtování od správce použité nějaké koeficienty pro vypočet spotřeby </span><br>
            <span>UT (ústředního topení)?</span>
          </label>
          <svg class="icon_help help-right-text" data-hint="#real-hint-6"> 
            <use xlink: href = "#help"></use>
          </svg>
      </div>

      <div class="chekbox_coefficient">
        <label class="label_text" for="ano_coefficient">Ano</label>  
        <input type="radio" id="ano_coefficient" name="coefficient" value="Ano">
      </div>
      <div class="chekbox_coefficient">
        <label class="label_text" for="ne_coefficient">Ne</label>  
        <input type="radio" id="ne_coefficient" name="coefficient" value="Ne" checked>
      </div>
      <div class="coefficient"></div>

      <h2 class="subtitle">VI. Ceny energií</h2>

      <div class="text-help" style="align-items:center;">
        <h3 class="zakladni_slozka_title">Základní složka</h3>
        <svg class="icon_help help-right-text" style="margin-top:10px" data-hint="#real-hint-7"> 
          <use xlink: href = "#help"></use>
        </svg>
      </div>

      <div class="zakladni_slozka">
        <label class="label_text">Základní složka za ohřev teplé užitkové vody(TUV)</label>
        <input type="number" class="field field-slozky" id = "constHotWaterPrice" name="constHotWaterPrice" step="any" placeholder="Zadej cenu" />
      </div>

      <div class="zakladni_slozka">  
        <label class="label_text">Základní složka za ústřední topení (UT)</label>
        <input type="number" class="field field-slozky" id = "constHeatingPrice" name="constHeatingPrice" step="any" placeholder="Zadej cenu" />
      </div>

      <div class="text-help" style="align-items:center;">
        <h3 class="spotrebni_slozka_title">Spotřební složka</h3>
        <svg class="icon_help help-right-text" style="margin-top:10px" data-hint="#real-hint-8"> 
          <use xlink: href = "#help"></use>
        </svg>
      </div>

      <div class="spotrebni_slozka">
        <label class="label_text">Cena za ohřev 1 m3 teple užitkové vody (TUV)</label>
        <input type="number" class="field field-slozky" id = "hotWaterPrice" name="hotWaterPrice" step="any" placeholder="Zadej cenu jednotky"/>
      </div>
      
      <div class="spotrebni_slozka">
        <label class="label_text">Cena za ohřev 1 m3 studené užitkové vody (SUV)</label>
        <input type="number" class="field field-slozky" id = "coldWaterPrice" name="coldWaterPrice" step="any" placeholder="Zadej cenu jednotky"/>
      </div>
      
      <div class="spotrebni_slozka">
        <label class="label_text">Cena za jednotku ústředního topení (UT)</label>
        <input type="number" class="field field-slozky" id = "heatingPrice" name="heatingPrice" step="any" placeholder="Zadej cenu jednotky"/>
      </div>

      <h2 class="subtitle">VII. Uhrazené zálohy</h2>

      <div class="zalohy">
        <div class="zalohy_label">
          <label class="label_text">Součet zaloh za služby, zaplacených najmeníkem v ramcích učtovácího období</label>
        </div>  
        <input type="number" class="field field-slozky" id = "advancedPayments" name="advancedPayments" step="any" placeholder="Zadej coučet záloh"/>
      </div>

      <div class="errors_field">
       
      </div>

      <div class="submit_button_div">
       <input type="submit" class="submit_button" id="btn_submit" value="Odeslat"/>
      </div>

    </form>
  </div>

  <div id="real-hint-1" class="real-hint">
    <span>Vyúčtování služeb spojených s užíváním bytu</span>
  </div>
  <div id="real-hint-2" class="real-hint">
    <span>Vyúčtování služeb spojených s užíváním bytu alalal</span>
  </div>
  <div id="real-hint-3" class="real-hint">
    <span>Byly ve vyúčtování od správce použité nějaké koeficienty pro vypočet spotřeby UT (ústředního topení)?</span>
  </div>
  <div id="real-hint-4" class="real-hint">
    <span>Byly ve vyúčtování od správce použité nějaké koeficienty pro vypočet spotřeby UT (ústředního topení)?</span>
  </div>
  <div id="real-hint-5" class="real-hint">
    <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud</span>
  </div>
  <div id="real-hint-6" class="real-hint">
    <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud</span>
  </div>
  <div id="real-hint-7" class="real-hint">
    <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud</span>
  </div>
  <div id="real-hint-8" class="real-hint">
    <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud</span>
  </div>

  <script src="js/main.js"></script>

</body>

</html>