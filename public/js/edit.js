function edit_table(id, n, dossier, annee){

    lineText = $('#tableau-' + id + '-' + n).text();

    lineText = lineText.split("                    "); //15 espaces pour séparer chacune des données + enlever la première donnée qui est vide (15 espaces au début)
    for(i = 0; i < lineText.length; i++) {
        lineText[i].substr(0, lineText[i].length -1);
    }
    lineText.shift();
    lineText.pop();

    lineText.push(dossier);
    lineText.push(annee);


    lineText[3].split(" ").join("");
    lineText[3].split("\t").join("");
    lineText[2].split(" ").join("");
    lineText[2].split("\t").join("");

    if(!(Number.isNaN(parseFloat(lineText[5])))) {
        //lineText[5] = parseFloat(lineText[5]);

        var request = "UPDATE masterdispatching SET designation=" + lineText[2] + ", un=" + lineText[3] + ", puht=" + lineText[5] + " WHERE codemetc=" + lineText[0]
            + " AND numordre=" + lineText[1] + " AND numerodossier=" + lineText[14] + " AND annee=" + lineText[15];

        $.ajax(
            {
                url: "/js/update.php",
                type: "POST",
                async: true,
                data: {
                    'designation': lineText[2],
                    'un': lineText[3],
                    'puht': lineText[5],
                    'codemetc': + lineText[0],
                    'numordre': lineText[1],
                    'numerodossier': lineText[14],
                    'annee': lineText[15]
                },
                dataType:'html',
                success : function(code_html, statut){ // code_html contient le HTML renvoyé
                    alert("success " + code_html);
                },
                error : function(resultat, statut, erreur){
                    alert("erreur : " + erreur);
                }
            }
        );
    } else {
        alert("moyenne des prix Unitaire Hors Taxe moyen sur tous les dispatch incorrecte");
    }




}