<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo $data['title'] ?> – COM'IN</title>

        <!-- Bootstrap -->
        <link href="/assets/library/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="/assets/library/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="/assets/library/nprogress/nprogress.css" rel="stylesheet">
        <!-- iCheck -->
        <link href="/assets/library/iCheck/skins/flat/green.css" rel="stylesheet">
        <!-- bootstrap-wysiwyg -->
        <link href="/assets/library/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
        <!-- Select2 -->
        <link href="/assets/library/select2/dist/css/select2.min.css" rel="stylesheet">
        <!-- Switchery -->
        <link href="/assets/library/switchery/dist/switchery.min.css" rel="stylesheet">
        <!-- starrr -->
        <link href="/assets/library/starrr/dist/starrr.css" rel="stylesheet">
        <!-- bootstrap-daterangepicker -->
        <link href="/assets/library/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

        <link href="/assets/library/dropzone/dist/min/dropzone.min.css" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="/assets/library/css/custom.min.css" rel="stylesheet">


        <link href="/assets/css/main.css" rel="stylesheet">
        <?php if ((isset($data["froala"]) && $data["froala"] == true)) {
            ?>
            <!-- Include Font Awesome. -->
            <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

            <!-- Include Editor style. -->
            <link href="/assets/library/froala/css/froala_editor.min.css" rel="stylesheet" type="text/css" />
            <link href="/assets/library/froala/css/froala_style.min.css" rel="stylesheet" type="text/css" />

            <!-- Include Code Mirror style -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css">

            <!-- Include Editor Plugins style. -->
            <link rel="stylesheet" href="/assets/library/froala/css/plugins/char_counter.css">
            <link rel="stylesheet" href="/assets/library/froala/css/plugins/code_view.css">
            <link rel="stylesheet" href="/assets/library/froala/css/plugins/colors.css">
            <link rel="stylesheet" href="/assets/library/froala/css/plugins/emoticons.css">
            <link rel="stylesheet" href="/assets/library/froala/css/plugins/file.css">
            <link rel="stylesheet" href="/assets/library/froala/css/plugins/fullscreen.css">
            <link rel="stylesheet" href="/assets/library/froala/css/plugins/image.css">
            <link rel="stylesheet" href="/assets/library/froala/css/plugins/image_manager.css">
            <link rel="stylesheet" href="/assets/library/froala/css/plugins/line_breaker.css">
            <link rel="stylesheet" href="/assets/library/froala/css/plugins/quick_insert.css">
            <link rel="stylesheet" href="/assets/library/froala/css/plugins/table.css">
            <link rel="stylesheet" href="/assets/library/froala/css/plugins/video.css">

            <?php
        } else if (isset($data["arrayCss"])) {
            foreach ($data["arrayCss"] as $fileCss) {
                ?>
                <link rel="stylesheet" href="/assets/css/<?php echo $fileCss; ?>.css">
                <?php
            }
        } else if (isset($data["viewerFroala"]) && $data["viewerFroala"] == true) {
            ?>
            <link href="/assets/library/froala/css/froala_style.min.css" rel="stylesheet" type="text/css" />
            <?php
        }
        ?>

    </head>

    <body class="nav-md">