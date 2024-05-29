function generer_code_barre() {

    /* // POUR RETARDER
       var xhr_object = null;
       if(window.XMLHttpRequest) // Firefox
           xhr_object = new XMLHttpRequest();
       else if(window.ActiveXObject) // Internet Explorer
          xhr_object = new ActiveXObject("Microsoft.XMLHTTP");
       else { // XMLHttpRequest non supportÃ© par le navigateur
         alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest...");
          return;
       } */

    var logoImg = document.getElementById("id_logo");
    var whitePageContainer = document.getElementById("div_page_etat_1");
    whitePageContainer.innerHTML = ""; // Empty White Page container
    
    // Default Values
    var barcodeQuantity = 65; // Amount of generated barcode on white page container
    var barcodeIntervalBegin = Date.now()-barcodeQuantity; // Generating number using Timestamp
    var barcodeIntervalEnd = barcodeIntervalBegin + barcodeQuantity;
    var logoHeight = 3;
    var logoWidth = 4.5;
    var barcodeHeight = 3.5;
    var barcodeWidth = 10;
    var xAxisLeftDefault = 5.5;
    var yAxisTopDefault = 2;
    var barcodePerLinesQuantity = 5;
    var barcodePerLinesCurrent = 0;
    var xAxisLeft = 0;
    var yAxisTop = 0;
    var imgElement;

    for (let i = barcodeIntervalBegin; i < barcodeIntervalEnd; i++) {
        
        if (i == barcodeIntervalBegin) {

            // Logo Image Element
            imgElement = document.createElement("img");
            xAxisLeft = xAxisLeftDefault;
            yAxisTop = yAxisTopDefault;
            imgElement.id = "logo_" + i;
            imgElement.className = "les_logo";
            imgElement.style.height = logoHeight + "em";
            imgElement.style.width = logoWidth + "em";
            // imgElement.style.position = "relative";
            imgElement.style.left = (xAxisLeft-0.25) + "em";
            imgElement.style.top = yAxisTop + "em";
            imgElement.src = logoImg.src;
            whitePageContainer.appendChild(imgElement);

            // Barcode Image Element
            imgElement = document.createElement("img");
            // imgElement.style.position = "relative";
            imgElement.id = "image_" + i;
            imgElement.className = "les_codes_barres";
            imgElement.style.width = barcodeWidth+"em";
            imgElement.style.height = barcodeHeight+"em";
            imgElement.style.left = (xAxisLeft - 7.5)+"em";
            imgElement.style.top = (yAxisTop + 3.4)+"em";
            whitePageContainer.appendChild(imgElement);

        } else {

            // LOGO
            imgElement = document.createElement("img");
            xAxisLeft += (logoWidth/2 - xAxisLeftDefault/2);
            imgElement.id = "logo_" + i;
            imgElement.className = "les_logo";
            imgElement.style.height = logoHeight + "em";
            imgElement.style.width = logoWidth + "em";
            // imgElement.style.position = "relative";
            imgElement.style.left = (xAxisLeft+0.25) + "em";
            imgElement.style.top = yAxisTop + "em";
            imgElement.src = logoImg.src;
            whitePageContainer.appendChild(imgElement);

            yAxisTop_code = yAxisTop + logoHeight;
            imgElement = document.createElement("img");

            // imgElement.style.position = "relative";
            imgElement.id = "image_" + i;
            imgElement.className = "les_codes_barres";
            imgElement.style.width = barcodeWidth + "em";
            imgElement.style.height = barcodeHeight + "em";
            imgElement.style.left = (xAxisLeft -6.75)+"em";
            imgElement.style.top = (yAxisTop + 3.4)+"em";
            whitePageContainer.appendChild(imgElement);
        }

        le_code = i + "";


        long_code = le_code.length;

        while (long_code < 10) {
            le_code = "0" + le_code;
            long_code = le_code.length
        }

        le_code = le_code;
        //alert(le_code);
        JsBarcode("#" + imgElement.id, le_code, {
            format: "CODE128",
            displayValue: true,
            fontSize: 30,
            //lineColor: "#0cc"
        });

        //alert("7");


        barcodePerLinesCurrent++;
        if (barcodePerLinesCurrent == barcodePerLinesQuantity) {
            yAxisTop = parseInt(yAxisTop) + logoHeight + parseInt(logoHeight);
            yAxisTop = parseInt(yAxisTop)-1.5;
            xAxisLeft = xAxisLeftDefault;
            barcodePerLinesCurrent = 0;
        }


    }

}


function creer_fichier() {

    //alert("0");
    var file = new ActiveXObject("Scripting.FileSystemObject");

    // alert("1");
    var a = file.CreateTextFile("c:\\testfile.txt", true);
    //alert("2");
    a.WriteLine("Salut cppFrance !");
    //alert("3");
    a.Close();

}


function onInitFs(fs) {
    alert('Systeme de fichier: ' + fs.name);
}

function errorHandler(e) {
    var msg = '';
    switch (e.code) {
        case FileError.QUOTA_EXCEEDED_ERR:
            msg = 'QUOTA_EXCEEDED_ERR';
            break;
        case FileError.NOT_FOUND_ERR:
            msg = 'NOT_FOUND_ERR';
            break;
        case FileError.SECURITY_ERR:
            msg = 'SECURITY_ERR';
            break;
        case FileError.INVALID_MODIFICATION_ERR:
            msg = 'INVALID_MODIFICATION_ERR';
            break;
        case FileError.INVALID_STATE_ERR:
            msg = 'INVALID_STATE_ERR';
            break;
        default:
            msg = 'Unknown Error';
            break;
    }
    ;
    alert('Error: ' + msg);
}


function onInitFs(fs) {
    fs.root.getFile('tutorielsenfolie.txt', {create: true, exclusive: true}, function (fileEntry) {
        alert(fileEntry.name);
    }, errorHandler);
}

onInitFs("txt");

window.requestFileSystem = window.requestFileSystem || window.webkitRequestFileSystem;
window.requestFileSystem(window.TEMPORARY, 1 * 1024 * 1024 /*1MB*/, onInitFs, errorHandler);



