


// imprimer_listes_factures_definitives imprimer_facture imprimer_facture_avec_remise_pdf


var numero_page;
var nb_page_etat_petit;
var page_creer;
var type_facture;
var y_text_de_fin_port=275;
var y_text_de_fin_pay=217;
var y_text_de_debut_port=70;


var doc = new jsPDF('p', 'mm', 'a4', false);


function imprimer_facture(num_page){
	
       //alert(num_page+"---------");
	
	 var facture_pdf= new jsPDF('P', 'mm', 'a4', false);
	 
	 //alert("2");
	 
	 var id_image="id_entete";
	// var l_image=document.getElementById(id_image);     
	// facture_pdf.addImage(l_image, 'jpeg', 10,5, 190, 40, undefined, 'none');
	
	//alert("3");
	 les_factures=document.getElementsByClassName("div_conteneur_commande");
	 
	// alert("4");
	 
	 nb_des_pages=les_factures.length;
	 
	//alert(nb_des_pages);
	
	 if (num_page=="-1"){
		 page_de_debut=0;
		 page_de_fin=nb_des_pages;
	 }else{
	    page_de_debut=num_page;
		page_de_fin=num_page+1;	
	 }
	
     count_page=0;
  
	   //for (i=1;i<page_fin;i++){
	for (i=page_de_debut;i<page_de_fin;i++){
		 
		creer_facture_pdf(facture_pdf,i,les_factures[i],count_page);
		 count_page++;  
	 }
		
	 //facture_pdf.output('dataurlnewwindow');
	
	
	 facture_pdf.save('etat.pdf');
	 
	 
	// return facture_pdf.output();
		 
	//alert(facture_pdf.output());
	
};




 function creer_facture_pdf(doc_petition,numero_page,la_facture,count_page){
	
       //alert(count_page);
	   
	   if (count_page>0){
	     doc_petition.addPage();
	   }
		 var id_image="id_entete";
	     var l_image=document.getElementById(id_image);     
	     doc_petition.addImage(l_image, 'jpeg', 10,5, 190, 40, undefined, 'none');
		 
	  
	   
	   //alert(la_facture);
	   
	    var pageWidth = doc_petition.internal.pageSize.width;
		
		var le_tableau =la_facture.getElementsByTagName('table');
		 //alert("2222");
		
		largeur_du_titre=50;
		
		Y_debut_rect_en_cours=50;
		Y_debut_rect_en_cours=y_text_de_debut_port;
		
		
	
		// afficharge du titre
		
		x_tableau_titre=(parseInt(pageWidth)-parseInt(largeur_du_titre))/2;
	
		doc_petition.setFillColor(230,230,230);
	    doc_petition.setFontType("bold");
		hauteur_titre=7;
		/*doc_petition.rect(x_tableau_titre,Y_debut_rect_en_cours ,largeur_du_titre , hauteur_titre , 'F');
		doc_petition.setDrawColor(0,0,0);
        doc_petition.rect(x_tableau_titre,Y_debut_rect_en_cours, largeur_du_titre, hauteur_titre , 'FD');*/
		
		var la_zone_titre=la_facture.getElementsByTagName('span');
		
	
		le_titre=la_zone_titre[0].innerHTML;
		
		 doc_petition.setFontSize(10);
				   // deterniner fontsize
				   la_taille_police= 10;
				   le_texte=le_titre;
				  
				    txtWidth = doc_petition.getStringUnitWidth(le_texte)*la_taille_police/doc_petition.internal.scaleFactor;
				 
				   while(txtWidth>largeur_du_titre-2){
				     la_taille_police=la_taille_police-0.2;
				     txtWidth = doc_petition.getStringUnitWidth(le_texte)*la_taille_police/doc_petition.internal.scaleFactor;	 
			      }
				  
				  doc_petition.setFontSize(la_taille_police);
				  txtWidth = doc_petition.getStringUnitWidth(le_texte)*la_taille_police/doc_petition.internal.scaleFactor;
				  marge=(largeur_du_titre-txtWidth)/2;
				

			//doc_petition.text(x_tableau_titre+marge,Y_debut_rect_en_cours+5, le_texte);
			
		//Y_debut_rect_en_cours=Y_debut_rect_en_cours+13;
		
		
		
		var les_lignes=le_tableau[0].getElementsByTagName('tr');
		
		
		x_text_debut=40;
		x_text=x_text_debut;
		
		/*les_td=les_lignes[0].getElementsByTagName('td');
		le_texte=les_td[0].innerHTML;
		doc_petition.text(x_text,Y_debut_rect_en_cours, le_texte);
		le_texte=les_td[1].innerHTML;
		x_text=x_text+10;
		doc_petition.text(x_text,Y_debut_rect_en_cours, le_texte);
		
		le_texte=les_td[2].innerHTML;
		x_text=x_text+30;
		doc_petition.text(x_text,Y_debut_rect_en_cours, le_texte);
		
		le_texte=les_td[3].innerHTML;
		x_text=x_text+10;
		doc_petition.text(x_text,Y_debut_rect_en_cours, le_texte);
		
		
		le_texte=les_td[4].innerHTML;
		x_text=x_text+30;
		doc_petition.text(x_text,Y_debut_rect_en_cours, le_texte);
		
		le_texte=les_td[5].innerHTML;
		x_text=x_text+25;
		doc_petition.text(x_text,Y_debut_rect_en_cours, le_texte);
		
	
		Y_debut_rect_en_cours=Y_debut_rect_en_cours+5;
		x_text=x_text_debut;
		les_td=les_lignes[1].getElementsByTagName('td');
		le_texte=les_td[0].innerHTML;
		
		doc_petition.text(x_text,Y_debut_rect_en_cours, le_texte);
		
		le_texte=les_td[1].innerHTML;
		x_text=x_text+15;
		doc_petition.text(x_text,Y_debut_rect_en_cours, le_texte);*/
		
		
		les_td=les_lignes[0].getElementsByTagName('td');
		le_texte=les_td[0].innerHTML;
		doc_petition.text(x_text,Y_debut_rect_en_cours, le_texte);
		
		le_texte=les_td[1].innerHTML;
		x_text=x_text+40;
		doc_petition.text(x_text,Y_debut_rect_en_cours, le_texte);
		
		le_texte=les_td[2].innerHTML;
		x_text=x_text+50;
		doc_petition.text(x_text,Y_debut_rect_en_cours, le_texte);
		
		
		Y_debut_rect_en_cours=Y_debut_rect_en_cours+5;
		x_text=x_text_debut;
		les_td=les_lignes[1].getElementsByTagName('td');
		le_texte=les_td[0].innerHTML;
		
		doc_petition.text(x_text,Y_debut_rect_en_cours, le_texte);
		
		///////
		Y_debut_rect_en_cours=Y_debut_rect_en_cours+5;
		x_text=x_text_debut;
		les_td=les_lignes[2].getElementsByTagName('td');
		le_texte=les_td[0].innerHTML;
		doc_petition.text(x_text,Y_debut_rect_en_cours, le_texte);
		
		
		///////
		Y_debut_rect_en_cours=Y_debut_rect_en_cours+5;
		x_text=x_text_debut;
		les_td=les_lignes[3].getElementsByTagName('td');
		le_texte=les_td[0].innerHTML;
		doc_petition.text(x_text,Y_debut_rect_en_cours, le_texte);
		
		
		
		
		Y_debut_rect_en_cours=Y_debut_rect_en_cours+7;
		
		var les_lignes=le_tableau[1].getElementsByTagName('tr');
		
		
		nb_lignes= les_lignes.length;
		
		//alert("---"+nb_lignes);
		
		largeur_espace_travail=210;
		
		largeur_colonne=25;
		largeur_colonne1=7;
		largeur_colonne2=20;
		largeur_colonne3=70;
		
		hauteur_ligne=7;
		
		largeur_tableau=largeur_colonne1+largeur_colonne2+largeur_colonne3+(largeur_colonne*3);
		
		
	     //alert("9999999")
	
	
		X_debut_rect=(parseInt(pageWidth)-parseInt(largeur_tableau))/2;
		
		//alert("77777");
		
		X_debut_rect=parseInt(X_debut_rect);
		// Recheche nombre lignes entete
		
		/* var specialElementHandlers = {
                '#elementHandle': function (element, renderer) {
                    return true;
                }
            };

		*/
		
		//alert("22");
		
		// Affichage du reste tableau
	  doc_petition.setFontType("");
	  
	  //alert("444");
	 // Y_debut_rect_en_cours=parseInt(Y_debut_rect_en_cours)+parseInt(hauteur_ligne_entete);
	  //Y_debut_rect_en_cours=Y_debut_rect_en_cours+hauteur_ligne;
	 
	// alert("33");
	
	 tableau_caractere = new Array();
	 tableau_caractere.push("<b>");		
	 tableau_caractere.push("</b>");	
	 nb_caractere=tableau_caractere.length;
			 	
	  ligne_debut=0;

	  la_couleur=0;
	  
	nouv_page=0;
	  
	 for (p=ligne_debut;p<nb_lignes;p++){ 
		 
		 
		   if (Y_debut_rect_en_cours> y_text_de_fin_port){
			  doc_petition.addPage(); 
			  nouv_page=1;
			  Y_debut_rect_en_cours=10;
			  ligne_en_cours_sauv=p-1; 
			  p=ligne_debut; 
		   }


		    if (la_couleur==0){
			   la_couleur=1;
			}else{
			   la_couleur=0;
		    }
		  
		   nb_colonnes_ligne_en_cours=les_lignes[p].cells.length;
		 //  alert(nb_colonnes_ligne_en_cours);
		  /*if (nb_colonnes_ligne_en_cours==1){
			  
			  doc_petition.addPage();
		      X_debut_rect=5;
		      Y_debut_rect=10;
			  Y_debut_rect_en_cours=Y_debut_rect;
			  X_debut_rect_en_cours=X_debut_rect;
			  if (la_couleur==0){
			     la_couleur=1;
			  }else{
			    la_couleur=0;
		      }
			    
		  }else{*/
		  
		  //alert("888");
			  
		   X_debut_rect_en_cours=X_debut_rect;
		   
		   if (p>=nb_lignes-4){
			  X_debut_rect_en_cours=X_debut_rect+largeur_colonne1+largeur_colonne2+largeur_colonne3+(largeur_colonne*2);
		   }
		   
		   point_debut=1;
		    if (p==nb_lignes-1){ 
			   largeur_colonne_en_cours=largeur_tableau;
			   point_debut=0;
		    }
			
			 
		// parcour des cellules	     		  
		 for (q=point_debut;q<nb_colonnes_ligne_en_cours;q++){
		 
			if (la_couleur==0){
			   doc_petition.setFillColor(255,255,255);
			}else{
			   //doc_petition.setFillColor(255,250,100);
			   doc_petition.setFillColor(255,255,255);
			   
		    }
			
			if (p==0){
			   doc_petition.setFillColor(230,230,230);
			   doc_petition.setFontType("bold");
			}else{
			   doc_petition.setFontType("");   
			}
		   
		    /*if (p==(nb_lignes-1)){
			   doc_petition.setFillColor(230,230,230);
			   doc_petition.setFontType("bold");	
			}*/
			
			largeur_colonne_en_cours=largeur_colonne;
			
			 switch (q) {
 
			    case 1:
                  largeur_colonne_en_cours=largeur_colonne1;
                break;
                case 2:
                 largeur_colonne_en_cours=largeur_colonne2;	  
                break;
				case 3:
                 largeur_colonne_en_cours=largeur_colonne3;	  
                break;
               
			 }
			 
			  if (p>=nb_lignes-4){
			     largeur_colonne_en_cours=largeur_colonne;
				  doc_petition.setFontType("bold");
		      }
			  
			  if (p==nb_lignes-1){ 
		         largeur_colonne_en_cours=largeur_tableau;
		      }
			 
			 //alert(largeur_colonne_en_cours);
			 
			 
			 //alert(" X: "+X_debut_rect_en_cours+"Y: "+Y_debut_rect_en_cours+"L: "+largeur_colonne_en_cours+" H : "+hauteur_ligne);
			 
			 //alert(" X: "+X_debut_rect_en_cours+"Y: "+Y_debut_rect_en_cours);
			if (p!=nb_lignes-1){ 
		      doc_petition.rect(X_debut_rect_en_cours,  Y_debut_rect_en_cours,largeur_colonne_en_cours , hauteur_ligne , 'F');
			  // alert("6666");
		      doc_petition.setDrawColor(0,0,0);
              doc_petition.rect(X_debut_rect_en_cours,  Y_debut_rect_en_cours, largeur_colonne_en_cours,hauteur_ligne , 'FD');
			}
			// alert("7777");
			// recuperation valeur
			valeur_cellule=les_lignes[p].cells[q].innerHTML;
	        for(var numc = 0 ; numc < nb_caractere ; numc++){
		       reg=new RegExp(tableau_caractere[numc], 'g')
		       valeur_cellule=valeur_cellule.replace(reg,""); 
	        }
			
			// alert("8888");
			
			//doc_petition.setFontSize(8);
			X_debut_text_en_cours=X_debut_rect_en_cours;
			Y_debut_text_en_cours=Y_debut_rect_en_cours+4.5;
   
			  if (p==nb_lignes-1){
			      doc_petition.setFontSize(11);
				  la_taille_police= 11;
			   }else{
			      doc_petition.setFontSize(9);
				  la_taille_police= 9;	
			   }
				   
				   
				   
				   
				   
				   le_texte=valeur_cellule;
				    txtWidth = doc_petition.getStringUnitWidth(le_texte)*la_taille_police/doc_petition.internal.scaleFactor;
				  //alert(txtWidth);
				  
				   while(txtWidth>largeur_colonne_en_cours-2){
				     la_taille_police=la_taille_police-0.2;
				     txtWidth = doc_petition.getStringUnitWidth(le_texte)*la_taille_police/doc_petition.internal.scaleFactor;	 
			      }
				  
				  doc_petition.setFontSize(la_taille_police);
				  txtWidth = doc_petition.getStringUnitWidth(le_texte)*la_taille_police/doc_petition.internal.scaleFactor;
				  marge=(largeur_colonne_en_cours-txtWidth)/2;

               if (p==nb_lignes-1){
			      doc_petition.text(X_debut_rect, Y_debut_text_en_cours+5, valeur_cellule);
			   }else{
			      doc_petition.text(X_debut_text_en_cours+marge, Y_debut_text_en_cours, valeur_cellule);	
			   }
			
			  if (p>=nb_lignes-4){
			      if (p!=nb_lignes-1){
				     valeur_cellule=les_lignes[p].cells[0].innerHTML;
				     le_texte=valeur_cellule;
				     txtWidth = doc_petition.getStringUnitWidth(le_texte)*la_taille_police/doc_petition.internal.scaleFactor;
				     marge1=X_debut_text_en_cours-txtWidth;
				     doc_petition.text(marge1-2, Y_debut_text_en_cours, valeur_cellule);
				  }
		      }
			
		     X_debut_rect_en_cours=X_debut_rect_en_cours+largeur_colonne_en_cours;
		 }
		 
		 Y_debut_rect_en_cours=Y_debut_rect_en_cours+hauteur_ligne;
		 
		 doc_petition.setFontSize(8);
		 la_taille_police= 8;	  
			 
	        if ((p==0) &(nouv_page==1)){
				//return;
			    p=ligne_en_cours_sauv;
			    nouv_page=0;
			}

	
	
	
   }
		  
		   X_debut_rect_en_cours=X_debut_rect;
		   doc_petition.setFontSize(8);
		   la_taille_police= 8;
		  
			
	 //}
		

		//doc_petition.output('dataurlnewwindow');
		
		
		
		
   }
   
   
   
   function creer_liste_facture_pdf(){
	
	
	
	//alert("1");
	
	
	 var doc_petition= new jsPDF('P', 'mm', 'a4', false);
	 
	    var id_image="id_entete";
	   var l_image=document.getElementById(id_image);     
	  doc_petition.addImage(l_image, 'jpeg', 10,5, 190, 40, undefined, 'none');
	 
	//alert("2");
		
		 les_factures=document.getElementsByClassName("div_conteneur_commande");
		 
	//	 alert("3");
	     nb_des_pages=les_factures.length;
		 
		 la_facture=les_factures[nb_des_pages-1];
		
		//var le_tableau =la_facture.getElementByClassName("tableau_liste_eleve");
		var le_tableau =la_facture.getElementsByTagName('table');
		
	//	alert("4");
		//alert(le_tableau.length);
		
		var les_lignes=le_tableau[0].getElementsByTagName('tr');
		
		//alert("2");
		
		nb_lignes= les_lignes.length;
		
		//alert("---"+nb_lignes);
		
		 var pageWidth = doc_petition.internal.pageSize.width;
		
		
		// alert("5");
		
		largeur_espace_travail=210;
		
		largeur_colonne1=7;
		largeur_colonne2=20;
		largeur_colonne3=50;
		largeur_colonne4=25;
		
		hauteur_ligne=7;
		
		largeur_tableau=largeur_colonne1+(largeur_colonne2*3)+largeur_colonne3+(largeur_colonne4*3);
		
		
	    // alert("6");
	
	
		X_debut_rect=(parseInt(pageWidth)-parseInt(largeur_tableau))/2;
		
		//alert("77777");
		
		X_debut_rect=parseInt(X_debut_rect);
		// Recheche nombre lignes entete
		
		/* var specialElementHandlers = {
                '#elementHandle': function (element, renderer) {
                    return true;
                }
            };

		*/
		
		//alert("22");
		
		// Affichage du reste tableau
	  doc_petition.setFontType("");
	  
	  //alert("444");
	 // Y_debut_rect_en_cours=parseInt(Y_debut_rect_en_cours)+parseInt(hauteur_ligne_entete);
	  //Y_debut_rect_en_cours=Y_debut_rect_en_cours+hauteur_ligne;
	 
	// alert("33");
	  
	  la_couleur=1;
	  
	  ligne_debut=0;
	  
	  Y_debut_rect_en_cours=50;
	  
	  la_couleur=0;
	  
	 for (p=ligne_debut;p<nb_lignes;p++){
		 
		 
		// alert("7");

		    if (la_couleur==0){
			   la_couleur=1;
			}else{
			   la_couleur=0;
		    }
		  
		   nb_colonnes_ligne_en_cours=les_lignes[p].cells.length;
		 //  alert(nb_colonnes_ligne_en_cours);
		  /*if (nb_colonnes_ligne_en_cours==1){
			  
			  doc_petition.addPage();
		      X_debut_rect=5;
		      Y_debut_rect=10;
			  Y_debut_rect_en_cours=Y_debut_rect;
			  X_debut_rect_en_cours=X_debut_rect;
			  if (la_couleur==0){
			     la_couleur=1;
			  }else{
			    la_couleur=0;
		      }
			    
		  }else{*/
		  
		  //alert("7");
			  
		   X_debut_rect_en_cours=X_debut_rect;
		   
		   if (p>=nb_lignes-1){
			  X_debut_rect_en_cours=X_debut_rect+largeur_colonne1+(largeur_colonne2*2)+largeur_colonne3;
			  nb_colonnes_ligne_en_cours=4;
			  colonne_debut=1;
		   }else{
			  colonne_debut=0;   
		   }
		   
		// parcour des cellules	     		  
		 for (q=colonne_debut;q<nb_colonnes_ligne_en_cours;q++){
		 
			if (la_couleur==0){
			   doc_petition.setFillColor(255,255,255);
			}else{
			   doc_petition.setFillColor(255,250,100);
			   //doc_petition.setFillColor(255,255,255);
		    }
			
			if (p==0){
			   doc_petition.setFillColor(230,230,230);
			   doc_petition.setFontType("bold");
			}else{
			   doc_petition.setFontType("");   
			}
		   
		    /*if (p==(nb_lignes-1)){
			   doc_petition.setFillColor(230,230,230);
			   doc_petition.setFontType("bold");	
			}*/
			
			//largeur_colonne_en_cours=largeur_colonne;

			 switch (q) {
                
				case 0:
                  largeur_colonne_en_cours=largeur_colonne1;
                break;
			    case 1:
                  largeur_colonne_en_cours=largeur_colonne2;
                break;
                case 2:
                 largeur_colonne_en_cours=largeur_colonne2;	  
                break;
				case 3:
                 largeur_colonne_en_cours=largeur_colonne3;	  
                break;
				case 4:
                 largeur_colonne_en_cours=largeur_colonne4;	  
                break;
				case 5:
                 largeur_colonne_en_cours=largeur_colonne4;	  
                break;
				case 6:
                 largeur_colonne_en_cours=largeur_colonne4;	  
                break;
				case 7:
                 largeur_colonne_en_cours=largeur_colonne2;	  
                break;
				
               
			 }
			 
			  if (p>=nb_lignes-1){
			     largeur_colonne_en_cours=largeur_colonne4;
				  doc_petition.setFontType("bold");
		      }
			 
			 //alert(largeur_colonne_en_cours);
			 
			 //alert(" X: "+X_debut_rect_en_cours+"Y: "+Y_debut_rect_en_cours+"L: "+largeur_colonne_en_cours+" H : "+hauteur_ligne);
			 
			 //alert(" X: "+X_debut_rect_en_cours+"Y: "+Y_debut_rect_en_cours);
			 
		    doc_petition.rect(X_debut_rect_en_cours,  Y_debut_rect_en_cours,largeur_colonne_en_cours , hauteur_ligne , 'F');
			// alert("6666");
		    doc_petition.setDrawColor(0,0,0);
            doc_petition.rect(X_debut_rect_en_cours,  Y_debut_rect_en_cours, largeur_colonne_en_cours,hauteur_ligne , 'FD');
			// alert("7777");
			// recuperation valeur
			valeur_cellule=les_lignes[p].cells[q].innerHTML;
			
			// alert("8888");
			
			//doc_petition.setFontSize(8);
			X_debut_text_en_cours=X_debut_rect_en_cours;
			Y_debut_text_en_cours=Y_debut_rect_en_cours+4.5;
			
			
			      doc_petition.setFontSize(9);
				   // deterniner fontsize
				   la_taille_police= 9;
				   le_texte=valeur_cellule;
				    txtWidth = doc_petition.getStringUnitWidth(le_texte)*la_taille_police/doc_petition.internal.scaleFactor;
				  //alert(txtWidth);
				  
				   while(txtWidth>largeur_colonne_en_cours-2){
				     la_taille_police=la_taille_police-0.2;
				     txtWidth = doc_petition.getStringUnitWidth(le_texte)*la_taille_police/doc_petition.internal.scaleFactor;	 
			      }
				  
				  doc_petition.setFontSize(la_taille_police);
				  txtWidth = doc_petition.getStringUnitWidth(le_texte)*la_taille_police/doc_petition.internal.scaleFactor;
				  marge=(largeur_colonne_en_cours-txtWidth)/2;
				 

			doc_petition.text(X_debut_text_en_cours+marge, Y_debut_text_en_cours, valeur_cellule);
			
		     X_debut_rect_en_cours=X_debut_rect_en_cours+largeur_colonne_en_cours;
		 }
		 
		 Y_debut_rect_en_cours=Y_debut_rect_en_cours+hauteur_ligne;
		 
		 doc_petition.setFontSize(8);
		 la_taille_police= 8;	  
			 
	
		  }
		  
		   X_debut_rect_en_cours=X_debut_rect;
		   doc_petition.setFontSize(8);
		   la_taille_police= 8;
		  
			
	 //}
		

		 //doc_petition.output('dataurlnewwindow');
	    doc_petition.save('etat.pdf');
	   // doc_petition.output();
	
		
		
		
		
   }
   
   
  function imprimer_listes_factures_definitives(){
	
	//alert("1");
	
	 var facture_pdf= new jsPDF('l', 'mm', 'a4', false);
	  var id_image="id_entete";
	  var l_image=document.getElementById(id_image);     
	 facture_pdf.addImage(l_image, 'jpeg', 50,5, 200, 40, undefined, 'none');
	
	 les_factures=document.getElementsByClassName("clas_liste_factures");
	 
	// alert("2");
	 
	 nb_des_pages=les_factures.length;
	 
	 //alert("nb"+nb_des_pages);
	
	
		 page_de_debut=0;
		 page_de_fin=nb_des_pages;
	

	   //for (i=1;i<page_fin;i++){
		   
		   
		   
	// alert(type_facture);	
	//type_facture="1";   
		   
	for (i=page_de_debut;i<page_de_fin;i++){
		
		 switch (type_facture){
		   
		   case "1":
		   //  alert("1");
		      creer_liste_etat_facture_pdf(facture_pdf,i,les_factures[i]);
		   break;
		   
		   case "2":
		    //  alert("2");
		      creer_liste_etat_facture_pdf(facture_pdf,i,les_factures[i]);
		   break;
		   
		   case "3":
		      //alert("3");
		         creer_liste_etat_facture_pdf(facture_pdf,i,les_factures[i]);
		   break;
		   
		   case "4":
		     // alert("4");
		      creer_liste_facture_def_pdf(facture_pdf,i,les_factures[i]);
			  
			  
		   break;	 
			 
			 
			 
		 }
	 
		
		
		
		  
	 }
		
	 //facture_pdf.output('dataurlnewwindow');
	
	
	 facture_pdf.save('etat.pdf');
	 
	 
	// return facture_pdf.output();
		 
	//alert(facture_pdf.output());
	
};
   
   
   
   
   
   
   
   function creer_liste_facture_def_pdf(doc_petition,numero_page,la_facture){
	
	
	
	//alert("----1");
	
	
	 //var doc_petition= new jsPDF('l', 'mm', 'a4', false);
	 
	//alert("2");
	

	
	    /* var id_image="id_entete";
		 var l_image=document.getElementById(id_image);     
	     doc_petition.addImage(l_image, 'jpeg', 50,5, 200, 40, undefined, 'none');*/
	
		
		 if (numero_page>0){
			 
	        doc_petition.addPage();
		    var id_image="id_entete";
	        var l_image=document.getElementById(id_image);     
	        doc_petition.addImage(l_image, 'jpeg', 50,5, 200, 40, undefined, 'none');
			
	    }
		
		
		
		// les_factures=document.getElementsByClassName("clas_liste_factures");
		 
		// alert("---3");
	   //  nb_des_pages=les_factures.length;
		 
		// la_facture=les_factures[nb_des_pages-1];
		
		
		
		//alert(la_facture);
		//var le_tableau =la_facture.getElementByClassName("tableau_liste_eleve");
		var le_tableau =la_facture.getElementsByTagName('table');
		
		//alert("----4");
		//alert(le_tableau.length);
		
		var les_lignes=le_tableau[0].getElementsByTagName('tr');
		
		//alert("555555");
		
		nb_lignes= les_lignes.length;
		
		//alert("---"+nb_lignes);
		
		 var pageWidth = doc_petition.internal.pageSize.width;
		
		
	   //alert("---- 5");
		
		
		largeur_espace_travail=210;
		
			
		
		largeur_colonne1=7;
		largeur_colonne2=25;
		largeur_colonne3=60;
		largeur_colonne4=25;
		
		hauteur_ligne=7;
		
		largeur_tableau=largeur_colonne1+(largeur_colonne2*2)+largeur_colonne3+(largeur_colonne4*6);
		
		
	    // alert("6");
	
	
		X_debut_rect=(parseInt(pageWidth)-parseInt(largeur_tableau))/2;
		
		//alert("77777");
		
		X_debut_rect=parseInt(X_debut_rect);
		// Recheche nombre lignes entete
		
		/* var specialElementHandlers = {
                '#elementHandle': function (element, renderer) {
                    return true;
                }
            };

		*/
		
		//alert("22");
		
		// Affichage du reste tableau
	  doc_petition.setFontType("");
	  
	  //alert("444");
	 // Y_debut_rect_en_cours=parseInt(Y_debut_rect_en_cours)+parseInt(hauteur_ligne_entete);
	  //Y_debut_rect_en_cours=Y_debut_rect_en_cours+hauteur_ligne;
	 
	// alert("33");
	  
	  la_couleur=1;
	  
	  ligne_debut=0;
	  
	  Y_debut_rect_en_cours=50;
	  
	  la_couleur=0;
	  
	 for (p=ligne_debut;p<nb_lignes;p++){
		 
		 
		// alert("7");

		    if (la_couleur==0){
			   la_couleur=1;
			}else{
			   la_couleur=0;
		    }
		  
		   nb_colonnes_ligne_en_cours=les_lignes[p].cells.length;
		 //  alert(nb_colonnes_ligne_en_cours);
		  /*if (nb_colonnes_ligne_en_cours==1){
			  
			  doc_petition.addPage();
		      X_debut_rect=5;
		      Y_debut_rect=10;
			  Y_debut_rect_en_cours=Y_debut_rect;
			  X_debut_rect_en_cours=X_debut_rect;
			  if (la_couleur==0){
			     la_couleur=1;
			  }else{
			    la_couleur=0;
		      }
			    
		  }else{*/
		  
		  //alert("7");
			  
		   X_debut_rect_en_cours=X_debut_rect;
		   
		   if (p>=nb_lignes-1){
			  X_debut_rect_en_cours=X_debut_rect+largeur_colonne1+(largeur_colonne2*2)+largeur_colonne3;
			  nb_colonnes_ligne_en_cours=6;
			  colonne_debut=1;
		   }else{
			  colonne_debut=0;   
		   }
		   
		// parcour des cellules	     		  
		 for (q=colonne_debut;q<nb_colonnes_ligne_en_cours;q++){
		 
			if (la_couleur==0){
			   doc_petition.setFillColor(255,255,255);
			}else{
			   doc_petition.setFillColor(255,250,100);
			   //doc_petition.setFillColor(255,255,255);
		    }
			
			if ((p==0)||(p==1)||(p==nb_lignes-1)){
			   doc_petition.setFillColor(230,230,230);
			   doc_petition.setFontType("bold");
			}else{
			   doc_petition.setFontType("");   
			}
		   
		    /*if (p==(nb_lignes-1)){
			   doc_petition.setFillColor(230,230,230);
			   doc_petition.setFontType("bold");	
			}*/
			
			//largeur_colonne_en_cours=largeur_colonne;

			 switch (q) {
                
				case 0:
                  largeur_colonne_en_cours=largeur_colonne1;
                break;
			    case 1:
                  largeur_colonne_en_cours=largeur_colonne2;
                break;
                case 2:
                 largeur_colonne_en_cours=largeur_colonne2;	  
                break;
				case 3:
                 largeur_colonne_en_cours=largeur_colonne3;	  
                break;
				case 4:
                 largeur_colonne_en_cours=largeur_colonne4;	  
                break;
				case 5:
                 largeur_colonne_en_cours=largeur_colonne4;	  
                break;
				case 6:
                 largeur_colonne_en_cours=largeur_colonne4;	  
                break;
				case 7:
                 largeur_colonne_en_cours=largeur_colonne4;	  
                break;
				case 8:
                 largeur_colonne_en_cours=largeur_colonne4;	  
                break;
				
               
			 }
			 
			  if (p>=nb_lignes-1){
			     largeur_colonne_en_cours=largeur_colonne4;
				  doc_petition.setFontType("bold");
		      }
			 
			  if (p==0){
			     largeur_colonne_en_cours=largeur_tableau;
			  }
			 
		    doc_petition.rect(X_debut_rect_en_cours,  Y_debut_rect_en_cours,largeur_colonne_en_cours , hauteur_ligne , 'F');
			// alert("6666");
		    doc_petition.setDrawColor(0,0,0);
            doc_petition.rect(X_debut_rect_en_cours,  Y_debut_rect_en_cours, largeur_colonne_en_cours,hauteur_ligne , 'FD');
			// alert("7777");
			// recuperation valeur
			valeur_cellule=les_lignes[p].cells[q].innerHTML;
			
			// alert("8888");
			
			//doc_petition.setFontSize(8);
			X_debut_text_en_cours=X_debut_rect_en_cours;
			Y_debut_text_en_cours=Y_debut_rect_en_cours+4.5;
			
			
			      doc_petition.setFontSize(9);
				   // deterniner fontsize
				   la_taille_police= 9;
				   le_texte=valeur_cellule;
				    txtWidth = doc_petition.getStringUnitWidth(le_texte)*la_taille_police/doc_petition.internal.scaleFactor;
				  //alert(txtWidth);
				  
				   while(txtWidth>largeur_colonne_en_cours-2){
				     la_taille_police=la_taille_police-0.2;
				     txtWidth = doc_petition.getStringUnitWidth(le_texte)*la_taille_police/doc_petition.internal.scaleFactor;	 
			      }
				  
				  doc_petition.setFontSize(la_taille_police);
				  txtWidth = doc_petition.getStringUnitWidth(le_texte)*la_taille_police/doc_petition.internal.scaleFactor;
				  marge=(largeur_colonne_en_cours-txtWidth)/2;
				 

			doc_petition.text(X_debut_text_en_cours+marge, Y_debut_text_en_cours, valeur_cellule);
			
		     X_debut_rect_en_cours=X_debut_rect_en_cours+largeur_colonne_en_cours;
		 }
		 
		 Y_debut_rect_en_cours=Y_debut_rect_en_cours+hauteur_ligne;
		 
		 doc_petition.setFontSize(8);
		 la_taille_police= 8;	  
			 
	
		  }
		  
		   X_debut_rect_en_cours=X_debut_rect;
		   doc_petition.setFontSize(8);
		   la_taille_police= 8;
		  
			
	 //}
		

		// doc_petition.output('dataurlnewwindow');
	    //doc_petition.save('etat.pdf');
	   // doc_petition.output();
	
		
		
		
		
   }
   
   
  
  
  
  function creer_stock_pdf(le_stock){
	
	
	
	//alert("1");
	
	//largeur_espace_travail=210;
		largeur_colonne0=7;
		largeur_colonne1=50;
		largeur_colonne2=20;
		largeur_colonne3=20;
		largeur_colonne4=25;
		largeur_colonne5=30;
		
		hauteur_ligne=7;
		
		//largeur_tableau=largeur_colonne0+largeur_colonne1+(largeur_colonne2*4)+(largeur_colonne5*5);
		
	
	 if (le_stock==0){
	    var doc_petition= new jsPDF('l', 'mm', 'a4', false);
		largeur_tableau=largeur_colonne0+largeur_colonne1+(largeur_colonne2*4)+(largeur_colonne4*5);
		
		 var id_image="id_entete";
		 var l_image=document.getElementById(id_image);     
	     doc_petition.addImage(l_image, 'jpeg', 50,5, 200, 40, undefined, 'none');
		
	 }else{
		var doc_petition= new jsPDF('p', 'mm', 'a4', false);
		largeur_tableau=largeur_colonne0+largeur_colonne1+(largeur_colonne4*5);	
		
		 var id_image="id_entete";
	   var l_image=document.getElementById(id_image);     
	  doc_petition.addImage(l_image, 'jpeg', 10,5, 190, 40, undefined, 'none');
		
	 }
		 
    //alert("2");
	
		 les_factures=document.getElementsByClassName("div_conteneur_commande");
		 
	//	 alert("3");
	     nb_des_pages=les_factures.length;
		 
		if (le_stock==0){
		  la_facture=document.getElementById("div_page_etat_1");
		}else{
		  la_facture=document.getElementById("div_page_etat_2"); 	
		}
		
		//var le_tableau =la_facture.getElementByClassName("tableau_liste_eleve");
		var le_tableau =la_facture.getElementsByTagName('table');
		
		//alert("4");
		//alert(le_tableau.length);
		
		var les_lignes=le_tableau[0].getElementsByTagName('tr');
		
		//alert("2");
		
		nb_lignes= les_lignes.length;
		
		//alert("---"+nb_lignes);
		
		 var pageWidth = doc_petition.internal.pageSize.width;
		
		
	
		X_debut_rect=(parseInt(pageWidth)-parseInt(largeur_tableau))/2;
		
		//alert("77777");
		
		X_debut_rect=parseInt(X_debut_rect);
		// Recheche nombre lignes entete
		
		/* var specialElementHandlers = {
                '#elementHandle': function (element, renderer) {
                    return true;
                }
            };

		*/
		
		//alert("22");
		
		// Affichage du reste tableau
	  doc_petition.setFontType("");
	  
	  //alert("444");
	 // Y_debut_rect_en_cours=parseInt(Y_debut_rect_en_cours)+parseInt(hauteur_ligne_entete);
	  //Y_debut_rect_en_cours=Y_debut_rect_en_cours+hauteur_ligne;
	 
	// alert("33");
	  
	  la_couleur=1;
	  
	  ligne_debut=0;
	  
	  Y_debut_rect_en_cours=50;
	  
	  la_couleur=0;
	  
	 for (p=ligne_debut;p<nb_lignes;p++){
		 
		 
		// alert("7");

		    if (la_couleur==0){
			   la_couleur=1;
			}else{
			   la_couleur=0;
		    }
		  
		   nb_colonnes_ligne_en_cours=les_lignes[p].cells.length;
		 //  alert(nb_colonnes_ligne_en_cours);
		  /*if (nb_colonnes_ligne_en_cours==1){
			  
			  doc_petition.addPage();
		      X_debut_rect=5;
		      Y_debut_rect=10;
			  Y_debut_rect_en_cours=Y_debut_rect;
			  X_debut_rect_en_cours=X_debut_rect;
			  if (la_couleur==0){
			     la_couleur=1;
			  }else{
			    la_couleur=0;
		      }
			    
		  }else{*/
		  
		  //alert("7");
			  
		   X_debut_rect_en_cours=X_debut_rect;
		   
		  /* if (p>=nb_lignes-1){
			  X_debut_rect_en_cours=X_debut_rect+largeur_colonne1+(largeur_colonne2*2)+largeur_colonne3;
			  nb_colonnes_ligne_en_cours=6;
			  colonne_debut=1;
		   }else{*/
			  colonne_debut=0;   
		   /*}*/
		   
		// parcour des cellules	     		  
		 for (q=colonne_debut;q<nb_colonnes_ligne_en_cours;q++){
		 
			
			
			if (p==1){
			   doc_petition.setFillColor(230,230,230);
			   doc_petition.setFontType("bold");
			}else{
			   doc_petition.setFontType("");  
			   if (la_couleur==0){
			      doc_petition.setFillColor(255,255,255);
			   }else{
			     doc_petition.setFillColor(255,250,100);
			   //doc_petition.setFillColor(255,255,255);
		       } 
			}
			
			if (p==0){
			   doc_petition.setFillColor(255,255,255);
			   doc_petition.setFontType("bold");
			}
		   
		    /*if (p==(nb_lignes-1)){
			   doc_petition.setFillColor(230,230,230);
			   doc_petition.setFontType("bold");	
			}*/
			
			//largeur_colonne_en_cours=largeur_colonne;
			
		if (le_stock==0){
		  
		  largeur_colonne_en_cours=largeur_colonne4;
		  
		   switch (q) {
			   
                
				case 0:
                  largeur_colonne_en_cours=largeur_colonne0;
                break;
			    case 1:
                  largeur_colonne_en_cours=largeur_colonne1;
                break;
                case 2:
                 largeur_colonne_en_cours=largeur_colonne2;	  
                break;
				case 3:
                 largeur_colonne_en_cours=largeur_colonne2;	  
                break;
				case 4:
                 largeur_colonne_en_cours=largeur_colonne2;	  
                break;
				case 5:
                 largeur_colonne_en_cours=largeur_colonne2;	  
                break;
				
               
			 }		
		
		}else{
			
		  largeur_colonne_en_cours=largeur_colonne4;
		  
		   switch (q) {
                
				case 0:
                  largeur_colonne_en_cours=largeur_colonne0;
                break;
			    case 1:
                  largeur_colonne_en_cours=largeur_colonne1;
                break;
                
			 }
			 			
		}
			
			
			
			  if (p==0){
			     largeur_colonne_en_cours=largeur_tableau;
			  }

			
			 
		    doc_petition.rect(X_debut_rect_en_cours,  Y_debut_rect_en_cours,largeur_colonne_en_cours , hauteur_ligne , 'F');
			// alert("6666");
		    doc_petition.setDrawColor(0,0,0);
            doc_petition.rect(X_debut_rect_en_cours,  Y_debut_rect_en_cours, largeur_colonne_en_cours,hauteur_ligne , 'FD');
			// alert("7777");
			// recuperation valeur
			valeur_cellule=les_lignes[p].cells[q].innerHTML;
			
			// alert("8888");
			
			//doc_petition.setFontSize(8);
			X_debut_text_en_cours=X_debut_rect_en_cours;
			Y_debut_text_en_cours=Y_debut_rect_en_cours+4.5;
			
			
			      doc_petition.setFontSize(9);
				   // deterniner fontsize
				   la_taille_police= 9;
				   le_texte=valeur_cellule;
				    txtWidth = doc_petition.getStringUnitWidth(le_texte)*la_taille_police/doc_petition.internal.scaleFactor;
				  //alert(txtWidth);
				  
				   while(txtWidth>largeur_colonne_en_cours-2){
				     la_taille_police=la_taille_police-0.2;
				     txtWidth = doc_petition.getStringUnitWidth(le_texte)*la_taille_police/doc_petition.internal.scaleFactor;	 
			      }
				  
				  doc_petition.setFontSize(la_taille_police);
				  txtWidth = doc_petition.getStringUnitWidth(le_texte)*la_taille_police/doc_petition.internal.scaleFactor;
				  marge=(largeur_colonne_en_cours-txtWidth)/2;
				 

			doc_petition.text(X_debut_text_en_cours+marge, Y_debut_text_en_cours, valeur_cellule);
			
		     X_debut_rect_en_cours=X_debut_rect_en_cours+largeur_colonne_en_cours;
		 }
		 
		 Y_debut_rect_en_cours=Y_debut_rect_en_cours+hauteur_ligne;
		 
		 doc_petition.setFontSize(8);
		 la_taille_police= 8;	  
			 
	
		  }
		  
		   X_debut_rect_en_cours=X_debut_rect;
		   doc_petition.setFontSize(8);
		   la_taille_police= 8;
		  
			
	 //}
		

		// doc_petition.output('dataurlnewwindow');
	    doc_petition.save('etat.pdf');
	   // doc_petition.output();
	
		
   }
   
   
   function creer_liste_sortie_article_pdf(){
	
	
	
	//alert("1");
	
	
	 var doc_petition= new jsPDF('l', 'mm', 'a4', false);
	 
	//alert("2");
	
	
	     var id_image="id_entete";
		 var l_image=document.getElementById(id_image);     
	     doc_petition.addImage(l_image, 'jpeg', 50,5, 200, 40, undefined, 'none');
	
		
		 les_factures=document.getElementsByClassName("div_conteneur_commande");
		 
	//	 alert("3");
	     nb_des_pages=les_factures.length;
		 
		 la_facture=les_factures[nb_des_pages-1];
		
		//var le_tableau =la_facture.getElementByClassName("tableau_liste_eleve");
		var le_tableau =la_facture.getElementsByTagName('table');
		
	//	alert("4");
		//alert(le_tableau.length);
		
		var les_lignes=le_tableau[0].getElementsByTagName('tr');
		
		//alert("2");
		
		nb_lignes= les_lignes.length;
		
		//alert("---"+nb_lignes);
		
		 var pageWidth = doc_petition.internal.pageSize.width;
		
		
		// alert("5");
		
		
		largeur_espace_travail=210;
		
			
		
		largeur_colonne1=7;
		largeur_colonne2=25;
		largeur_colonne3=60;
		largeur_colonne4=30;
		
		hauteur_ligne=7;
		
		largeur_tableau=largeur_colonne1+(largeur_colonne2*2)+largeur_colonne3+(largeur_colonne4*5);
		
		
	    // alert("6");
	
	
		X_debut_rect=(parseInt(pageWidth)-parseInt(largeur_tableau))/2;
		
		//alert("77777");
		
		X_debut_rect=parseInt(X_debut_rect);
		// Recheche nombre lignes entete
		
		/* var specialElementHandlers = {
                '#elementHandle': function (element, renderer) {
                    return true;
                }
            };

		*/
		
		//alert("22");
		
		// Affichage du reste tableau
	  doc_petition.setFontType("");
	  
	  //alert("444");
	 // Y_debut_rect_en_cours=parseInt(Y_debut_rect_en_cours)+parseInt(hauteur_ligne_entete);
	  //Y_debut_rect_en_cours=Y_debut_rect_en_cours+hauteur_ligne;
	 
	// alert("33");
	  
	  la_couleur=1;
	  
	  ligne_debut=0;
	  
	  Y_debut_rect_en_cours=50;
	  
	  la_couleur=0;
	  
	 for (p=ligne_debut;p<nb_lignes;p++){
		 
		 
		// alert("7");

		    if (la_couleur==0){
			   la_couleur=1;
			}else{
			   la_couleur=0;
		    }
		  
		   nb_colonnes_ligne_en_cours=les_lignes[p].cells.length;
		 //  alert(nb_colonnes_ligne_en_cours);
		  /*if (nb_colonnes_ligne_en_cours==1){
			  
			  doc_petition.addPage();
		      X_debut_rect=5;
		      Y_debut_rect=10;
			  Y_debut_rect_en_cours=Y_debut_rect;
			  X_debut_rect_en_cours=X_debut_rect;
			  if (la_couleur==0){
			     la_couleur=1;
			  }else{
			    la_couleur=0;
		      }
			    
		  }else{*/
		  
		  //alert("7");
			  
		   X_debut_rect_en_cours=X_debut_rect;
		   
		   if (p>=nb_lignes-1){
			  X_debut_rect_en_cours=X_debut_rect+largeur_colonne1+(largeur_colonne2*2)+largeur_colonne3;
			  nb_colonnes_ligne_en_cours=6;
			  colonne_debut=1;
		   }else{
			  colonne_debut=0;   
		   }
		   
		// parcour des cellules	     		  
		 for (q=colonne_debut;q<nb_colonnes_ligne_en_cours;q++){
		 
			if (la_couleur==0){
			   doc_petition.setFillColor(255,255,255);
			}else{
			   doc_petition.setFillColor(255,250,100);
			   //doc_petition.setFillColor(255,255,255);
		    }
			
			if (p==0){
			   doc_petition.setFillColor(230,230,230);
			   doc_petition.setFontType("bold");
			}else{
			   doc_petition.setFontType("");   
			}
		   
		    /*if (p==(nb_lignes-1)){
			   doc_petition.setFillColor(230,230,230);
			   doc_petition.setFontType("bold");	
			}*/
			
			//largeur_colonne_en_cours=largeur_colonne;

			 switch (q) {
                
				case 0:
                  largeur_colonne_en_cours=largeur_colonne1;
                break;
			    case 1:
                  largeur_colonne_en_cours=largeur_colonne2;
                break;
                case 2:
                 largeur_colonne_en_cours=largeur_colonne2;	  
                break;
				case 3:
                 largeur_colonne_en_cours=largeur_colonne3;	  
                break;
				case 4:
                 largeur_colonne_en_cours=largeur_colonne4;	  
                break;
				case 5:
                 largeur_colonne_en_cours=largeur_colonne4;	  
                break;
				case 6:
                 largeur_colonne_en_cours=largeur_colonne4;	  
                break;
				case 7:
                 largeur_colonne_en_cours=largeur_colonne4;	  
                break;
				case 8:
                 largeur_colonne_en_cours=largeur_colonne4;	  
                break;
				
               
			 }
			 
			  if (p>=nb_lignes-1){
			     largeur_colonne_en_cours=largeur_colonne4;
				  doc_petition.setFontType("bold");
		      }
			 
			 //alert(largeur_colonne_en_cours);
			 
			 //alert(" X: "+X_debut_rect_en_cours+"Y: "+Y_debut_rect_en_cours+"L: "+largeur_colonne_en_cours+" H : "+hauteur_ligne);
			 
			 //alert(" X: "+X_debut_rect_en_cours+"Y: "+Y_debut_rect_en_cours);
			 
		    doc_petition.rect(X_debut_rect_en_cours,  Y_debut_rect_en_cours,largeur_colonne_en_cours , hauteur_ligne , 'F');
			// alert("6666");
		    doc_petition.setDrawColor(0,0,0);
            doc_petition.rect(X_debut_rect_en_cours,  Y_debut_rect_en_cours, largeur_colonne_en_cours,hauteur_ligne , 'FD');
			// alert("7777");
			// recuperation valeur
			valeur_cellule=les_lignes[p].cells[q].innerHTML;
			
			// alert("8888");
			
			//doc_petition.setFontSize(8);
			X_debut_text_en_cours=X_debut_rect_en_cours;
			Y_debut_text_en_cours=Y_debut_rect_en_cours+4.5;
			
			
			      doc_petition.setFontSize(9);
				   // deterniner fontsize
				   la_taille_police= 9;
				   le_texte=valeur_cellule;
				    txtWidth = doc_petition.getStringUnitWidth(le_texte)*la_taille_police/doc_petition.internal.scaleFactor;
				  //alert(txtWidth);
				  
				   while(txtWidth>largeur_colonne_en_cours-2){
				     la_taille_police=la_taille_police-0.2;
				     txtWidth = doc_petition.getStringUnitWidth(le_texte)*la_taille_police/doc_petition.internal.scaleFactor;	 
			      }
				  
				  doc_petition.setFontSize(la_taille_police);
				  txtWidth = doc_petition.getStringUnitWidth(le_texte)*la_taille_police/doc_petition.internal.scaleFactor;
				  marge=(largeur_colonne_en_cours-txtWidth)/2;
				 

			doc_petition.text(X_debut_text_en_cours+marge, Y_debut_text_en_cours, valeur_cellule);
			
		     X_debut_rect_en_cours=X_debut_rect_en_cours+largeur_colonne_en_cours;
		 }
		 
		 Y_debut_rect_en_cours=Y_debut_rect_en_cours+hauteur_ligne;
		 
		 doc_petition.setFontSize(8);
		 la_taille_police= 8;	  
			 
	
		  }
		  
		   X_debut_rect_en_cours=X_debut_rect;
		   doc_petition.setFontSize(8);
		   la_taille_police= 8;
		  
			
	 //}
		

		// doc_petition.output('dataurlnewwindow');
	    doc_petition.save('etat.pdf');
	   // doc_petition.output();
	
		
		
		
		
   }
   
   
   
   
   function liste_reglement_client_pdf(){
	
	
	
	//alert("1");
	
	//largeur_espace_travail=210;
		largeur_colonne0=7;
		largeur_colonne1=25;
		/*largeur_colonne2=20;
		largeur_colonne3=20;*/
		largeur_colonne4=50;
		/*largeur_colonne5=20;*/
		largeur_colonne6=25;
		
		hauteur_ligne=7;
		
		largeur_tableau=largeur_colonne0+(largeur_colonne1*4)+largeur_colonne4+largeur_colonne6;
		
	
	/* if (le_stock==0){
	    var doc_petition= new jsPDF('l', 'mm', 'a4', false);
		largeur_tableau=largeur_colonne0+largeur_colonne1+(largeur_colonne2*4)+(largeur_colonne4*5);
		
		 var id_image="id_entete";
		 var l_image=document.getElementById(id_image);     
	     doc_petition.addImage(l_image, 'jpeg', 50,5, 200, 40, undefined, 'none');
		
	 }else{*/
		var doc_petition= new jsPDF('p', 'mm', 'a4', false);
		//largeur_tableau=largeur_colonne0+largeur_colonne1+(largeur_colonne4*5);	
		
		 var id_image="id_entete";
	    var l_image=document.getElementById(id_image);     
	    doc_petition.addImage(l_image, 'jpeg', 10,5, 190, 40, undefined, 'none');
		
	// }
		 
    //alert("2");
	
		 //les_factures=document.getElementsByClassName("class_fond_conteneur_page");
		 
	//	 alert("3");
	     nb_des_pages=1;
		 
		//if (le_stock==0){
		  la_facture=document.getElementById("div_page_etat_1");
		//}else{
		//  la_facture=document.getElementById("div_page_etat_2"); 	
		//}
		
		//var le_tableau =la_facture.getElementByClassName("tableau_liste_eleve");
		var le_tableau =la_facture.getElementsByTagName('table');
		
	//	alert("4");
		//alert(le_tableau.length);
		
		var les_lignes=le_tableau[0].getElementsByTagName('tr');
		
		//alert("2");
		
		nb_lignes= les_lignes.length;
		
		//alert("---"+nb_lignes);
		
		 var pageWidth = doc_petition.internal.pageSize.width;
		
		
	
		X_debut_rect=(parseInt(pageWidth)-parseInt(largeur_tableau))/2;
		
		//alert("77777");
		
		X_debut_rect=parseInt(X_debut_rect);
		// Recheche nombre lignes entete
		
		/* var specialElementHandlers = {
                '#elementHandle': function (element, renderer) {
                    return true;
                }
            };

		*/
		
		//alert("22");
		
		// Affichage du reste tableau
	  doc_petition.setFontType("");
	  
	  //alert("444");
	 // Y_debut_rect_en_cours=parseInt(Y_debut_rect_en_cours)+parseInt(hauteur_ligne_entete);
	  //Y_debut_rect_en_cours=Y_debut_rect_en_cours+hauteur_ligne;
	 
	// alert("33");
	  
	  la_couleur=1;
	  
	  ligne_debut=0;
	  
	  Y_debut_rect_en_cours=50;
	  
	  la_couleur=0;
	  
	 for (p=ligne_debut;p<nb_lignes;p++){
		 
		 
		// alert("7");

		    if (la_couleur==0){
			   la_couleur=1;
			}else{
			   la_couleur=0;
		    }
		  
		   nb_colonnes_ligne_en_cours=les_lignes[p].cells.length;
		 //  alert(nb_colonnes_ligne_en_cours);
		  /*if (nb_colonnes_ligne_en_cours==1){
			  
			  doc_petition.addPage();
		      X_debut_rect=5;
		      Y_debut_rect=10;
			  Y_debut_rect_en_cours=Y_debut_rect;
			  X_debut_rect_en_cours=X_debut_rect;
			  if (la_couleur==0){
			     la_couleur=1;
			  }else{
			    la_couleur=0;
		      }
			    
		  }else{*/
		  
		  //alert("7");
			  
		   
		   
		   
		   
		   if (p==nb_lignes-1){
			   X_debut_rect_en_cours=X_debut_rect+largeur_colonne0+(largeur_colonne1*4)+largeur_colonne4;
			   colonne_debut=1;
		   }else{
			  X_debut_rect_en_cours=X_debut_rect; 
			  colonne_debut=0;     
		   }
		   
		   
		   
		  /* if (p>=nb_lignes-1){
			  X_debut_rect_en_cours=X_debut_rect+largeur_colonne1+(largeur_colonne2*2)+largeur_colonne3;
			  nb_colonnes_ligne_en_cours=6;
			  colonne_debut=1;
		   }else{*/
			     
		   /*}*/
		   
		// parcour des cellules	     		  
		 for (q=colonne_debut;q<nb_colonnes_ligne_en_cours;q++){
		 
			
			
			if (p==1){
			   doc_petition.setFillColor(230,230,230);
			   doc_petition.setFontType("bold");
			}else{
			   doc_petition.setFontType("");  
			   if (la_couleur==0){
			      doc_petition.setFillColor(255,255,255);
			   }else{
			     doc_petition.setFillColor(255,250,100);
			   //doc_petition.setFillColor(255,255,255);
		       } 
			}
			
			
			//alert("oui");
			
			if (p==0){
			   doc_petition.setFillColor(255,255,255);
			   doc_petition.setFontType("bold");
			}
			
			
		   
		    /*if (p==(nb_lignes-1)){
			   doc_petition.setFillColor(230,230,230);
			   doc_petition.setFontType("bold");	
			}*/
			
			//largeur_colonne_en_cours=largeur_colonne;
			
		  largeur_colonne_en_cours=largeur_colonne1;
		  
		   switch (q) {
			   
				case 0:
                  largeur_colonne_en_cours=largeur_colonne0;
                break;
			    case 1:
                  largeur_colonne_en_cours=largeur_colonne1;
                break;
                case 2:
                 largeur_colonne_en_cours=largeur_colonne1;	  
                break;
				case 3:
                 largeur_colonne_en_cours=largeur_colonne1;	  
                break;
				case 4:
                 largeur_colonne_en_cours=largeur_colonne4;	  
                break;
				case 5:
                 largeur_colonne_en_cours=largeur_colonne1;	  
                break;
				case 6:
                 largeur_colonne_en_cours=largeur_colonne6;	  
                break;
				
               
			 }		
		
		
			
			  if (p==0){
			     largeur_colonne_en_cours=largeur_tableau;
			  }
			  
			  if (p==nb_lignes-1){
			      largeur_colonne_en_cours=largeur_colonne6;
				  doc_petition.setFillColor(230,230,230);
			      doc_petition.setFontType("bold");	
		      }
			 
			 //alert(largeur_colonne_en_cours);
			 
			 //alert(" X: "+X_debut_rect_en_cours+"Y: "+Y_debut_rect_en_cours+"L: "+largeur_colonne_en_cours+" H : "+hauteur_ligne);
			 
			 //alert(" X: "+X_debut_rect_en_cours+"Y: "+Y_debut_rect_en_cours);
			 
		    doc_petition.rect(X_debut_rect_en_cours,  Y_debut_rect_en_cours,largeur_colonne_en_cours , hauteur_ligne , 'F');
			// alert("6666");
		    doc_petition.setDrawColor(0,0,0);
            doc_petition.rect(X_debut_rect_en_cours,  Y_debut_rect_en_cours, largeur_colonne_en_cours,hauteur_ligne , 'FD');
			// alert("7777");
			// recuperation valeur
			valeur_cellule=les_lignes[p].cells[q].innerHTML;
			
			// alert("8888");
			
			//doc_petition.setFontSize(8);
			X_debut_text_en_cours=X_debut_rect_en_cours;
			Y_debut_text_en_cours=Y_debut_rect_en_cours+4.5;
			
			
			      doc_petition.setFontSize(9);
				   // deterniner fontsize
				   la_taille_police= 9;
				   le_texte=valeur_cellule;
				    txtWidth = doc_petition.getStringUnitWidth(le_texte)*la_taille_police/doc_petition.internal.scaleFactor;
				  //alert(txtWidth);
				  
				   while(txtWidth>largeur_colonne_en_cours-2){
				     la_taille_police=la_taille_police-0.2;
				     txtWidth = doc_petition.getStringUnitWidth(le_texte)*la_taille_police/doc_petition.internal.scaleFactor;	 
			      }
				  
				  doc_petition.setFontSize(la_taille_police);
				  txtWidth = doc_petition.getStringUnitWidth(le_texte)*la_taille_police/doc_petition.internal.scaleFactor;
				  marge=(largeur_colonne_en_cours-txtWidth)/2;
				 
				 
			  doc_petition.text(X_debut_text_en_cours+marge, Y_debut_text_en_cours, valeur_cellule);
			
			
			
			if (p==nb_lignes-1){
				valeur_cellule=les_lignes[p].cells[0].innerHTML;
				le_texte=valeur_cellule;
				txtWidth = doc_petition.getStringUnitWidth(le_texte)*la_taille_police/doc_petition.internal.scaleFactor;
				marge1=X_debut_text_en_cours-txtWidth;
				doc_petition.text(marge1-2, Y_debut_text_en_cours, valeur_cellule);
		    }
			
			
			
			
			
			
		     X_debut_rect_en_cours=X_debut_rect_en_cours+largeur_colonne_en_cours;
		 }
		 
		 Y_debut_rect_en_cours=Y_debut_rect_en_cours+hauteur_ligne;
		 
		 doc_petition.setFontSize(8);
		 la_taille_police= 8;	  
			 
	
		  }
		  
		   X_debut_rect_en_cours=X_debut_rect;
		   doc_petition.setFontSize(8);
		   la_taille_police= 8;
		  
			
	 //}
		

		// doc_petition.output('dataurlnewwindow');
	    doc_petition.save('etat.pdf');
	   // doc_petition.output();
	
		
   }
   

   
   /// impression etats
   
   
   function imprimer_etat_facture_definitive(num_page){
	
	//alert("1");
	
	 var facture_pdf= new jsPDF('P', 'mm', 'a4', false);
	 
	// alert("1");
	 
	 var id_image="id_entete";
	 var l_image=document.getElementById(id_image);     
	 facture_pdf.addImage(l_image, 'jpeg', 10,5, 190, 40, undefined, 'none');
	
	//alert("--");
	
	 les_factures=document.getElementsByClassName("div_conteneur_commande");
	 
	// alert("2");
	 
	 nb_des_pages=les_factures.length;
	 
	// alert(nb_des_pages);
	
	 if (num_page=="-1"){
		 page_de_debut=0;
		 page_de_fin=nb_des_pages-1;
	 }else{
	    page_de_debut=num_page;
		page_de_fin=num_page+1;	
	 }
	

	   //for (i=1;i<page_fin;i++){
	for (i=page_de_debut;i<page_de_fin;i++){
		
		 //alert("ouiiiiii");	 
	 
		creer_facture_pdf(facture_pdf,i,les_factures[i]);
		  
	 }
		
	 //facture_pdf.output('dataurlnewwindow');
	
	
	 facture_pdf.save('etat.pdf');
	 
	 
	// return facture_pdf.output();
		 
	//alert(facture_pdf.output());
	
};










function creer_liste_etat_facture_pdf(doc_petition,numero_page,la_facture){
	
	
	 if (numero_page>0){
			 
	        doc_petition.addPage();
		    var id_image="id_entete";
	        var l_image=document.getElementById(id_image);     
	        doc_petition.addImage(l_image, 'jpeg', 50,5, 200, 40, undefined, 'none');
			
	    }
		

		//var le_tableau =la_facture.getElementByClassName("tableau_liste_eleve");
		var le_tableau =la_facture.getElementsByTagName('table');
		
	//	alert("4");
		//alert(le_tableau.length);
		
		var les_lignes=le_tableau[0].getElementsByTagName('tr');
		
		//alert("2");
		
		nb_lignes= les_lignes.length;
		
		//alert("---"+nb_lignes);
		
		 var pageWidth = doc_petition.internal.pageSize.width;
		
		
		// alert("5");
		
		
		largeur_espace_travail=297;
		

		/*largeur_colonne1=7;
		largeur_colonne2=20;
		largeur_colonne3=50;
		largeur_colonne4=25;*/
		
		largeur_colonne1=7;
		largeur_colonne2=25;
		largeur_colonne3=60;
		largeur_colonne4=30;
		
		
		
		
		
		hauteur_ligne=5;
		
		largeur_tableau=largeur_colonne1+(largeur_colonne2*3)+largeur_colonne3+(largeur_colonne4*3);
		
		
	    // alert("6");
	
	
		X_debut_rect=(parseInt(pageWidth)-parseInt(largeur_tableau))/2;
		
		//alert("77777");
		
		X_debut_rect=parseInt(X_debut_rect);
		// Recheche nombre lignes entete
		
		/* var specialElementHandlers = {
                '#elementHandle': function (element, renderer) {
                    return true;
                }
            };

		*/
		
		//alert("22");
		
		// Affichage du reste tableau
	  doc_petition.setFontType("");
	  
	  //alert("444");
	 // Y_debut_rect_en_cours=parseInt(Y_debut_rect_en_cours)+parseInt(hauteur_ligne_entete);
	  //Y_debut_rect_en_cours=Y_debut_rect_en_cours+hauteur_ligne;
	 
	// alert("33");
	  
	  la_couleur=1;
	  
	  ligne_debut=0;
	  
	  Y_debut_rect_en_cours=50;
	  
	  la_couleur=0;
	  
	 for (p=ligne_debut;p<nb_lignes;p++){
		 
		 
		// alert("7");

		    if (la_couleur==0){
			   la_couleur=1;
			}else{
			   la_couleur=0;
		    }
		  
		   nb_colonnes_ligne_en_cours=les_lignes[p].cells.length;
		 //  alert(nb_colonnes_ligne_en_cours);
		  /*if (nb_colonnes_ligne_en_cours==1){
			  
			  doc_petition.addPage();
		      X_debut_rect=5;
		      Y_debut_rect=10;
			  Y_debut_rect_en_cours=Y_debut_rect;
			  X_debut_rect_en_cours=X_debut_rect;
			  if (la_couleur==0){
			     la_couleur=1;
			  }else{
			    la_couleur=0;
		      }
			    
		  }else{*/
		  
		  //alert("7");
			  
		   X_debut_rect_en_cours=X_debut_rect;
		   
		   if (p>=nb_lignes-1){
			  X_debut_rect_en_cours=X_debut_rect+largeur_colonne1+(largeur_colonne2*2)+largeur_colonne3;
			  nb_colonnes_ligne_en_cours=4;
			  colonne_debut=1;
		   }else{
			  colonne_debut=0;   
		   }
		   
		// parcour des cellules	     		  
		 for (q=colonne_debut;q<nb_colonnes_ligne_en_cours;q++){
		 
			if (la_couleur==0){
			   doc_petition.setFillColor(255,255,255);
			}else{
			   doc_petition.setFillColor(255,250,100);
			   //doc_petition.setFillColor(255,255,255);
		    }
			
			
			if ((p==0)||(p==1)||(p==nb_lignes-1)){
			   doc_petition.setFillColor(230,230,230);
			   doc_petition.setFontType("bold");
			}else{
			   doc_petition.setFontType("");   
			}
		   
		    /*if (p==(nb_lignes-1)){
			   doc_petition.setFillColor(230,230,230);
			   doc_petition.setFontType("bold");	
			}*/
			
			//largeur_colonne_en_cours=largeur_colonne;

			 switch (q) {
                
				case 0:
                  largeur_colonne_en_cours=largeur_colonne1;
                break;
			    case 1:
                  largeur_colonne_en_cours=largeur_colonne2;
                break;
                case 2:
                 largeur_colonne_en_cours=largeur_colonne2;	  
                break;
				case 3:
                 largeur_colonne_en_cours=largeur_colonne3;	  
                break;
				case 4:
                 largeur_colonne_en_cours=largeur_colonne4;	  
                break;
				case 5:
                 largeur_colonne_en_cours=largeur_colonne4;	  
                break;
				case 6:
                 largeur_colonne_en_cours=largeur_colonne4;	  
                break;
				case 7:
                 largeur_colonne_en_cours=largeur_colonne2;	  
                break;
				
               
			 }
			 
			
			  if (p>=nb_lignes-1){
			     largeur_colonne_en_cours=largeur_colonne4;
				  doc_petition.setFontType("bold");
		      }
			  
			  if (p==0){
			     largeur_colonne_en_cours=largeur_tableau;
			  }
			 
			 //alert(largeur_colonne_en_cours);
			 
			 //alert(" X: "+X_debut_rect_en_cours+"Y: "+Y_debut_rect_en_cours+"L: "+largeur_colonne_en_cours+" H : "+hauteur_ligne);
			 
			 //alert(" X: "+X_debut_rect_en_cours+"Y: "+Y_debut_rect_en_cours);
			 
		    doc_petition.rect(X_debut_rect_en_cours,  Y_debut_rect_en_cours,largeur_colonne_en_cours , hauteur_ligne , 'F');
			// alert("6666");
		    doc_petition.setDrawColor(0,0,0);
            doc_petition.rect(X_debut_rect_en_cours,  Y_debut_rect_en_cours, largeur_colonne_en_cours,hauteur_ligne , 'FD');
			// alert("7777");
			// recuperation valeur
			valeur_cellule=les_lignes[p].cells[q].innerHTML;
			
			// alert("8888");
			
			//doc_petition.setFontSize(8);
			X_debut_text_en_cours=X_debut_rect_en_cours;
			Y_debut_text_en_cours=Y_debut_rect_en_cours+3.5;
			
			
			      doc_petition.setFontSize(9);
				   // deterniner fontsize
				   la_taille_police= 9;
				   le_texte=valeur_cellule;
				    txtWidth = doc_petition.getStringUnitWidth(le_texte)*la_taille_police/doc_petition.internal.scaleFactor;
				  //alert(txtWidth);
				  
				   while(txtWidth>largeur_colonne_en_cours-2){
				     la_taille_police=la_taille_police-0.2;
				     txtWidth = doc_petition.getStringUnitWidth(le_texte)*la_taille_police/doc_petition.internal.scaleFactor;	 
			      }
				  
				  doc_petition.setFontSize(la_taille_police);
				  txtWidth = doc_petition.getStringUnitWidth(le_texte)*la_taille_police/doc_petition.internal.scaleFactor;
				  marge=(largeur_colonne_en_cours-txtWidth)/2;
				 

			doc_petition.text(X_debut_text_en_cours+marge, Y_debut_text_en_cours, valeur_cellule);
			
		     X_debut_rect_en_cours=X_debut_rect_en_cours+largeur_colonne_en_cours;
		 }
		 
		 Y_debut_rect_en_cours=Y_debut_rect_en_cours+hauteur_ligne;
		 
		 doc_petition.setFontSize(8);
		 la_taille_police= 8;	  
			 
	
		  }
		  
		   X_debut_rect_en_cours=X_debut_rect;
		   doc_petition.setFontSize(8);
		   la_taille_police= 8;
		  
			
	 //}
		

		 //doc_petition.output('dataurlnewwindow');
	   // doc_petition.save('etat.pdf');
	   // doc_petition.output();
	
		
		
		
		
   }
   
   
   
   
   /////////////////
   
   
   function imprimer_facture_avec_remise_pdf(num_page){
	
	//alert("1");
	
	 var facture_pdf= new jsPDF('P', 'mm', 'a4', false);
	 
	// alert("1");
	 
	 var id_image="id_entete";
	 var l_image=document.getElementById(id_image);     
	 facture_pdf.addImage(l_image, 'jpeg', 10,5, 190, 40, undefined, 'none');
	
	//alert("--");
	
	 les_factures=document.getElementsByClassName("div_conteneur_commande");
	 
	// alert("2");
	 
	 nb_des_pages=les_factures.length;
	 
	// alert(nb_des_pages);
	
	 if (num_page=="-1"){
		 page_de_debut=0;
		 page_de_fin=nb_des_pages-1;
	 }else{
	    page_de_debut=num_page;
		page_de_fin=num_page+1;	
	 }
	

  
   
	   //for (i=1;i<page_fin;i++){
	for (i=page_de_debut;i<page_de_fin;i++){
		
		 //alert("ouiiiiii");	 
	 
		creer_facture_avec_remise_pdf(facture_pdf,i,les_factures[i]);
		  
	 }
		
	 //facture_pdf.output('dataurlnewwindow');
	
	
	 facture_pdf.save('etat.pdf');
	 
	 
	// return facture_pdf.output();
		 
	//alert(facture_pdf.output());
	
};





 function creer_facture_avec_remise_pdf(doc_petition,numero_page,la_facture){
		
       //alert("0000");
	   
	   if (numero_page>1){
	     doc_petition.addPage();
		 
		 var id_image="id_entete";
	     var l_image=document.getElementById(id_image);     
	     doc_petition.addImage(l_image, 'jpeg', 10,5, 190, 40, undefined, 'none');
		 
	   }
	   
	  
	   
	    var pageWidth = doc_petition.internal.pageSize.width;
		
		var le_tableau =la_facture.getElementsByTagName('table');
		
		largeur_du_titre=50;
		
		Y_debut_rect_en_cours=50;
		
		// afficharge du titre
		
		x_tableau_titre=(parseInt(pageWidth)-parseInt(largeur_du_titre))/2;
	
		doc_petition.setFillColor(230,230,230);
	    doc_petition.setFontType("bold");
		hauteur_titre=7;
		doc_petition.rect(x_tableau_titre,Y_debut_rect_en_cours ,largeur_du_titre , hauteur_titre , 'F');
		doc_petition.setDrawColor(0,0,0);
        doc_petition.rect(x_tableau_titre,Y_debut_rect_en_cours, largeur_du_titre, hauteur_titre , 'FD');
		
		var la_zone_titre =la_facture.getElementsByTagName('span');
		
		
		/*nb_la_zone_titre=la_zone_titre.length;
		le_titre=la_zone_titre[nb_la_zone_titre-1].innerHTML;*/
		
		le_titre=la_zone_titre[0].innerHTML;
		
		 doc_petition.setFontSize(10);
				   // deterniner fontsize
				   la_taille_police= 10;
				   le_texte=le_titre;
				  
				    txtWidth = doc_petition.getStringUnitWidth(le_texte)*la_taille_police/doc_petition.internal.scaleFactor;
				 
				   while(txtWidth>largeur_du_titre-2){
				     la_taille_police=la_taille_police-0.2;
				     txtWidth = doc_petition.getStringUnitWidth(le_texte)*la_taille_police/doc_petition.internal.scaleFactor;	 
			      }
				  
				  doc_petition.setFontSize(la_taille_police);
				  txtWidth = doc_petition.getStringUnitWidth(le_texte)*la_taille_police/doc_petition.internal.scaleFactor;
				  marge=(largeur_du_titre-txtWidth)/2;
				 
			//alert("2");

			doc_petition.text(x_tableau_titre+marge,Y_debut_rect_en_cours+5, le_texte);
			

		Y_debut_rect_en_cours=Y_debut_rect_en_cours+13;
		
		
		var les_lignes=le_tableau[0].getElementsByTagName('tr');
		
		
		x_text_debut=40;
		x_text=x_text_debut;
		
		les_td=les_lignes[0].getElementsByTagName('td');
		le_texte=les_td[0].innerHTML;
		doc_petition.text(x_text,Y_debut_rect_en_cours, le_texte);
		le_texte=les_td[1].innerHTML;
		x_text=x_text+7;
		doc_petition.text(x_text,Y_debut_rect_en_cours, le_texte);
		
		le_texte=les_td[2].innerHTML;
		x_text=x_text+30;
		doc_petition.text(x_text,Y_debut_rect_en_cours, le_texte);
		
		le_texte=les_td[3].innerHTML;
		x_text=x_text+10;
		doc_petition.text(x_text,Y_debut_rect_en_cours, le_texte);
		
		
		le_texte=les_td[4].innerHTML;
		x_text=x_text+30;
		doc_petition.text(x_text,Y_debut_rect_en_cours, le_texte);
		
		le_texte=les_td[5].innerHTML;
		x_text=x_text+25;
		doc_petition.text(x_text,Y_debut_rect_en_cours, le_texte);
		
	
		Y_debut_rect_en_cours=Y_debut_rect_en_cours+5;
		x_text=x_text_debut;
		les_td=les_lignes[1].getElementsByTagName('td');
		le_texte=les_td[0].innerHTML;
		
		doc_petition.text(x_text,Y_debut_rect_en_cours, le_texte);
		
		le_texte=les_td[1].innerHTML;
		x_text=x_text+15;
		doc_petition.text(x_text,Y_debut_rect_en_cours, le_texte);
		
		
		Y_debut_rect_en_cours=Y_debut_rect_en_cours+7;
		
		var les_lignes=le_tableau[1].getElementsByTagName('tr');
		
		//alert("2");
		
		nb_lignes= les_lignes.length;
		
		//alert("---"+nb_lignes);
		
		largeur_espace_travail=210;
		largeur_colonne=25;
		largeur_colonne1=7;
		largeur_colonne2=15;
		largeur_colonne3=50;
		
		hauteur_ligne=6;
		
		largeur_tableau=largeur_colonne1+largeur_colonne2*2+largeur_colonne3+(largeur_colonne*4);

	     //alert("9999999")
	
	
		X_debut_rect=(parseInt(pageWidth)-parseInt(largeur_tableau))/2;
		
		//alert("77777");
		
		X_debut_rect=parseInt(X_debut_rect);
		// Recheche nombre lignes entete
		
		/* var specialElementHandlers = {
                '#elementHandle': function (element, renderer) {
                    return true;
                }
            };

		*/
		
		//alert("22");
		
		// Affichage du reste tableau
	  doc_petition.setFontType("");
	  
	  //alert("444");
	 // Y_debut_rect_en_cours=parseInt(Y_debut_rect_en_cours)+parseInt(hauteur_ligne_entete);
	  //Y_debut_rect_en_cours=Y_debut_rect_en_cours+hauteur_ligne;
	 
	// alert("33");
	
	 tableau_caractere = new Array();
	 tableau_caractere.push("<b>");		
	 tableau_caractere.push("</b>");	
	 nb_caractere=tableau_caractere.length;
			 	
	  ligne_debut=0;

	  la_couleur=0;
	   nouv_page=0;
	  
	 for (p=ligne_debut;p<nb_lignes;p++){ 
		 
		 
		   if (Y_debut_rect_en_cours> y_text_de_fin_port){
			  doc_petition.addPage(); 
			  nouv_page=1;
			  Y_debut_rect_en_cours=10;
			  ligne_en_cours_sauv=p-1; 
			  p=ligne_debut; 
		   }


          //alert("1");


		    if (la_couleur==0){
			   la_couleur=1;
			}else{
			   la_couleur=0;
		    }
		  
		   nb_colonnes_ligne_en_cours=les_lignes[p].cells.length;
		 //  alert(nb_colonnes_ligne_en_cours);
		  /*if (nb_colonnes_ligne_en_cours==1){
			  
			  doc_petition.addPage();
		      X_debut_rect=5;
		      Y_debut_rect=10;
			  Y_debut_rect_en_cours=Y_debut_rect;
			  X_debut_rect_en_cours=X_debut_rect;
			  if (la_couleur==0){
			     la_couleur=1;
			  }else{
			    la_couleur=0;
		      }
			    
		  }else{*/
		  
		  //alert("888");
			  
		   X_debut_rect_en_cours=X_debut_rect;
		   
		   if (p>=nb_lignes-4){
			  X_debut_rect_en_cours=X_debut_rect+largeur_colonne1+largeur_colonne2*2+largeur_colonne3+(largeur_colonne*3);
		   }
		   
		   point_debut=1;
		    if (p==nb_lignes-1){ 
			   largeur_colonne_en_cours=largeur_tableau;
			   point_debut=0;
		    }
			
			 
			//alert("2"); 
			 
		// parcour des cellules	     		  
		 for (q=point_debut;q<nb_colonnes_ligne_en_cours;q++){
		 
			if (la_couleur==0){
			   doc_petition.setFillColor(255,255,255);
			}else{
			   //doc_petition.setFillColor(255,250,100);
			   doc_petition.setFillColor(255,255,255);
			   
		    }
			
			if (p==0){
			   doc_petition.setFillColor(230,230,230);
			   doc_petition.setFontType("bold");
			}else{
			   doc_petition.setFontType("");   
			}
		   
		    /*if (p==(nb_lignes-1)){
			   doc_petition.setFillColor(230,230,230);
			   doc_petition.setFontType("bold");	
			}*/
			
			largeur_colonne_en_cours=largeur_colonne;
			
			 switch (q) {
 
			    case 1:
                  largeur_colonne_en_cours=largeur_colonne1;
                break;
                case 2:
                 largeur_colonne_en_cours=largeur_colonne2;	  
                break;
				case 3:
                 largeur_colonne_en_cours=largeur_colonne3;	  
                break;
				case 7:
                 largeur_colonne_en_cours=largeur_colonne2;	  
                break;
               
			 }
			 
			  if (p>=nb_lignes-4){
			     largeur_colonne_en_cours=largeur_colonne;
				  doc_petition.setFontType("bold");
		      }
			  
			  if (p==nb_lignes-1){ 
		         largeur_colonne_en_cours=largeur_tableau;
		      }
			 
			 //alert(largeur_colonne_en_cours);
			 
			 
			 //alert(" X: "+X_debut_rect_en_cours+"Y: "+Y_debut_rect_en_cours+"L: "+largeur_colonne_en_cours+" H : "+hauteur_ligne);
			 
			 //alert(" X: "+X_debut_rect_en_cours+"Y: "+Y_debut_rect_en_cours);
			if (p!=nb_lignes-1){ 
		      doc_petition.rect(X_debut_rect_en_cours,  Y_debut_rect_en_cours,largeur_colonne_en_cours , hauteur_ligne , 'F');
			  // alert("6666");
		      doc_petition.setDrawColor(0,0,0);
              doc_petition.rect(X_debut_rect_en_cours,  Y_debut_rect_en_cours, largeur_colonne_en_cours,hauteur_ligne , 'FD');
			}
			// alert("7777");
			// recuperation valeur
			valeur_cellule=les_lignes[p].cells[q].innerHTML;
	        for(var numc = 0 ; numc < nb_caractere ; numc++){
		       reg=new RegExp(tableau_caractere[numc], 'g')
		       valeur_cellule=valeur_cellule.replace(reg,""); 
	        }
			
			// alert("8888");
			
			//doc_petition.setFontSize(8);
			X_debut_text_en_cours=X_debut_rect_en_cours;
			Y_debut_text_en_cours=Y_debut_rect_en_cours+3.8;
   
			   if (p==nb_lignes-1){
			      doc_petition.setFontSize(11);
				  la_taille_police= 11;
			   }else{
			      doc_petition.setFontSize(9);
				  la_taille_police= 9;	
			   }
				   
				   
				   
				   le_texte=valeur_cellule;
				    txtWidth = doc_petition.getStringUnitWidth(le_texte)*la_taille_police/doc_petition.internal.scaleFactor;
				  //alert(txtWidth);
				  
				   while(txtWidth>largeur_colonne_en_cours-2){
				     la_taille_police=la_taille_police-0.2;
				     txtWidth = doc_petition.getStringUnitWidth(le_texte)*la_taille_police/doc_petition.internal.scaleFactor;	 
			       }
				  
				  doc_petition.setFontSize(la_taille_police);
				  txtWidth = doc_petition.getStringUnitWidth(le_texte)*la_taille_police/doc_petition.internal.scaleFactor;
				  marge=(largeur_colonne_en_cours-txtWidth)/2;

               if (p==nb_lignes-1){
			      doc_petition.text(X_debut_rect, Y_debut_text_en_cours+5, valeur_cellule);
			   }else{
			      doc_petition.text(X_debut_text_en_cours+marge, Y_debut_text_en_cours, valeur_cellule);	
			   }
			
			  if (p>=nb_lignes-4){
			      if (p!=nb_lignes-1){
				     valeur_cellule=les_lignes[p].cells[0].innerHTML;
				     le_texte=valeur_cellule;
				     txtWidth = doc_petition.getStringUnitWidth(le_texte)*la_taille_police/doc_petition.internal.scaleFactor;
				     marge1=X_debut_text_en_cours-txtWidth;
				     doc_petition.text(marge1-2, Y_debut_text_en_cours, valeur_cellule);
				  }
		      }
			
		     X_debut_rect_en_cours=X_debut_rect_en_cours+largeur_colonne_en_cours;
			 
			 
		 } //(q=point_debut;q<nb_colonnes_ligne_en_cours;q++){
		 

		 Y_debut_rect_en_cours=Y_debut_rect_en_cours+hauteur_ligne;
		 
		 doc_petition.setFontSize(8);
		 la_taille_police= 8;	  
			 
			//alert(nouv_page);
			 
		    if ((p==0) &(nouv_page==1)){
				//return;
			    p=ligne_en_cours_sauv;
			    nouv_page=0;
			}
		
		
		//alert("5");	 
	
	 } //  (p=ligne_debut;p<nb_lignes;p++){ 
		  
		  
	   X_debut_rect_en_cours=X_debut_rect;
	   doc_petition.setFontSize(8);
	   la_taille_police= 8;
		  
			
	 //}
		

		//doc_petition.output('dataurlnewwindow');
		
		
		
		
   }
   
   

   
   
   





  
   