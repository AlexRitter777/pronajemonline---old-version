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
<svg style="display:none;">
    <!--Иконка Help-->
    <symbol id="help" viewBox="0 0 24 24">
        <g>
            <path d="M0 0h24v24H0z" fill="none" />
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 17h-2v-2h2v2zm2.07-7.75l-.9.92C13.45 12.9 13 13.5 13 15h-2v-.5c0-1.1.45-2.1 1.17-2.83l1.24-1.26c.37-.36.59-.86.59-1.41 0-1.1-.9-2-2-2s-2 .9-2 2H8c0-2.21 1.79-4 4-4s4 1.79 4 4c0 .88-.36 1.68-.93 2.25z" />
        </g>
    </symbol>
</svg>

<div class="container">
    <h1 class="title">Vyúčtování kauce</h1>
    <form method="POST" class="form" action="/applications/deposit-calc" name="deposit">

        <h2 class="subtitle">I. Pronajímatel </h2>

        <label for="landlordName" class="label_text">Jméno a přímení / Název firmy *</label><br />
        <input type="text" name="landlordName" id="landlordName" class="field-1" maxlength="75" value="<?= $data['landlordName'];?>"><br />

        <label for="landlordAddress" class="label_text">Adresa *</label><br />
        <input type="text" name="landlordAddress" id="landlordAddress" class="field-1" maxlength="75" value="<?= $data['landlordAddress'];?>"><br />

        <label for="accountNumber" class="label_text">Číslo účtu </label><br />
        <input type="text" name="accountNumber" id="accountNumber" class="field-1" maxlength="75" value="<?= $data['accountNumber'];?>"><br />

        <h2 class="subtitle">II. Nemovitost </h2>

        <label for="propertyAddress" class="label_text">Adresa nemovitosti *</label><br />
        <input type="text" name="propertyAddress" id="propertyAddress" class="field-1" maxlength="75" value="<?= $data['propertyAddress'];?>"><br />

        <div class="text-help">
            <label for="propertyType" class="label_text">Popis nemovitosti *</label><br />
            <svg class="icon_help help-right-text" data-hint="#real-hint-1">
                <use xlink: href="#help"></use>
            </svg>
        </div>
        <input type="text" name="propertyType" id="propertyType" class="field-1" maxlength="75" value="<?= $data['propertyType'];?>">

        <h2 class="subtitle">III. Nájemník </h2>

        <label for="tenantName" class="label_text">Jméno a přímení / Název firmy *</label><br />
        <input type="text" name="tenantName" id="tenantName" class="field-1" maxlength="75" value="<?= $data['tenantName'];?>"><br />

        <label for="tenantAddress" class="label_text">Adresa *</label><br />
        <input type="text" name="tenantAddress" id="tenantAddress" class="field-1" maxlength="75" value="<?= $data['tenantAddress'];?>"><br />


        <h2 class="subtitle">IV. Nájemní smlouva</h2>

        <div class="date">
            <label for="rentStartDate" class="label_text">Nájemní smlouva uzavřená dne:*</label><br />
            <input type="date" name="rentStartDate" class="field-start-deposit" id="rentStartDate" class="field" value="<?= $data['rentStartDate'];?>"><br />
        </div>

        <div class="date">
            <label for="rentFinishDate" class="label_text">Nájemní smlouva uzavřená dne:*</label><br />
            <input type="date" name="rentFinishDate" class="field-finish-deposit" id="rentFinishDate" class="field" value="<?= $data['rentFinishDate'];?>"><br />
        </div>

        <div class="origins">
            <label class="label_text">Důvod úkončení nájmu </label>
            <select name="rentFinishReason" class="select-list-rent_finish_reason" id="load_php_rent_finish_reason" style="width: 32.5%">
                <option value="<?= $data['rentFinishReason'];?>"><?= $data['rentFinishReason'];?></option>
            </select>
        </div>


        <h2 class="subtitle">V. Položky vyúčtování </h2>

        <div class="add_input_fields_deposit_items">
            <div class="add_deposit_added_field first-field" id="1">
                <select name="depositItems[]" class="select-list-deposit" id="load_php_deposit_items1" style="width: 55%">
                    <option value="<?=$data['depositItems'][0]; ?>"><?=$data['depositItems'][0]; ?></option>
                </select>
                <input type="number" class="right-field" name="depositItemsPrice[]" id="deposit_items_price1" step="any" placeholder="Zadej častku v Kč" value="<?= ($data['depositItemsPrice'][0] < 0) ? ($data['depositItemsPrice'][0] * (-1)) : $data['depositItemsPrice'][0]  ?>" />
            </div>
            <!-- /.add_deposit_added_field first-field-->

            <div class="deposit_append" id="deposit_append1">
                <?php if(!empty($data['depositItems'][0])) : ?>
                    <?php if(!empty($data['damageDesc'][0])) : ?>
                        <div class="dates_append" style="display: none">
                            <label class="label_text">Vyúčtování za období</label>
                            <input type="date" name="itemsStartDate[]" class="field-deposit" id="itemsStartDate1" class="field" value="<?= $data['itemsStartDate'][0] ?>"/>
                            <input type="date" name="itemsFinishDate[]" class="field-deposit" id="itemsFinishDate1" class="field" value="<?= $data['itemsFinishDate'][0] ?>"/>
                        </div>
                        <!-- /.dates_append-->

                        <div class="description_append">
                            <label class="label_text">Popis závady/poškození</label>
                            <input type="text" name="damageDesc[]" class="description_field" id="damageDesc1" value="<?= $data['damageDesc'][0] ?>"/>
                        </div>
                        <!-- /.description_append-->
                        <div class="border"></div>
                    <?php else: ?>
                        <div class="dates_append">
                            <label class="label_text">Vyúčtování za období</label>
                            <input type="date" name="itemsStartDate[]" class="field-deposit" id="itemsStartDate1" class="field" value="<?= $data['itemsStartDate'][0] ?>"/>
                            <input type="date" name="itemsFinishDate[]" class="field-deposit" id="itemsFinishDate1" class="field"  value="<?= $data['itemsFinishDate'][0] ?>"/>
                        </div>
                        <!-- /.dates_append-->

                        <div class="description_append" style="display: none">
                            <label class="label_text">Popis závady/poškození</label>
                            <input type="text" name="damageDesc[]" class="description_field" id="damageDesc1" value="<?= $data['damageDesc'][0] ?>"/>
                        </div>
                        <!-- /.description_append-->
                        <div class="border"></div>
                    <?php endif;?>
                    <script>
                        $(window).on('load', function() {
                            $('.add_input_fields_deposit_items_button').css('display', '');
                        })
                    </script>
                <?php endif;?>
            </div>
            <!-- /.deposit_append-->

            <?php for ($i = 1; $i < count($data['depositItems']); $i++):?>
                <?php if(!empty($data['depositItems'][$i])): ?>
                    <div class="add_deposit_added_field deposit_added_after" id="<?= ($i+1);?>">
                        <select name="depositItems[]" class="select-list-deposit" id="load_php_deposit_items<?= ($i+1);?>" style="width: 55%">
                            <option value="<?=$data['depositItems'][$i]; ?>"><?=$data['depositItems'][$i]; ?></option>
                        </select>
                        <input type="number" class="right-field" name="depositItemsPrice[]" id="deposit_items_price<?= ($i+1);?>" step="any" placeholder="Zadej častku v Kč" value="<?= ($data['depositItemsPrice'][$i] < 0) ? ($data['depositItemsPrice'][$i] * (-1)) : $data['depositItemsPrice'][$i]  ?>" />
                        <a href="#" class="remove_field">
                            <svg class="icon_minus">
                                <use xlink: href = "#minus" >
                                </use >
                            </svg >
                            <span class = "icon_title">Odebrat</span>
                        </a>
                    </div>

                    <div class="deposit_append" id="deposit_append<?=  ($i+1);?>">
                        <?php if(!empty($data['depositItems'][$i])) : ?>
                            <?php if(!empty($data['damageDesc'][$i])) : ?>
                                <div class="dates_append" style="display: none">
                                    <label class="label_text">Vyúčtování za období</label>
                                    <input type="date" name="itemsStartDate[]" class="field-deposit" id="itemsStartDate<?=  ($i+1);?>" class="field" value="<?= $data['itemsStartDate'][$i] ?>"/>
                                    <input type="date" name="itemsFinishDate[]" class="field-deposit" id="itemsFinishDate<?=  ($i+1);?>" class="field" value="<?= $data['itemsFinishDate'][$i] ?>"/>
                                </div>
                                <!-- /.dates_append-->

                                <div class="description_append">
                                    <label class="label_text">Popis závady/poškození</label>
                                    <input type="text" name="damageDesc[]" class="description_field" id="damageDesc<?=  ($i+1);?>" value="<?= $data['damageDesc'][$i] ?>"/>
                                </div>
                                <!-- /.description_append-->
                                <div class="border"></div>
                            <?php else: ?>
                                <div class="dates_append">
                                    <label class="label_text">Vyúčtování za období</label>
                                    <input type="date" name="itemsStartDate[]" class="field-deposit" id="itemsStartDate<?=  ($i+1);?>" class="field" value="<?= $data['itemsStartDate'][$i] ?>"/>
                                    <input type="date" name="itemsFinishDate[]" class="field-deposit" id="itemsFinishDate<?=  ($i+1);?>" class="field"  value="<?= $data['itemsFinishDate'][$i] ?>"/>
                                </div>
                                <!-- /.dates_append-->

                                <div class="description_append" style="display: none">
                                    <label class="label_text">Popis závady/poškození</label>
                                    <input type="text" name="damageDesc[]" class="description_field" id="damageDesc<?=  ($i+1);?>" value="<?= $data['damageDesc'][$i] ?>"/>
                                </div>
                                <!-- /.description_append-->
                                <div class="border"></div>
                            <?php endif;?>
                            <script>
                                $(document).ready(function()  {
                                    $('.add_input_fields_deposit_items_button').css('display', '');
                                })
                            </script>
                        <?php endif;?>
                    </div>
                    <!-- /.deposit_append-->
                <?php endif;?>
            <?php endfor;?>




        </div>
        <!-- /.add_input_fields_deposit_items -->

        <a href="#" class="add_input_fields_deposit_items_button" style="display: none;">
            <svg class="icon_plus">
                <use xlink: href="#plus"></use>
            </svg>
            <span class="icon_title">Přidat řadek</span>
        </a>




        <h2 class="subtitle">VI. Složená kauce</h2>

        <div class="zalohy_deposit">
            <div class="zalohy_deposit_label">
                <label for="deposit" class="label_text">Kauce složená nájemníkem při podepsání smlouvy</label>
            </div>
            <input type="number" class="field field-ceny-deposit" id="deposit" name="deposit" step="any" placeholder="Zadej častku v Kč" value="<?= $data['deposit'];?>" />
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
    <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud</span>
</div>
<div id="real-hint-3" class="real-hint">
    <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud</span>
</div>
