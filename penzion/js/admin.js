
$(document).ready(() => {
    
    $("#listStranek").sortable({
        update : () => {

            var sortedIDs = $( "#listStranek" ).sortable( "toArray" );
            console.log(sortedIDs);

            $.ajax({
                "url" : "admin.php",
                "method" : "POST",
                "data" : {
                    "novePoradi" : sortedIDs,
                },
        }).fail(() => {
            alert("Nepodařilo se uložit pořadí stránek");
        })

        }
    });

  //  $( "#listStranek" ).on( "sortupdate", ( event, ui ) => {  alert("Zmena poradi");  } );       Toto je to same


})



