<svg style="display: none;">
    <symbol id="minus" viewBox="0 0 32 32">
        <!--icon Minus-->
        <g>
            <path d="M20,17h-8c-0.5522461,0-1-0.4472656-1-1s0.4477539-1,1-1h8c0.5522461,0,1,0.4472656,1,1S20.5522461,17,20,17z" />
        </g>
        <g>
            <path d="M24.71875,29H7.28125C4.9204102,29,3,27.0791016,3,24.71875V7.28125C3,4.9208984,4.9204102,3,7.28125,3h17.4375    C27.0795898,3,29,4.9208984,29,7.28125v17.4375C29,27.0791016,27.0795898,29,24.71875,29z M7.28125,5    C6.0234375,5,5,6.0234375,5,7.28125v17.4375C5,25.9765625,6.0234375,27,7.28125,27h17.4375    C25.9765625,27,27,25.9765625,27,24.71875V7.28125C27,6.0234375,25.9765625,5,24.71875,5H7.28125z" />
        </g>
    </symbol>
</svg>
<svg style="display: none;">
    <symbol id="plus" viewBox="0 0 96 96">
        <!--icon Plus-->
        <g>
            <path d="M80,4H16C9.37,4,4,9.37,4,16v64c0,6.63,5.37,12,12,12h64c6.63,0,12-5.37,12-12V16C92,9.37,86.63,4,80,4z M84,80  c0,2.21-1.79,4-4,4H16c-2.21,0-4-1.79-4-4V16c0-2.21,1.79-4,4-4h64c2.21,0,4,1.79,4,4V80z" />
            <path d="M64,44H52V32c0-2.209-1.791-4-4-4s-4,1.791-4,4v12H32c-2.209,0-4,1.791-4,4s1.791,4,4,4h12v12c0,2.209,1.791,4,4,4  s4-1.791,4-4V52h12c2.209,0,4-1.791,4-4S66.209,44,64,44z" />
        </g>
    </symbol>
</svg>
<svg style="display:none;">
    <!--icon Help-->
    <symbol id="help" viewBox="0 0 24 24">
        <g>
            <path d="M0 0h24v24H0z" fill="none" />
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 17h-2v-2h2v2zm2.07-7.75l-.9.92C13.45 12.9 13 13.5 13 15h-2v-.5c0-1.1.45-2.1 1.17-2.83l1.24-1.26c.37-.36.59-.86.59-1.41 0-1.1-.9-2-2-2s-2 .9-2 2H8c0-2.21 1.79-4 4-4s4 1.79 4 4c0 .88-.36 1.68-.93 2.25z" />
        </g>
    </symbol>
</svg>



<div class="container">
    <h1 class="title">Vyúčtování služeb spojených s užíváním bytu </h1>
    <form method="POST" class="form" name="services" action="/applications/services-calc">

        <h2 class="subtitle">I. Pronajímatel </h2>

        <label for="landlordName" class="label_text">Jméno a přímení / Název firmy *</label><br />
        <input type="text" name="landlordName" id="landlordName" class="field-1" maxlength="75" value="<?=$data['landlordName']?>"><br />

        <label for="landlordAddress" class="label_text">Adresa *</label><br />
        <input type="text" name="landlordAddress" id="landlordAddress" class="field-1" maxlength="75" value="<?=$data['landlordAddress']?>"><br />

        <label for="accountNumber" class="label_text">Číslo účtu </label><br />
        <input type="text" name="accountNumber" id="accountNumber" class="field-1" maxlength="75" value="<?=$data['accountNumber'] ?>"><br />

        <h2 class="subtitle">II. Nemovitost </h2>

        <label for="propertyAddress" class="label_text">Adresa nemovitosti *</label><br />
        <input type="text" name="propertyAddress" id="propertyAddress" class="field-1" maxlength="75" value="<?=$data['propertyAddress'] ?>"><br />

        <div class="text-help">
            <label for="propertyType" class="label_text">Popis nemovitosti *</label><br />
            <svg class="icon_help help-right-text" data-hint="#real-hint-1">
                <use xlink: href="#help"></use>
            </svg>
        </div>
        <input type="text" name="propertyType" id="propertyType" class="field-1" maxlength="75" value="<?=$data['propertyType'] ?>">

        <h2 class="subtitle">III. Nájemník </h2>

        <label for="tenantName" class="label_text">Jméno a přímení / Název firmy *</label><br />
        <input type="text" name="tenantName" id="tenantName" class="field-1" maxlength="75" value="<?= $data['tenantName'] ?>"><br />

        <label for="tenantAddress" class="label_text">Adresa *</label><br />
        <input type="text" name="tenantAddress" id="tenantAddress" class="field-1" maxlength="75" value="<?=$data['tenantAddress'] ?>"><br />

        <h2 class="subtitle">IV. Správce </h2>

        <label for="adminName" class="label_text">Název firmy, vykonávající správu domu</label><br />
        <input type="text" name="adminName" id="adminName" class="field-1" maxlength="75" value="<?= $data['adminName'] ?>"><br />

        <h2 class="subtitle">V. Vyúčtování za období</h2>

        <div class="text-help">
            <h3 class="h3-subtitle">Vyučtování spravce zpracovano za období:</h3>
            <svg class="icon_help help-right-text" data-hint="#real-hint-2">
                <use xlink: href="#help"></use>
            </svg>
        </div>

        <div class="date">
            <label for="calcStartDate" class="label_text">Počáteční datum vyúčtování spravce *</label><br />
            <input type="date" class="field-start-date" name="calcStartDate" id="calcStartDate" value="<?=$data['calcStartDate'] ?>"><br />
        </div>
        <div class="date">
            <label for="calcFinishDate" class="label_text">Koneční datum vyúčtování spravce *</label><br />
            <input type="date" class="field-finish-date" name="calcFinishDate" id="calcFinishDate" value="<?=$data['calcFinishDate'] ?>"><br />
        </div>

        <div class="text-help">
            <h3 class="h3-subtitle">Vyúčtování pronajmatele zpracovano za období:</h3>
            <svg class="icon_help help-right-text" data-hint="#real-hint-3">
                <use xlink: href="#help"></use>
            </svg>
        </div>
        <div class="date">
            <label for="rentStartDate" class="label_text">Počáteční datum vyúčtování pronajmatele *</label><br />
            <input type="date" name="rentStartDate" class="field-start-rent" id="rentStartDate" class="field" value="<?= $data['rentStartDate'] ?>"><br />
        </div>
        <div class="date">
            <label for="rentFinishDate" class="label_text">Koneční datum vyúčtování pronajmatele *</label><br />
            <input type="date" name="rentFinishDate" class="field-finish-rent" id="rentFinishDate" class="field" value="<?= $data['rentFinishDate'] ?>"><br />
        </div>

        <h2 class="subtitle">VI. Paušální náklady </h2>

        <div class="text-help">
            <label class="label_text" id="label_text">Vyberte náklad a zadejte částku *</label><br />
            <svg class="icon_help help-right-text" data-hint="#real-hint-4">
                <use xlink: href="#help"></use>
            </svg>
        </div>

        <div class="add_input_fields">
            <div class="add_field first-field">
                <select name="pausalniNaklad[]" class="select-list" id="test1" style="width: 55%">
                    <option value="<?=$data['pausalniNaklad'][0]; ?>"><?=$data['pausalniNaklad'][0]; ?></option>
                </select>
                <input type="number" class="right-field" name="servicesCost[]" id="servicesCost1" step="any" placeholder="Zadej častku v Kč" value="<?=$data['servicesCost'][0] ?>" />
            </div>
            <!-- /.add_field first-field-->

            <?php for ($i = 1; $i <= count($data['pausalniNaklad']); $i++):?>
                <?php if(!empty($data['pausalniNaklad'][$i])): ?>

                    <div class="add_field costs_added_after" id="<?= ($i+1)?>">
                        <select name="pausalniNaklad[]" class="added-content select-list" id="test<?= ($i+1)?>" style="width: 55%">
                            <option value="<?=$data['pausalniNaklad'][$i]; ?>"><?=$data['pausalniNaklad'][$i]; ?></option>
                        </select>
                        <input type="number" class="right-field" name="servicesCost[]" id="servicesCost<?= ($i+1)?>" step="any" placeholder="Zadej častku v Kč" value="<?=$data['servicesCost'][$i]; ?>"/>
                        <a href="#" class="remove_field">
                            <svg class="icon_minus">
                                <use xlink: href = "#minus" ></use >
                            </svg >
                            <span class = "icon_title">Odebrat</span>
                        </a>
                    </div>
                    <!-- /.add_field costs_added_after -->
                <?php endif; ?>
            <?php endfor; ?>

        </div>
        <!-- /.add_input_fields -->

        <a href="#" class="add_input_fields_button">
            <svg class="icon_plus">
                <use xlink: href="#plus"></use>
            </svg>
            <span class="icon_title">Přidat náklad</span>
        </a>


        <h2 class="subtitle">VII. Odečty měřičů</h2>

        <div class="text-help">
            <label class="label_text" id="label_text">Vyberte si druh měřiče a zadejte počáteční a koneční stavy *</label><br />
            <svg class="icon_help help-right-text" data-hint="#real-hint-5">
                <use xlink: href="#help"></use>
            </svg>
        </div>

        <div class="add_meters">
            <div class="add_meters_added_field first-field">
                <select name="appMeters[]" class="select-list-meters" id="load_php_meters1" style="width: 21%">
                    <option value="<?= $data['appMeters'][0]; ?>"><?= $data['appMeters'][0]; ?></option>
                </select>
                <input type="number" class="field right-field" name="initialValue[]" id="initialValue1" step="any" placeholder="Počateční stav" style="width: 16%" value="<?= $data['initialValue'][0] ?>" />
                <input type="number" class="field last-field" name="endValue[]" id="endValue1" step="any" placeholder="Koneční stav" style="width: 16%" value="<?= $data['endValue'][0] ?>" />
                <input type="text" class="field last-field" name="meterNumber[]" id="meterNumber1" placeholder="Číslo měříče" style="width: 27%" value="<?= $data['meterNumber'][0] ?>" />
            </div>
            <!-- /.add_meters_added_field first-field -->

            <?php for ($i = 1; $i <= count($data['appMeters']); $i++):?>
                <?php if(!empty($data['appMeters'][$i])): ?>
                    <div class="add_meters_added_field meters_added_after" id="<?= ($i+1)?>">
                        <select name="appMeters[]" class="added-content-meters select-list" id="load_php_meters<?=($i+1)?>" style="width: 21%">
                            <option value="<?= $data['appMeters'][$i]?>"><?= $data['appMeters'][$i]?></option>
                        </select>
                        <input type="number" class="field right-field" name="initialValue[]" id="initialValue<?= ($i+1)?>" step="any" placeholder="Počateční stav" style="width: 16%" value="<?= $data['initialValue'][$i]?>"/>
                        <input type="number" class="field last-field" name="endValue[]" id="endValue<?= ($i+1)?>" step="any" placeholder="Koneční stav" style="width: 16%" value="<?= $data['endValue'][$i]?>"/>
                        <input type="text" class="field last-field" name="meterNumber[]" id="meterNumber<?= ($i+1)?>" placeholder="Číslo měříče" style="width: 27%" value="<?= $data['endValue'][$i]?>"/>
                        <a href="#" class="remove_meters">
                            <svg class="icon_minus">
                                <use xlink: href = "#minus" ></use >
                            </svg >
                            <span class = "icon_title">Odebrat</span>
                        </a>
                    </div>
                    <!-- /.add_meters_added_field meters_added_after -->
                <?php endif; ?>
            <?php endfor; ?>

        </div>
        <!-- /.add_meters -->

        <a href="#" class="add_meters_button">
            <svg class="icon_plus">
                <use xlink: href="#plus"></use>
            </svg>
            <span class="icon_title">Přidat meřič</span>
        </a>

        <div class="text-help">
            <label class="label_text" id="label_text">Vyber z uvedených možnosti zdroje odečtů měřičů</label>
        </div>

        <div class="origins">
            <label class="label_text">Zdroj počátečních stavů měřičů </label>
            <select name="originMeterStart" class="select-list-origin-start" id="load_php_origin_start" style="width: 32.5%">
                <option value="<?= $data['originMeterStart']; ?>"><?= $data['originMeterStart']; ?></option>
            </select>
        </div>
        <div class="origins">
            <label class="label_text">Zdroj konečných stavů měřičů </label>
            <select name="originMeterEnd" class="select-list-origin-end" id="load_php_origin_end" style="width: 32.5%">
                <option value="<?= $data['originMeterEnd']; ?>"><?= $data['originMeterEnd']; ?></option>
            </select>
        </div>

        <div class="coefficient_label_text text-help">
            <label class="label_text" id="label_text">
                <span>Byly ve vyúčtování od správce použité nějaké koeficienty pro vypočet spotřeby </span><br>
                <span>UT (ústředního topení)?</span>
            </label>
            <svg class="icon_help help-right-text" data-hint="#real-hint-6">
                <use xlink: href="#help"></use>
            </svg>
        </div>

        <div class="chekbox_coefficient">
            <label class="label_text" for="ano_coefficient">Ano</label>
            <input type="radio" id="ano_coefficient" name="coefficient" value="Ano">
        </div>
        <div class="chekbox_coefficient">
            <label class="label_text" for="ne_coefficient">Ne</label>
            <input type="radio" id="ne_coefficient" name="coefficient" value="Ne">
        </div>
        <div class="coefficient">

            <?php if(!empty($data['coefficientValue'][0])): ?>

                <div class = "add_coefficient">
                    <div class="add_coefficient_field">
                        <input type = "number" class = "coefficient_field" id = "coefficientValue1" name = "coefficientValue[]" step = "any" placeholder = "zadej koeficient" value="<?=$data['coefficientValue'][0] ?>"/><br/>


                        <?php for ($i = 1; $i <= count($data['coefficientValue']); $i++):?>
                            <?php if (!empty($data['coefficientValue'][$i])): ?>
                                <div class = "coefficient_added_field" id="<?= ($i+1); ?>">
                                    <input type="number" class="coefficient_field added_coefficient_field" id="coefficientValue<?= ($i + 1); ?>" name="coefficientValue[]" step="any" placeholder="zadej koeficent" value="<?= $data['coefficientValue'][$i]?>" />
                                    <a href="#" class="remove_coefficients">
                                        <svg class="icon_minus">
                                            <use xlink: href = "#minus" ></use >
                                        </svg ><span class = "icon_title">Odebrat</span>
                                    </a>
                                </div>
                                <!-- /.coefficient_added_field -->
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                    <!-- /.add_coefficient_field -->
                    <a href="#" class="add_coefficient_button">
                        <svg class="icon_plus">
                            <use xlink: href = "#plus"></use>
                        </svg>
                        <span class="icon_title">Přidat koeficient</span>
                    </a>
                </div>
                <!-- /.add_coefficient -->
            <?php endif; ?>

        </div>
        <!-- /.coefficient -->

        <h2 class="subtitle">VIII. Ceny energií</h2>

        <div class="text-help" style="align-items:center;">
            <h3 class="zakladni_slozka_title">Základní složka</h3>
            <svg class="icon_help help-right-text" style="margin-top: 0px" data-hint="#real-hint-7">
                <use xlink: href="#help"></use>
            </svg>
        </div>


        <div class="zakladni_slozka">
            <label for="constHotWaterPrice" class="label_text">Základní složka za ohřev teplé užitkové vody(TUV)</label>
            <input type="number" class="field field-slozky" id="constHotWaterPrice" name="constHotWaterPrice" step="any" placeholder="Zadej cenu" value="<?= $data['constHotWaterPrice'];?>" />
        </div>

        <div class="zakladni_slozka">
            <label for="constHeatingPrice" class="label_text">Základní složka za ústřední topení (UT)</label>
            <input type="number" class="field field-slozky" id="constHeatingPrice" name="constHeatingPrice" step="any" placeholder="Zadej cenu" value="<?= $data['constHeatingPrice']; ?>" />
        </div>

        <div class="text-help" style="align-items:center;">
            <h3 class="spotrebni_slozka_title">Spotřební složka</h3>
            <svg class="icon_help help-right-text" style="margin-top:10px" data-hint="#real-hint-8">
                <use xlink: href="#help"></use>
            </svg>
        </div>

        <div class="spotrebni_slozka">
            <label for="hotWaterPrice" class="label_text">Cena za ohřev 1 m3 teplé užitkové vody (TUV)</label>
            <input type="number" class="field field-slozky" id="hotWaterPrice" name="hotWaterPrice" step="any" placeholder="Zadej cenu jednotky" value="<?= $data['hotWaterPrice'];?>" />
        </div>

        <div class="spotrebni_slozka">
            <label for="coldWaterPrice" class="label_text">Cena za 1 m3 studené užitkové vody (SUV)</label>
            <input type="number" class="field field-slozky" id="coldWaterPrice" name="coldWaterPrice" step="any" placeholder="Zadej cenu jednotky" value="<?= $data['coldWaterPrice']; ?>" />
        </div>

        <div class="spotrebni_slozka">
            <label for="coldForHotWaterPrice" class="label_text">Cena 1 m3 studené užitkové vody, použité<br> pro přípravu teplé užitkové vody (SUV pro TUV)</label>
            <svg class="icon_help help-right-label" data-hint="#real-hint-9">
                <use xlink: href="#help"></use>
            </svg>
            <input type="number" class="field field-slozky" id="coldForHotWaterPrice" name="coldForHotWaterPrice" step="any" placeholder="Zadej cenu jednotky" value="<?= $data['coldForHotWaterPrice']; ?>" />
        </div>

        <div class="spotrebni_slozka">
            <label for="heatingPrice" class="label_text">Cena za jednotku ústředního topení (UT)</label>
            <input type="number" class="field field-slozky" id="heatingPrice" name="heatingPrice" step="any" placeholder="Zadej cenu jednotky" value="<?= $data['heatingPrice']; ?>" />
        </div>

        <h2 class="subtitle">IX. Uhrazené zálohy</h2>

        <div class="zalohy">
            <div class="zalohy_label">
                <label for="advancedPayments" class="label_text">Součet zaloh za služby, zaplacených najmeníkem v ramcích učtovácího období</label>
            </div>
            <input type="number" class="field field-slozky" id="advancedPayments" name="advancedPayments" step="any" placeholder="Zadej coučet záloh" value="<?= $data['advancedPayments']; ?>" />
        </div>

        <div class="errors_field">

        </div>

        <div class="submit_button_div">
            <input type="button" class="submit_button_refresh" id="btn_clear" value="Očistit" />
            <input type="submit" class="submit_button" id="btn_submit" value="Odeslat" />
        </div>

    </form>
</div>

<div id="real-hint-1" class="real-hint">
    <span>Např. Byt 3kk + parking; Atelier 1kk; číslo jednotky; podlaží apod. </span>
</div>
<div id="real-hint-2" class="real-hint">
    <span>Obvykle 1.01. – 31.12, ale v některých případech se muže lišit, např. dům byl předan do správy uprostřed roku (u novostaveb), změna majitele, změna správce apod. Počáteční a koneční data jsou vždycky uvedené ve vyúčtování správce.</span>
</div>
<div id="real-hint-3" class="real-hint">
    <span>Období obvykle ohraničeno začátkem nebo koncem kalendářního roku a dnem nastehování/odstěhování nájemníka. V případě, jestli nájemník bydlil od 1.01-31.12 doporučujeme použit zjednodušenou kalkulaci.</span>
</div>
<div id="real-hint-4" class="real-hint">
    <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud</span>
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
<div id="real-hint-9" class="real-hint">
    <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud</span>
</div>
