$(function () {
    $("#selectUtilisateur").on("change", function () {
        var idFlashback = $("#selectUtilisateur").val();
        if (idFlashback !== '-1') {
            $("#linkNextUtilisateur").attr("href", '/utilisateur/modification/' + idFlashback);
        } else {
            $("#linkNextUtilisateur").attr("href", '');

        }
    });
});

