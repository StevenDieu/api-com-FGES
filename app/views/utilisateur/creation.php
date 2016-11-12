<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Gestion Utilisateur</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <?php if (isset($data["error"])) { ?>
                    <div class="alert alert-warning alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <strong>Attention!</strong> <?php echo $data['error'] ?>
                    </div>
                <?php } ?>
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Creation d'un utilisateur</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br>
                        <form id="form-froala" action="/utilisateur/creation/" method="post" class="form-horizontal form-label-left" >

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="email" name="email" value="<?php
                                    if (isset($data["utilisateur"])) {
                                        echo $data["utilisateur"]->getEmail();
                                    }
                                    ?>" class="form-control col-md-7 col-xs-12" required="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Mot de passe <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="password" name="motdepasse" value="<?php
                                    if (isset($data["utilisateur"])) {
                                        echo $data["utilisateur"]->getMotdepasse();
                                    }
                                    ?>" class="form-control col-md-7 col-xs-12" required="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Droit d'accés <span class="required">*</span>
                                </label>

                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="avenir" value="1"
                                            <?php
                                            if (isset($data["utilisateur"]) && $data["utilisateur"]->getAvenir() == 1) {
                                                echo "checked";
                                            }
                                            ?>
                                                   > A venir
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="lesphotos" value="1"
                                            <?php
                                            if (isset($data["utilisateur"]) && $data["utilisateur"]->getLesphotos() == 1) {
                                                echo "checked";
                                            }
                                            ?>
                                                   > Les photos
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="flashback" value="1"
                                            <?php
                                            if (isset($data["utilisateur"]) && $data["utilisateur"]->getFlashback() == 1) {
                                                echo "checked";
                                            }
                                            ?>
                                                   > Flashback
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="admin" value="1"
                                            <?php
                                            if (isset($data["utilisateur"]) && $data["utilisateur"]->getAdmin() == 1) {
                                                echo "checked";
                                            }
                                            ?>
                                                   > Admin
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <input type="submit" class="btn btn-success" value="Ajouter">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
