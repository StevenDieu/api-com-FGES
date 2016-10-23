$(function () {
    $('#edit').froalaEditor('html.insert', $("description").val(), true);
    $("#form-froala").on("submit", function () {
        $("#description").val($('#edit').froalaEditor('html.get', true));
        if ($("#description").val() === "") {
            return false;
        }
    });

    $('#edit').froalaEditor({
        imageUploadURL: '/flashback/ajoutImage/' + nextId
    })

    $('#edit').on('froalaEditor.image.removed', function (e, editor, $img) {
        $.ajax({
            // Request method.
            method: 'POST',
            // Request URL.
            url: '/flashback/supprimeImage',
            // Request params.
            data: {
                src: $img.attr('src')
            }
        }).done(function (data) {
            console.log('Image was deleted');
        }).fail(function (err) {
            console.log('Image delete problem: ' + JSON.stringify(err));
        })
    });
});

