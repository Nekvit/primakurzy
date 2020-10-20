<div class="kontaktBox" id="rezervaceBox">
    <h1>REZeRvACE</h1>
    <form action="#rezervaceBox" method="POST" class="formular"
    id="rezervaceForm">

        <div class="chyba" id="chyba-jmeno"></div>
        <input type="text" name="jmeno" placeholder="Jméno" />
        <div class="chyba" id="chyba-prijmeni"></div>
        <input type="text" name="prijmeni" placeholder="Příjmení" /> 
        <div class="chyba" id="chyba-email"></div>
        <input type="text" name="mail" placeholder="Email" />
        
        <div class="chyba" id="chyba-deti"></div>
        <select name="deti">
            <option>Počet dětí</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        
        <div class="chyba" id="chyba-dospeli"></div>
        <select name="dospeli">
            <option>Počet dospělích</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        
        <div class="chyba" id="chyba-prijezd"></div>
        <input type="text" class="calendar" placeholder="Datum příjezdu" /> 
        <div class="chyba" id="chyba-odjezd"></div>
        <input type="text" class="calendar" placeholder="Datum odjezdu" /> 
        <textarea name="vzkaz" rows="10" placeholder="Napište nám.."></textarea> 
        <input class="button" type="submit" value="ODEŠLI" />

    </form>
</div>

<script>

    $('#rezervaceForm').on("submit", (udalost) => {
        //alert("It works.");
        var ok = true;

        //sber chyb
        if ($('[name = jmeno]').val() == "") { //val() vraci hodnotu v elementu
            ok = false;
            $('#chyba-jmeno').html("Musí být vyplněno");
        }
        else {
            $('#chyba-jmeno').html(""); // když opravíme chybu, chybová hláška zmizí
        }

        if ($('[name = prijmeni]').val() == "") {
            ok = false;
            $('#chyba-prijmeni').html("Musí být vyplněno");
        }
        else {
            $('#chyba-prijmeni').html("");
        }

        /////ZBYTEK JE STEJNÝ JAKO NA KONTAKTU
  
        //kdyz jsou chyby
        if (!ok) {
            
            $("html, body").animate({ scrollTop: $('#rezervaceBox').offset().top }, 1000, "easeInOutQuart"); //offset vraci souradnice elementu #rezervaceBox v tomto pripade jeho topu.

            udalost.preventDefault();
        }
    })




    $.datepicker.regional.cs = {
        closeText: 'Zavřít',
        prevText: 'Dříve',
        nextText: 'Později',
        currentText: 'Nyní',
        monthNames: ['leden','únor','březen','duben','květen','červen', 'červenec','srpen','září','říjen','listopad','prosinec'],
        monthNamesShort: ['leden','únor','březen','duben','květen','červen', 'červenec','srpen','září','říjen','listopad','prosinec'],
        dayNames: ['neděle', 'pondělí', 'úterý', 'středa', 'čtvrtek', 'pátek', 'sobota'],
        dayNamesShort: ['ne', 'po', 'út', 'st', 'čt', 'pá', 'so'],
        dayNamesMin: ['ne','po','út','st','čt','pá','so'],
        weekHeader: 'Týd',
        dateFormat: 'dd.mm.yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: '',
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        yearRange: "c-100:c+50"
    };

    $.datepicker.setDefaults( $.datepicker.regional.cs );

    $('.calendar').datepicker({
        showAnim : "drop"
    });

</script>