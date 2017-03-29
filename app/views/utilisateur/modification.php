
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Modification Utilisateur</h3>
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
                <?php if (isset($data["success"]) && isset($data["utilisateur"]["id"]) && !empty($data["utilisateur"]["id"])) { ?>
                    <div class="alert alert-success alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <strong>Succès!</strong> <?php echo $data['success'] ?>
                    </div>
                <?php } ?>
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Modification d'un flashback</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br>

                        <?php if (isset($data["utilisateur"]) && !empty($data["utilisateur"])) { ?>
                            <?php if (isset($data["utilisateur"]["id"]) && !empty($data["utilisateur"]["id"])) { ?>
                                <form id="form-froala" action="/utilisateur/modification/<?php echo $data["utilisateur"]["id"]; ?>" method="post" class="form-horizontal form-label-left" >
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="hidden" name="email" value="<?php echo $data["utilisateur"]["email"]; ?>" />
                                            <label class="form-control col-md-7 col-xs-12" for="first-name"><?php echo $data["utilisateur"]["email"]; ?></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nouveau mot de passe (facultatif)
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="password" name="motdepasse" class="form-control col-md-7 col-xs-12">
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
                                                    if (isset($data["utilisateur"]) && $data["utilisateur"]["avenir"] == 1) {
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
                                                    if (isset($data["utilisateur"]) && $data["utilisateur"]["lesphotos"] == 1) {
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
                                                    if (isset($data["utilisateur"]) && $data["utilisateur"]["flashback"] == 1) {
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
                                                    if (isset($data["utilisateur"]) && $data["utilisateur"]["admin"] == 1) {
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
                                            <a type="submit" href="/utilisateur/liste" class="btn btn-success">Retour</a>
                                            <input type="submit" class="btn btn-success" value="Modifier">
                                        </div>
                                    </div>

                                </form>

                            <?php } else { ?>
                                <div class="alert alert-warning alert-dismissible fade in" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <strong>Attention!</strong> Cette utilisateur n'existe pas ! Pour en créer un cliquer <a href="/utilisateur/creation" >ici</a>
                                </div>
                            <?php } ?>
                        <?php } else { ?>
                            <form class="form-horizontal form-label-left">
                                <div class="form-group">

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Utilisateurs
                                        </label>
                                        <div  class="col-md-6 col-sm-6 col-xs-12">
                                            <select id="selectUtilisateur" type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
                                                <option value="-1">Choisir un utilisateur</option>
                                                <?php
                                                if (isset($data["utilisateurs"]) && !empty($data["utilisateurs"])) {
                                                    foreach ($data["utilisateurs"] as $utilisateurs) {
                                                        ?>
                                                        <option value="<?php echo $utilisateurs["id"]; ?>"><?php echo $utilisateurs["email"]; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <a id="linkNextUtilisateur" type="submit" href="" class="btn btn-success">Suivant</a>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        <?php } ?>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
