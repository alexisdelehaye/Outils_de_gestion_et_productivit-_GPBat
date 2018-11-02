var ids = [];

//permet à l'appui d'un bouton, d'effacer ou afficher des tableau
function toggle(id) {
        //si l'id est tableau-all, affiche tout les tableau
        if (id !== "all") {

            for (i = 0; i < ids.length; i++) { //fait tout disparaitre avant d'afficher ceui voulu
                document.getElementById("search-" + ids[i]).style.display = "none";
                document.getElementById("search-button-" + ids[i]).style.display = "none";
                document.getElementById("clear-" + ids[i]).style.display = "none";
                document.getElementById("tableau-" + ids[i]).style.display = "none";

            }
            //affiche le tableau souhaité
            document.getElementById("tableau-" + id).style.display = "block";
            document.getElementById("search-" + id).style.display = "block";
            document.getElementById("search-button-" + id).style.display = "block";
            document.getElementById("clear-" + id).style.display = "block";
            coloring("tableau-" + id);

            //sinon affiche seulement le tableau affecté au bouton
        } else {
            for (i = 0; i < ids.length; i++) {
                if (ids[i] === "") {

                } else {

                    document.getElementById("search-" + ids[i]).style.display = "block";
                    document.getElementById("search-button-" + ids[i]).style.display = "block";
                    document.getElementById("clear-" + ids[i]).style.display = "block";
                    document.getElementById("tableau-" + ids[i]).style.display = "block";
                    //coloring("tableau-" + ids[i]);

                }

            }

        }


}


function coloring(id) {

    //pour different types de tableau, passer un string en 2eme parametre, selon le string, color[] sera différent
    var color = [10]; // permet d'indiquer sur quelles colonnes est mise la couleur (vert/orange/rouge)
    var ready = ["ready"];//cellules verte
    var waiting = ["waiting"]; //cellules orange
    var notReady = ["not ready"]; //cellules rouge

    var lines = document.getElementById(id).getElementsByTagName("tr");
    var nCols = lines[1].getElementsByTagName("td").length;
    var count = 0;

    $('table tbody tr td').each(function() { //pour chaque td, récupére le contenu
        cellText = $(this).html().toLowerCase();

        for (i=0; i < color.length ; i++) {

            if (count === color[i] - 1) {
                if (ready.length !== (waiting.length || notReady.length)) { //ne fait rien si la longueur d'un des tableau est différente
                } else {

                    if (Number.isNaN(parseFloat(cellText)) === true) {


                        for (j=0; j < ready.length; j++) {
                            if (cellText === ready[j].toLowerCase()) {
                                $(this).css("background-color", "green");
                            } else if (cellText === waiting[j].toLowerCase()) {
                                $(this).css("background-color", "orange");
                            } else if (cellText === notReady[j].toLowerCase()) {
                                $(this).css("background-color", "red");
                            }
                        }
                    } else {


                        for (j=0; j < ready.length; j++) {
                            if (parseFloat(cellText) >= 0.5) {
                                $(this).css("background-color", "green");
                            } else if (parseFloat(cellText) >= 0.25) {
                                $(this).css("background-color", "orange");
                            } else {
                                $(this).css("background-color", "red");
                            }
                        }
                    }
                }
            }
        }

        if ( count === nCols -1) {
            count = 0;
        } else {
            count++;
        }

    });
}
