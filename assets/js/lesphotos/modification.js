$(function () {
    $("#selectAlbum").on("change", function () {
        var idAlbum = $("#selectAlbum").val();
        if (idAlbum !== '-1') {
            $("#linkNextAlbum").attr("href", '/lesphotos/modificationAlbum/' + idAlbum);
        } else {
            $("#linkNextAlbum").attr("href", '');
        }
    });

    $("#selectPhotos").on("change", function () {
        var idPhotos = $("#selectPhotos").val();
        if (idPhotos !== '-1') {
            $("#linkNextPhotos").attr("href", '/lesphotos/modificationPhotos/' + idPhotos);
        } else {
            $("#linkNextPhotos").attr("href", '');
        }
    });
});

