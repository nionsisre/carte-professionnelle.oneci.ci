/*
 * NOTE: Process Manager
 * @author Kouassi NIONSIS-RE
 * @copyright 2020
 * @version: 1.0
 */
// -----------------------------------------------------------

/**
* Global Variables
*/
var SERVER_URL = $("#dft-lnk").text();
var processDataLength = $("#process-data-length").text();
var processDataDone = $("#process-data-done");
var processDataFailed = $("#process-data-failed");
var processDataPercentage = $("#process-data-percentage");
var processProgressBar = $("#process-progress-bar");
var processTaskName = $("#process-task-name");
var startProcessBtn = $("#start-process");
var pauseProcessBtn = $("#pause-process");
var skipCurrentProcessBtn = $("#skip-current-process");
var stopAllProcessBtn = $("#stop-all-processes");
var currentPercentage = 0;
var currentIndex = 0;
var csvDataArray = csvDataArray;
var automatedTries = true;
var maxAttempt = 3;
var currentAttempt = 0;
var isPaused = false;
var tempTransactionID = "";
var tempMessage = "";
var promises = [];
var logArray = [];

/**
 * Events Handlers Function
 * Use this function to set all the events handlers of the application
 * @function setAllEventsHandlers
 * @returns {void}
 */
function setAllEventsHandlers() {
    // -- On Click Events
    /* Cards events */
    document.getElementById("start-process").onclick = function() { startProcess(); };
    document.getElementById("pause-process").onclick = function() { pauseProcess(); };
    document.getElementById("skip-current-process").onclick = function() { skipCurrentProcess(); };
    document.getElementById("stop-all-processes").onclick = function() { stopAllProcesses(); };
}

function startProcess() {
    isPaused = false;
    startProcessBtn.attr("disabled", "true");
    skipCurrentProcessBtn.attr("disabled", "true");
    stopAllProcessBtn.attr("disabled", "true");
    pauseProcessBtn.removeAttr("disabled");
    setTaskName(1, processTaskName);
    doProcess();
}

function pauseProcess() {
    pauseProcessBtn.attr("disabled", "true");
    skipCurrentProcessBtn.removeAttr("disabled");
    stopAllProcessBtn.removeAttr("disabled");
    startProcessBtn.removeAttr("disabled");
    isPaused = true;
}

function skipCurrentProcess() {
    setProcessStatus("failed");
    updateProgressPercentage();
    currentAttempt = 0;
    startProcess();
}

function stopAllProcesses() {
    var msisdn = csvDataArray[currentIndex][0];
    setTaskName(6, processTaskName, msisdn);
    resetProgressPercentage();
    skipCurrentProcessBtn.attr("disabled", "true");
    stopAllProcessBtn.attr("disabled", "true");
}

function doProcess(){
    if (currentIndex < processDataLength) {
        var msisdn = csvDataArray[currentIndex][0];
        var apiUrl = csvDataArray[currentIndex][4];
        var request = $.ajax({
            url: SERVER_URL+"/api",
            method: 'POST',
            data: {
                "client" : "ONECI_TRACkING",
                "instruction" : "AJAX_TEST",
                "api_url" : apiUrl,
            },
            beforeSend: function() {
                setTaskName(2, processTaskName, msisdn);
            },
            success: function(data, textStatus, jqXHR) {
                // Parse XML
                var xml = $.parseXML(data);
                xml = $(xml);
                result = xml.find('Result');
                transactionID = xml.find('TransactionID');
                netPoints = xml.find('NetPoints');
                tempTransactionID = transactionID.text();
                tempMessage = result.text();
                if (result.text() === "OK") {
                    currentAttempt = 0;
                    // Update Progress
                    setProcessStatus("done");
                    updateProgressPercentage();
                    if(!isPaused) {
                        doProcess();
                    } else {
                        setTaskName(5, processTaskName, msisdn);
                    }
                } else if (result.text() === "602.9 Sorry, we are not able to process your request due to a charging error. Please try again later.") {
                    if(!isPaused) {
                        if (automatedTries) {
                            if (currentAttempt <= maxAttempt) {
                                currentAttempt++;
                                setTaskName(4, processTaskName, msisdn);
                                doProcess();
                            } else {
                                setTaskName(3, processTaskName, msisdn);
                                skipCurrentProcess();
                            }
                        } else {
                            setTaskName(3, processTaskName, msisdn);
                            skipCurrentProcess();
                        }
                    } else {
                        setTaskName(5, processTaskName, msisdn);
                    }
                } else {
                    if(!isPaused) {
                        setTaskName(3, processTaskName, msisdn);
                        skipCurrentProcess();
                    } else {
                        setTaskName(5, processTaskName, msisdn);
                    }
                }
            },
            error: function () {
                setTaskName(8, processTaskName);
                pauseProcess();
            }
        });
        promises.push(request);
    } else {
        currentPercentage = 100;
        startProcessBtn.attr("disabled", "true");
        pauseProcessBtn.attr("disabled", "true");
        skipCurrentProcessBtn.attr("disabled", "true");
        stopAllProcessBtn.attr("disabled", "true");
        processDataPercentage.text(currentPercentage);
        setTaskName(7, processTaskName);
    }
}

function updateProgressPercentage() {
    currentIndex ++;
    currentPercentage = Math.round((parseInt(currentIndex) / parseInt(processDataLength)) * 100); // round, ceil, floor
    processProgressBar.attr("style", "width : "+currentPercentage+"%");
    processDataPercentage.text(currentPercentage);
}

function resetProgressPercentage(){
    currentIndex = 0;
    currentPercentage = 0;
    processProgressBar.attr("style", "width : "+0+"%");
    processDataPercentage.text(currentPercentage);
    processDataDone.text(0);
    processDataFailed.text(0);
}

function setProcessStatus(status) {
    switch(status) {
        case "done":
            var temp = processDataDone.text();
            temp++;
            processDataDone.text(temp);
            $("#automated-tab-line-"+csvDataArray[currentIndex][5]).attr("style","background : #dff0d8");
            $("#automated-tab-status-"+csvDataArray[currentIndex][5]).text("Envoyé");
            $("#automated-tab-tid-"+csvDataArray[currentIndex][5]).text(tempTransactionID);
            $("#automated-tab-message-"+csvDataArray[currentIndex][5]).text(tempMessage);
            break;
        case "failed":
            var temp = processDataFailed.text();
            temp++;
            processDataFailed.text(temp);
            $("#automated-tab-line-"+csvDataArray[currentIndex][5]).attr("style","background : #f2dede");
            $("#automated-tab-status-"+csvDataArray[currentIndex][5]).text("Echec");
            $("#automated-tab-tid-"+csvDataArray[currentIndex][5]).text(tempTransactionID);
            $("#automated-tab-message-"+csvDataArray[currentIndex][5]).text(tempMessage);
            break;
    }
}
    
function setTaskName(taskNumber, processTaskNameSelector, extra) {
    extra = extra || false;
    switch (taskNumber) {
        case 1:
            processTaskNameSelector.text("Démarrage en cours...");
            break;
        case 2:
            processTaskNameSelector.text("Envoi de SMS au numéro : " + extra);
            break;
        case 3:
            processTaskNameSelector.text("Echec d'envoi SMS au numéro : " + extra + ". Veuillez réessayer, arrêter ou passer au suivant...");
            break;
        case 4:
            processTaskNameSelector.text("Nouvelle tentative d'envoi SMS au numéro : " + extra + "...");
            break;
        case 5:
            processTaskNameSelector.text("Envoi de SMS en pause sur le numéro : " + extra + "...");
            break;
        case 6:
            processTaskNameSelector.text("Envoi de SMS interrompu sur le numéro : " + extra + "...");
            break;
        case 7:
            processTaskNameSelector.text("Envoi de SMS terminé ! ("+processDataDone.text()+" / "+processDataLength+")");
            break;
        case 8:
            processTaskNameSelector.text("Impossible de joindre le serveur veuillez vérifier votre connexion internet ou réessayer plus tard...");
            break;
    }
}

setAllEventsHandlers();
$.when.apply(null, promises).done(function() {
    $('body').append('All Done!');
});

/*function printLog(logArray) {
    
    var logArray = ["ram", "ram", "jan", "jan", "feb", "feb"]
    var row_width = 40;

    var content = "";
    content += "Username" + new Array(row_width + 1).join(" ") + "Password\n";
    content += "********" + new Array(row_width + 1).join(" ") + "********\n";

    for (var i = 0; i < logArray.length; i += 2) {
        content += logArray[i] + new Array(row_width - logArray[i].length + 9).join(" ");
        content += logArray[i+1];
        content += "\n";
    }

    // Build a data URI:
    uri = "data:application/octet-stream," + encodeURIComponent(content);

    // Click on the file to download
    // You can also do this as a button that has the href pointing to the data URI
    location.href = uri;
}*/
/*
type: "GET",
headers: {
    "Host": "smspro.mtn.ci",
    "User-Agent": "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:77.0) Gecko/20100101 Firefox/77.0",
    "Accept": "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/
    /*     ca continue ->                                 *;q=0.8",
    "Accept-Language": "fr,fr-FR;q=0.8,en-US;q=0.5,en;q=0.3",
    "Accept-Encoding": "gzip, deflate",
    "Connection": "keep-alive",
    "Upgrade-Insecure-Requests": "1"
},
url: api_url,
*/