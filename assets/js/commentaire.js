/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var comment = {
    currentDelete: false,
    currentShowComment: false,

    init: function () {
        var self = this;
        $(document).on("click", ".change-active", function () {
            self.sendActive($(this));
        });
        $(document).on("click", ".delete-comment", function () {
            self.sendDelete($(this));
        });
        $(document).on("click", ".show-article-comment", function () {
            self.showArticleComment($(this));
        });
    },

    getActive: function (id, active) {
        var url = "/comment/comment/" + id + "/active/" + active;
        return $.ajax({
            url: url,
            type: "PATCH",
            dataType: "json"
        });
    },

    getDelete: function (id) {
        var url = "/comment/comment/" + id;
        return $.ajax({
            url: url,
            type: "DELETE",
            dataType: "json"
        });
    },

    getArticle: function (id, type) {
        var url = "/comment/comment/" + type + "/" + id;
        return $.ajax({
            url: url,
            type: "GET",
            dataType: "json"
        });
    },

    sendActive: function (elem) {
        if (elem.data("load") !== true) {
            elem.html("Chargement ...");
            elem.data("load", true);
            var active = elem.data("active");
            var id = elem.data("id");
            var self = this;
            this.getActive(id, active).done(function (data) {
                elem.data("load", false);
                self.changeButtonActive(active, id);
                new PNotify({
                    title: 'Succés actif/inactif',
                    text: data.result,
                    type: 'success',
                    styling: 'bootstrap3'
                });
            }).fail(function (data) {
                elem.data("load", false);
                new PNotify({
                    title: 'Erreur actif/inactif',
                    text: data.result,
                    type: 'error',
                    styling: 'bootstrap3'
                });
            });
        }
    },

    changeButtonActive: function (active, id) {
        var buttonChangeActive = $(".change-active-" + id);

        if (active === 1) {
            buttonChangeActive.html("Actif");
            buttonChangeActive.data("active", 0);
            buttonChangeActive.removeClass("btn-danger");
            buttonChangeActive.addClass("btn-success");
        } else {
            buttonChangeActive.html("Inactif");
            buttonChangeActive.data("active", 1);
            buttonChangeActive.addClass("btn-danger");
            buttonChangeActive.removeClass("btn-success");
        }
    },

    sendDelete: function (elem) {
        if (elem.data("load") !== true && confirm("Voulez-vous vraiment supprimer ce commentaire ?")) {
            elem.html("Chargement ...");
            var id = elem.data("id");

            elem.data("load", true);
            this.getDelete(id).done(function (data) {
                elem.data("load", false);
                $(".line-comment-" + id).remove();
                new PNotify({
                    title: 'Succés suppression',
                    text: data.result,
                    type: 'success',
                    styling: 'bootstrap3'
                });
            }).fail(function (data) {
                elem.data("load", false);
                elem.html("X");
                new PNotify({
                    title: 'Erreur suppression',
                    text: data.result,
                    type: 'error',
                    styling: 'bootstrap3'
                });
            });
        }
    },

    showArticleComment: function (elem) {
        if (!this.currentShowComment) {
            var id = elem.data("id");
            var type = elem.data("type");
            var self = this;
            $("#modal-body").html("Chargement ...");

            this.currentShowComment = true;
            this.getArticle(id, type).done(function (data) {
                self.currentShowComment = false;
                $("#modal-body").empty();

                switch (type) {
                    case "avenir":
                        self.insertHeaderModalAvenir(data.result);
                        break;
                    case "flashback":
                        self.insertHeaderModalFlasback(data.result);
                        break;
                    case "photo":
                        self.insertHeaderModalPhoto(data.result);
                        break;
                }
            }).fail(function (data) {
                self.currentShowComment = false;
                new PNotify({
                    title: 'Erreur bouton voir',
                    text: data.result,
                    type: 'error',
                    styling: 'bootstrap3'
                });
            });
        }
    },

    insertHeaderModalAvenir: function (result) {
        var self = this;
        $("<p />", {
            class: "modal-body-titre",
            html: result.titre
        }).appendTo("#modal-body");
        $("<p />", {
            class: "modal-body-description",
            html: result.description
        }).appendTo("#modal-body");

        $("<div />", {
            class: "modal-all-comment",
            id: "all-comment"
        }).appendTo("#modal-body");
        $.each(result.comments, function (i, val) {
            self.insertAllCommentInModal(val);
        });
    },

    insertHeaderModalPhoto: function (result) {
        var self = this;
        $("<img />", {
            class: "modal-body-titre",
            src: result.url,
            html: result.titre
        }).appendTo("#modal-body");
        $("<div />", {
            class: "modal-all-comment",
            id: "all-comment"
        }).appendTo("#modal-body");
        $.each(result.comments, function (i, val) {
            self.insertAllCommentInModal(val);
        });
    },

    insertHeaderModalFlasback: function (result) {
        var self = this;
        $("<p />", {
            class: "modal-body-titre",
            html: result.titre
        }).appendTo("#modal-body");
        $("<p />", {
            class: "modal-body-description",
            html: result.description
        }).appendTo("#modal-body");

        $("<div />", {
            class: "modal-all-comment",
            id: "all-comment"
        }).appendTo("#modal-body");
        $.each(result.comments, function (i, val) {
            self.insertAllCommentInModal(val);
        });
    },

    insertAllCommentInModal: function (val) {
        var textActive = "Actif";
        var classActive = "success";
        var dataActive = 0;
        if (val.active === "0") {
            textActive = "Inactif";
            dataActive = 1;
            classActive = "danger";
        }

        $("<div />", {
            class: "line-comment-" + val.id,
            id: "modal-line-comment" + val.id
        }).appendTo("#all-comment");

        $("<p />", {
            class: "modal-body-comment-name",
            id: "modal-body-comment-name-" + val.id,
            html: val.name
        }).appendTo("#modal-line-comment" + val.id);

        $("<button>", {
            class: "btn btn-danger delete-comment",
            "data-id": val.id,
            text: "X"
        }).appendTo("#modal-body-comment-name-" + val.id);

        $("<button>", {
            class: "btn btn-" + classActive + " change-active change-active-" + val.id,
            "data-id": val.id,
            "data-active": dataActive,
            text: textActive
        }).appendTo("#modal-body-comment-name-" + val.id);

        $("<p />", {
            class: "modal-body-comment-text",
            text: val.text
        }).appendTo("#modal-line-comment" + val.id);

        $("<p />", {
            class: "modal-body-comment-date",
            text: val.created
        }).appendTo("#modal-line-comment" + val.id);
    }
};

$(function () {
    comment.init();
});