$(function () {
    $("#selectAvenir").on("change", function () {
        var idFlashback = $("#selectAvenir").val();
        if (idFlashback !== '-1') {
            $("#linkNextAvenir").attr("href", '/avenir/modification/' + idFlashback);
        } else {
            $("#linkNextAvenir").attr("href", '');

        }
    });
});

