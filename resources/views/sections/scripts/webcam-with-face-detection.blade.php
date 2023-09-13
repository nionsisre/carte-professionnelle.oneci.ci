<script defer src="{{ URL::asset('assets/js/f.min.js') }}" type='text/javascript'></script>
<script>
    var vsnp;
    function openSnp(){
        {{-- Begin Face API Detection --}}
        Promise.all([
            faceapi.nets.tinyFaceDetector.loadFromUri("{{ URL::asset('assets/models') }}"),
            faceapi.nets.faceLandmark68Net.loadFromUri("{{ URL::asset('assets/models') }}"),
            {{--faceapi.nets.faceRecognitionNet.loadFromUri("./models"),
            faceapi.nets.faceExpressionNet.loadFromUri("./models"),
            faceapi.nets.faceLandmark68TinyNet.load(modelPath),
            faceapi.nets.ageGenderNet.load(modelPath)--}}
        ]).then(startWebcam);
        {{-- End Face API Detection --}}

        function startWebcam() {
            jQuery('#modalSnp').html(
                '<center> \
                    <div>\
                        <div id="snp-container" class="modal-header">\
                            <video id="video" width="600" height="450" autoplay />\
                            <img id="snp-wf" src="{{asset('assets/images/selfie-wireframe.svg')}}" style="width: 77%;position: absolute;top: -2.5%;left: 11%;">\
                    </div>\
                    <div class="modal-footer" style="margin-top: 1.2em">\
                        <a href="#" onclick="snp()" id="snp-modal-btn" rel="modal:close" style="color: #000000; text-decoration: none; padding: 0.5em 1.5em; border-radius: 0.6em; border-style: solid; border-width: 1px; background-color: #388E3C;border-color: #1B5E20;z-index: 99;position: relative;left: 0.5%;"><i class="fa fa-camera"></i> &nbsp; Prendre la photo</a><br/><br/>\
                        <a href="#" onclick="csnp()" id="close-modal-btn" rel="modal:close" style="color: #000000; text-decoration: none; padding: 0.5em 1.5em; border-radius: 0.6em; border-style: solid; border-width: 1px; background-color: #d7ebf5;border-color: #99c7de;">Annuler</a><br/>\
                    </div>\
                    </div>\
                </center>'
            );
            vsnp = document.getElementById("video");
            navigator.mediaDevices
                .getUserMedia({
                    video: true,
                    audio: false,
                })
                .then((stream) => {
                    vsnp.srcObject = stream;
                    jQuery('#modalSnp').modal({
                        escapeClose: false,
                        clickClose: false,
                        showClose: false
                    });
                    jQuery('.blocker').css('z-index','2');

                    {{-- Begin Face API Detection --}}
                    vsnp.addEventListener("play", () => {
                        const canvas = faceapi.createCanvasFromMedia(vsnp);
                        const snpContainer = document.getElementById("snp-container");
                        canvas.style.position = "absolute";
                        canvas.style.width = "86%";
                        canvas.style.top = "5%";
                        canvas.style.left = "7%";
                        snpContainer.append(canvas);
                        faceapi.matchDimensions(canvas, { height: vsnp.height, width: vsnp.width });

                        setInterval(async () => {
                            const detections = await faceapi
                            {{--.detectSingleFace(video, new faceapi.TinyFaceDetectorOptions())--}}
                                .detectAllFaces(vsnp, new faceapi.TinyFaceDetectorOptions())
                                .withFaceLandmarks()
                            {{--.withFaceExpressions();--}}

                            const resizedDetections = faceapi.resizeResults(detections, {
                                height: vsnp.height,
                                width: vsnp.width,
                            });
                            canvas.getContext("2d").clearRect(0, 0, canvas.width, canvas.height);
                            {{--faceapi.draw.drawDetections(canvas, resizedDetections);--}}
                            faceapi.draw.drawFaceLandmarks(canvas, resizedDetections);
                            {{--faceapi.draw.drawFaceExpressions(canvas, resizedDetections);--}}
                            {{--console.log(detections);--}}
                        }, 100);
                    });
                    {{-- End Face API Detection --}}
                })
                .catch((error) => {
                    console.error(error);
                });
        }

    }
    function snp() {
        const video = document.getElementById("video");
        const canvas = document.createElement("canvas");
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;

        const context = canvas.getContext("2d");
        context.drawImage(video, 0, 0, canvas.width, canvas.height);

        const img = document.getElementById("selfie-overview");
        let snpData = canvas.toDataURL("image/png");

        img.src = snpData;
        img.style.display = "block";

        const snpInput = document.querySelector('[name="selfie_img_txt"]');
        snpInput.value = 'empty';
        {{--snpInput.value = snpData;--}}

        const stream = video.srcObject;
        const tracks = stream.getTracks();
        tracks.forEach(track => track.stop());

        jQuery('#modalSnp').html('');
    }
    function csnp() {
        const video = document.getElementById("video");
        video.srcObject.getTracks().forEach(track => track.stop());

        jQuery('#modalSnp').html('');
    }
</script>
