function sortTable(id, n) {
    var table, lines, switching, x, y, shouldSwitch, dir;
    var switchcount = 0;
    var tableId = 'tableau-' + id;
    var tabLines = [];

    table = document.getElementById(tableId);
    switching = true;

    //met le filtre en position asc
    dir = "asc";

    //cree une boucle pour changer les lignes
    while (switching) {

        console.log("je suis en : " + dir);

        switching = false;
        shouldSwitch = false;
        lines = table.getElementsByTagName("tr");

        //parcours toute les lignes sauf la première contenant les th
        if (tabLines.length === 0) {
            for (i = 1; i <= lines.length; i++) {

                //parcours le tableau et ajpute les liges visible uniquement
                if (lines[i].style.display !== "none") {
                    tabLines.push(i);
                }
            }
        }

        console.log(tabLines);
        //parcours le nouveau tableau contenant les lignes visible
        for (i=0; i < tabLines.length; i++) {


            if (tabLines.length === 0) {break}

            x = lines[tabLines[i]].getElementsByTagName("TD")[n];
            y = lines[tabLines[i++]].getElementsByTagName("TD")[n];



            //vérifie si la cellule peut devenir un entier, si oui appliquer un classement différent
            if(Number.isNaN(parseFloat(x.innerHTML)) === false) {


                //différent classement selon la position (croissant / décroissant)
                if (dir === "asc") {
                    if (parseFloat(x.innerHTML) > parseFloat(y.innerHTML)) {
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir === "desc") {
                    if (parseFloat(x.innerHTML) < parseFloat(y.innerHTML)) {
                        shouldSwitch = true;
                        break;
                    }
                }
            } else {

                //différent classement selon la position (asc ou desc)
                if (dir === "asc") {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir === "desc") {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }
        }
        if (shouldSwitch) {
            //si il faut échanger les lignes, les échanges et incrémente le compteur (permettant d'empêcher le passage à decroissant)
            lines[i].parentNode.insertBefore(lines[tabLines[i+1]], lines[tabLines[i]]);
            switching = true;
            switchcount ++;

            strippedTable(tableId);
        } else {
            //si il n'y à eu aucun échange et que la position est asc, passe en desc
            if (switchcount === 0 && dir === "asc") {
                dir = "desc";
                switching = true; //relance la boucle pour trier en decroissant
            }
        }
    }
}

//filtre le tableau à l'éxécution du bouton Rechercher
function searchString(id) {
    var tableId = "tableau-" + id;
    var searchId = "#search-" + id;
    var txtSearch = $(searchId).val().toLowerCase(); //récupére le contenu de la zone de texte
    var lines = document.getElementById(tableId).getElementsByTagName("tr");
    var nCols = lines[1].getElementsByTagName("td").length;

    //affiche toute les lignes pour pouvoir faire une nouvelle recherche
    $('#' + tableId + ' tbody tr').show().each(function() { //pour chaque ligne, récupére le contenu de la ligne
        cellText = $(this).html().toLowerCase();

        for (i=0; i< nCols ; i++) {
            cellText = cellText.replace('<td>',"").replace("</td>",""); //enlève les td pour éviter des problèmes lors de la recherche
        }

        if (cellText.includes("</th>") === true) {

        } else {
            if (cellText.includes(txtSearch) === false) { //cache la ligne si elle ne contient pas la recherche
                $(this).hide();
            }
        }

    });


    strippedTable(tableId);

}

//efface la recherche à l'éxecution du bouton clear
function clearSearch(id) {
    var tableId = "tableau-" + id;
    var searchId = "#search-" + id;
    var txtSearch = $(searchId).val();
    $('#' + tableId + ' tbody tr').show(); //affiche toutes les lignes


    if (txtSearch !== '') { //vide le contenu de la zone de texte si elle contient quelque chose
        $(searchId).val('');
    }

    strippedTable(tableId);
}


//Permet de remettre l'alternance de couleur sur le tableau
function strippedTable(id) {

    var table = document.getElementById(id);
    var count = 0;

    //parcours les lignes du tableau pour voir si la ligne actuelle est visible ou non
    for (var i = 0; i < table.rows.length; i++) {
        var line = table.rows[i];

        //si la ligne est visible on la change de couleur
        if (line.style.display !== "none") {
            if (count % 2) { //si paire, la mettre en blanc
                line.style.backgroundColor = "white";
            } else { //sinon, la mettre en orange
                line.style.backgroundColor = "#ffb74d";
            }
            count++;
        }
    }
}