<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login - COM'IN</title>

    <!-- Bootstrap -->
    <link href="/assets/library/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/assets/library/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="/assets/library/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="/assets/library/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="/assets/library/css/custom.min.css" rel="stylesheet">

    <link href="/assets/css/main.css" rel="stylesheet">

</head>

<body class="center">
<div class="container">
    <div class="col-md-5 center-col">
        <div class="form-area">
            <form role="form" action="/assistance" method="POST">
                <br style="clear:both">
                <h3 style="margin-bottom: 25px; text-align: center;">Assistance COM'IN</h3>
                <?php if (!empty($data["class"])) { ?>
                    <div class="alert alert-<?php echo $data["class"]; ?> alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">×</span>
                        </button>
                        <?php echo $data["message"]; ?>
                    </div>
                <?php } ?>
                <div class="form-group">
                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Nom" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Prenom" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Sujet" required>
                </div>
                <div class="form-group">
                    <textarea class="form-control" type="textarea" name="message" id="message" placeholder="Message"
                              rows="7"></textarea>
                </div>

                <button type="submit" id="submit" name="submit" class="btn btn-primary pull-right">Envoyer</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
