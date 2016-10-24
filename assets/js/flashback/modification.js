$(function () {
    $("#selectFlashback").on("change", function () {
        var idFlashback = $("#selectFlashback").val();
        if (idFlashback !== '-1') {
            $("#linkNextFlashback").attr("href", '/flashback/modification/' + idFlashback);
        } else {
            $("#linkNextFlashback").attr("href", '');

        }
    });
});

