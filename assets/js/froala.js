$(function () {
    $('#edit').froalaEditor('html.insert', $("description").val(), true);
    $("#form-froala").on("submit", function () {
        $("#description").val($('#edit').froalaEditor('html.get', true));
        if ($("#description").val() === "") {
            return false;
        }
    });
    
    $('#edit').froalaEditor({
      imageUploadURL: '/flashback/ajoutImage'
    })
});

