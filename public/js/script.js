

// Function qui génère les champs

$(document).ready(function() {

    $('#dataTable').DataTable({
        /* paging: false, */ // Desactive la paginaiton
        scrollY: 280, // définit la hauteur maximale
        /* scrollX: true, */

        /* pagingType: 'full_numbers', */ // ajoute les boutons premiere page et derniere page
        ordering: false,
        lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]], // Definit le nombre d'éléments à afficher dans un champ select
        
    
    "bLengthChange": false, // masque le Show entries
    /* "bFilter": true, */
    "bInfo": false, // Desactive le nombre d'elements sur la page
    "bAutoWidth": false
    
    });


    $('#etudiant_adresse').hide();
    $('#etudiant_chambre').hide();  
    $('#addInput').click(function() {

        let nbr=0;
        $('#etudiant_typeetudiant').change(function () {
            $('#addInput').show();
            $('#etudiant_adresse').hide();
            $('#etudiant_chambre').hide();
            nbr=0;
        });

        nbr++;
        let choix = $('#etudiant_typeetudiant').val();
        if (choix === "boursiernonloge" || choix === "nonboursier") {
            $('#addInput').hide();
            $('#etudiant_adresse').show();
        }else if (choix === "boursierloge") {
            $('#addInput').hide();
            $('#etudiant_chambre').show();
        }
    });

    // Function qui génère le numéro d'une chambre

    $('#chambre_numbat').keyup(function (){
        nbrField= $('#nbrfield').val().toString().padStart(4,'0'); // toString convertit le int récupéré en chaine et padStart ajoute les zeros par exemples en avant du chiffre ( 4 signifie la chaine et 0 le chiffre à ajouter )
        numBatiment=$('#chambre_numbat').val();
        c=numBatiment.toString().padStart(3,'0');
        $('#chambre_numchambre').attr('value',`${c}-${nbrField}`)
    });

    // Function qui génère le matricule d'un etudiant

    var matricule= $('#etudiant_matricule');

    $('#etudiant_datenaissance').change(function (){
        date= $('#etudiant_datenaissance').val().split('-');
        var prenom=  $('#etudiant_prenom').val();
        var nom=  $('#etudiant_nom').val();
        matricule.attr(`value`,`${date[0]}${nom.substr(0,2).toUpperCase()}${prenom.substr((prenom.length)-2).toUpperCase()}${$('#matricule').val().toString().padStart(4,'0')}`)
        console.log(date[0]);
    });



});



