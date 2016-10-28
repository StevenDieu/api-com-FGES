$(function () {
    var myDropzone = new Dropzone("#ajouterImageAlbum", {url: "/lesphotos/ajouterImage/" + idAlbum});

    myDropzone.on("complete", function (file) {
        var jsonResult = JSON.parse(file.xhr.response);
        if (jsonResult.id != undefined) {
            $("#all-photos").append('<tr class="even pointer" id="' + jsonResult.id + '">'
                    + '<td class="center-text"><img class="image-photos" src="' + jsonResult.url + '" /></td>'
                    + '<td class="last"><button data-id="' + jsonResult.id + '" class="btn btn-danger supprimerImage">Supprimer</button>'
                    + '</td>'
                    + '</tr>');
        }
    });

    $("#all-photos").on("click", ".supprimerImage", function () {
        var id = $(this).data("id");
        $.ajax({
            method: "POST",
            url: "/lesphotos/supprimerImage/" + id,
        }).success(function () {
            $("#" + id).remove();
        });
    });
});
