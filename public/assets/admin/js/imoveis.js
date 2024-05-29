document.addEventListener("DOMContentLoaded", function () {
  Dropzone.autoDiscover = false;
  var dropzoneElement = document.getElementById("imagens-dropzone");
  var uploadUrl = dropzoneElement.getAttribute("data-upload-url");
  var deleteUploadUrl = dropzoneElement.getAttribute("data-delete-upload-url");
  var imagensData = dropzoneElement.getAttribute("data-imagens");
  var imagens = [];

  if (uploadUrl) {
    // Tente parsear o JSON de imagens, se existir
    try {
      imagens = JSON.parse(imagensData);
    } catch (e) {
      console.log("Nenhuma imagem existente para carregar.");
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
          imagens.forEach(function (imagem) {
            var mockFile = { size: 12345, id: imagem.id };
            this.emit("addedfile", mockFile);
            this.emit("thumbnail", mockFile, BASE_URL + imagem.caminho_imagem);
            this.emit("complete", mockFile);
            // Adicionar o ID da imagem ao botão de delete
            mockFile.previewElement.querySelector("[data-dz-remove]")
              .setAttribute("data-id", imagem.id);
            // Ajustar o tamanho da miniatura da imagem carregada
            mockFile.previewElement.querySelector("img").style.width = "80px";
            mockFile.previewElement.querySelector("img").style.height = "80px";
            mockFile.previewElement.querySelector(".start").style.display =
              "none";
          }.bind(this));
        }
      },
    });

    myDropzone.on("addedfile", function (file) {
      // Hookup the start button
      file.previewElement.querySelector(".start").onclick = function (e) {
        e.preventDefault();
        myDropzone.enqueueFile(file);
      };
    });

    // Update the total progress bar
    myDropzone.on("totaluploadprogress", function (progress) {
      document.querySelector("#total-progress .progress-bar").style.width =
        progress + "%";
    });

    myDropzone.on("sending", function (file) {
      // Show the total progress bar when upload starts
      document.querySelector("#total-progress").style.opacity = "1";
      // And disable the start button
      file.previewElement.querySelector(".start").setAttribute(
        "disabled",
        "disabled",
      );
    });

    myDropzone.on("success", function (file, response) {
      // Adicionar o ID da imagem ao botão de delete quando o upload for bem-sucedido
      if (response.success) {
        file.previewElement.querySelector("[data-dz-remove]").setAttribute(
          "data-id",
          response.id,
        );
      }
    });

    // Hide the total progress bar when nothing's uploading anymore
    myDropzone.on("queuecomplete", function () {
      document.querySelector("#total-progress").style.opacity = "0";
    });

    // Setup the buttons for all transfers
    // Setup the buttons for all transfers
    document.querySelector("#actions .start").onclick = function (e) {
      e.preventDefault();
      myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
    };
    document.querySelector("#actions .cancel").onclick = function (e) {
      e.preventDefault();
      myDropzone.removeAllFiles(true);
    };

    myDropzone.on("removedfile", function (file) {
      console.log(file);
      var fileId = file.id;

      if (file.status === "success") {
        // Assuming the server returns the file ID in the response
        fileId = file.previewElement.querySelector("[data-dz-remove]")
          .getAttribute("data-id");
      }
      if (fileId) {
        $.ajax({
          url: deleteUploadUrl + fileId,
          type: "DELETE",
          success: function (result) {
            console.log("File deleted successfully");
          },
          error: function (err) {
            console.error("Error deleting file:", err);
          },
        });
      }
    });
  }
  $(function () {
    console.log("executou");
    // Summernote
    $("#summernote").summernote({
      height: 250,
      codemirror: {
        theme: "monokai",
      },
    });
  });
});
