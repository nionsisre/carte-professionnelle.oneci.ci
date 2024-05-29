


// imprimer_listes_factures_definitives imprimer_facture imprimer_facture_avec_remise_pdf


var numero_page;
var nb_page_etat_petit;
var page_creer;
var type_facture;
var y_text_de_fin_port=275;
var y_text_de_fin_pay=185;
var y_text_de_debut_port=70;


var doc = new jsPDF('p', 'mm', 'a4', false);


   
   ////////////////////////////////////
   //////////////////////////////////
   
   
    function imprimer_code_barre_pdf(){
		
       //alert("0000");
	     l_logo=document.getElementById("id_logo");
	   
	     var doc_code_barre= new jsPDF('P', 'mm', 'a4', false);
	 
		 var les_codes_barres=document.getElementsByClassName('les_codes_barres');
		 nb_code_barre=les_codes_barres.length;
		
		largeur_code=30;
		hauteur_code=8;
		hauteur_logo=8;
	   nouv_page=0;
	   X_de_fin=200;
	   Y_de_fin=283;
	   Y_debut=8;
	   Y_en_cours=Y_debut;
	   X_debut=6;
	   X_en_cours=X_debut;
	   nb_par_ligne=5;
	   nb_en_cours=0;
	    nouv_page=0;
	   
	  
	 for (i=0;i<nb_code_barre;i++){ 
		 
		 
		   if (Y_en_cours> Y_de_fin){
			  doc_code_barre.addPage(); 
			  nouv_page=1;
			  Y_en_cours=Y_debut; 
			  X_en_cours=X_debut;
		   }
		   
		   l_image=les_codes_barres[i];
		   
		   //alert(X_en_cours+"----"+Y_en_cours);
		   
		   doc_code_barre.addImage(l_logo, 'jpeg', X_en_cours+12,Y_en_cours, 14, hauteur_logo, undefined, 'none');
		   Y_en_cours_code=Y_en_cours+hauteur_logo;
		   doc_code_barre.addImage(l_image, 'jpeg', X_en_cours+4,Y_en_cours_code, largeur_code, hauteur_code, undefined, 'none');
			
		  X_en_cours=X_en_cours+largeur_code+10.5;
		  
		  
		 nb_en_cours++;	 
		 //if (X_en_cours>X_de_fin){
		 if (nb_en_cours==nb_par_ligne){ 
			Y_en_cours=Y_en_cours+hauteur_logo+hauteur_code+6;
			X_en_cours=X_debut;
			nb_en_cours=0;
			// alert(Y_en_cours);
		 }
		 

		 if (nouv_page==1){
		    nouv_page=0;
	     }
		
		
		
	
	 }

        var dateObj = new Date();
        var month = dateObj.getUTCMonth() + 1; //months from 1-12
        var day = dateObj.getUTCDate();
        var year = dateObj.getUTCFullYear();
        var hour = dateObj.getUTCHours();
        var min = dateObj.getUTCMinutes();

        newdate = year + "/" + month + "/" + day;

		//doc_petition.output('dataurlnewwindow');
		 doc_code_barre.save('liste_numero_bl_du_'+ day+'-'+month+'-'+year+'_'+hour+'-'+min+'.pdf');
		
		
   }
   
   
   





  
   