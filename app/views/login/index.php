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
        <link href="assets/library/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="assets/library/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="assets/library/nprogress/nprogress.css" rel="stylesheet">
        <!-- Animate.css -->
        <link href="assets/library/animate.css/animate.min.css" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="assets/library/css/custom.min.css" rel="stylesheet">

        <link href="assets/css/main.css" rel="stylesheet">

    </head>

    <body class="login">
        <div>
            <a class="hiddenanchor" id="signup"></a>
            <a class="hiddenanchor" id="signin"></a>

            <div class="login_wrapper">
                <div class="animate form login_form">
                    <section class="login_content">
                        <form action="/login" method="post">
                            <h1>Login COM'IN</h1>
                            <?php if (isset($data["error"])) { ?>
                                <div class="alert alert-warning alert-dismissible fade in" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <strong>Attention!</strong> <?php echo $data['error']?>
                                </div>
                            <?php } ?>
                            <div>
                                <input type="text" name="email" class="form-control" placeholder="Adresse email" required="" />
                            </div>
                            <div>
                                <input type="password" name="motdepasse" class="form-control" placeholder="Mot de passe" required="" />
                            </div>
                            <div>
                                <input type="submit" class="btn btn-default submit" value="Connexion" />
                            </div>

                            <div class="clearfix"></div>

                            <div class="separator">

                                <div class="clearfix"></div>
                                <br />

                                <div>
                                    <h1><i class="fa fa-bullhorn"></i> COM'IN</h1>
                                    <p>©2016 All Rights Reserved. Dieu Steven & Mathieu Menet</p>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>

            </div>
        </div>
    </body>
</html>
