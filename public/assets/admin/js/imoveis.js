document.addEventListener('DOMContentLoaded', function() {
    Dropzone.autoDiscover = false;
    var dropzoneElement = document.getElementById('imagens-dropzone');
    var uploadUrl = dropzoneElement.getAttribute('data-upload-url');
    var deleteUploadUrl = dropzoneElement.getAttribute('data-delete-upload-url');
    var imagensData = dropzoneElement.getAttribute('data-imagens');
    var imagens = [];

    // Verificar se o URL de upload está presente
    if (!uploadUrl) {
        console.error('No upload URL provided.');
        return;
    }

    // Tente parsear o JSON de imagens, se existir
    try {
        imagens = JSON.parse(imagensData);
    } catch (e) {
        console.log('Nenhuma imagem existente para carregar.');
    }

    // Get the template HTML and remove it from the document
    var previewNode = document.querySelector("#template");
    previewNode.id = "";
    var previewTemplate = previewNode.parentNode.innerHTML;
    previewNode.parentNode.removeChild(previewNode);

    var myDropzone = new Dropzone(dropzoneElement, {
        url: uploadUrl,
        thumbnailWidth: 80,
        thumbnailHeight: 80,
        parallelUploads: 20,
        previewTemplate: previewTemplate,
        autoQueue: false, // Make sure the files aren't queued until manually added
        previewsContainer: "#previews", // Define the container to display the previews
        clickable: ".fileinput-button", // Define the element that should be used as click trigger to select files.
        init: function () {
            // Load existing files from server
            if (imagens && imagens.length > 0) {
                imagens.forEach(function(imagem) {
                    var mockFile = { name: imagem.caminho_imagem.split('/').pop(), size: 12345 };
                    this.emit("addedfile", mockFile);
                    this.emit("thumbnail", mockFile, imagem.caminho_imagem);
                    this.emit("complete", mockFile);
                }.bind(this));
            }
        }
    });

    myDropzone.on("addedfile", function (file) {
        // Hookup the start button
        file.previewElement.querySelector(".start").onclick = function () { myDropzone.enqueueFile(file) };
    });

    // Update the total progress bar
    myDropzone.on("totaluploadprogress", function (progress) {
        document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
    });

    myDropzone.on("sending", function (file) {
        // Show the total progress bar when upload starts
        document.querySelector("#total-progress").style.opacity = "1";
        // And disable the start button
        file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
    });

    // Hide the total progress bar when nothing's uploading anymore
    myDropzone.on("queuecomplete", function () {
        document.querySelector("#total-progress").style.opacity = "0";
    });

    // Setup the buttons for all transfers
    document.querySelector("#actions .start").onclick = function () {
        myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
    };
    document.querySelector("#actions .cancel").onclick = function () {
        myDropzone.removeAllFiles(true);
    };

    myDropzone.on("removedfile", function (file) {
        if (file.status === "success") {
            // Assuming the server returns the file ID in the response
            var fileId = file.upload.uuid; // Adjust this based on the actual response
            $.ajax({
                url: deleteUploadUrl+fileId,
                type: 'DELETE',
                success: function(result) {
                    console.log("File deleted successfully");
                },
                error: function(err) {
                    console.error("Error deleting file:", err);
                }
            });
        }
    });
});