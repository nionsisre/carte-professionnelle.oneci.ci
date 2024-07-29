<script>
    /**
     * This function is used to prevent form submit by giving a form_id and
     * a callback function
     * @function cancelFormSubmit
     * @param {String} form_id
     * @param {function} onSubmitCancelled
     * @returns {void}
     */
    function cancelFormSubmit(form_id, onSubmitCancelled) {
        var first_time = true;
        $(form_id).on("submit", function (event) {
            if (first_time) {
                first_time = false;
                event.preventDefault();
                onSubmitCancelled(form_id);
            }
        });
    }
    /**
     * Ajax REST API Type function
     * Use this function to make ajax rest api requests
     * with or without loader (specify container_id only if loader_enabled is TRUE)
     * @function ajaxRestApiSender
     * @param {String} url
     * @param {String} client
     * @param {String} token
     * @param {String} request_instruction
     * @param {Array} request_data
     * @param {function} responseCallbackFunction
     * @param {Boolean} loader_enabled
     * @param {Element|Object} container_id
     * @returns {void}
     */
    function ajaxRestApiSender(url, client, token, request_instruction, request_data, responseCallbackFunction, loader_enabled, container_id) {
        var rest_api_response;
        var response_code;
        var response_text;
        var response_data;
        loader_enabled = loader_enabled || false;
        $.ajax({
            url: url,
            type: "POST",
            data: {client: client, token: token, instruction: request_instruction, data: request_data},
            dataType: "json",
            async: true,
            beforeSend: function () {
                if (loader_enabled)
                    $(container_id).append('<div id="loader" class="text-center"><br/><br/><img alt="." src="assets/images/loaders/loader15.gif" style="max-height: 4rem; max-width: 4rem;"/><br/><br/><br/></div>');
            },
            success: function (data, textStatus, jqXHR) {
                if (loader_enabled)
                    $("#loader").remove();
                response_code = jqXHR.status;
                response_text = textStatus;
                response_data = data;
                /* Preparing the response before return */
                rest_api_response = {
                    "status": {"code": response_code, "text": response_text},
                    "data": response_data
                };
                responseCallbackFunction(rest_api_response);
            },
            error: function (data) {
                if (loader_enabled)
                    $(container_id).html("");
                response_code = data.status;
                response_text = data.statusText;
                response_data = "";
                /* Preparing the response before return */
                rest_api_response = {
                    "status": {"code": response_code, "text": response_text},
                    "data": response_data
                };
                responseCallbackFunction(rest_api_response);
            }
            /* Other server responses */
            /* ,statusCode: { 500: function (data, textStatus) {} */
        });
    }

    /**
     * Prend une chaîne de caractères représentant une date au format "YYYY-MM-DD"
     * et la reformate au format "DD/MM/YYYY".
     *
     * @param {string} dateString - La date à reformater, exprimée au format "YYYY-MM-DD".
     *
     * @returns {string} - La date reformatée au format "DD/MM/YYYY".
     */
    function formatDate(dateString) {
        // Découpe la chaîne dateString en utilisant le séparateur '-'
        const parts = dateString.split('-');
        // Réarrange les parties dans le format souhaité
        const formattedDate = `${parts[2]}/${parts[1]}/${parts[0]}`;
        return formattedDate;
    }
</script>
