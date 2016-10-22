<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Gestion Flashback</h3>
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
                <?php if (isset($data["success"])) { ?>
                    <div class="alert alert-success alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <strong>Succès!</strong> <?php echo $data['success'] ?>
                    </div>
                <?php } ?>
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Creation d'un flashback</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br>
                        <form action="/flashback/creation" method="post" class="form-horizontal form-label-left" >

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Titre <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" name="titre" value="<?php
                                    if (isset($data["flashback"])) {
                                        echo $data["flashback"]->getTitre();
                                    }
                                    ?>" class="form-control col-md-7 col-xs-12" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Description <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea class="form-control" rows="3" name="description"  placeholder="" required=""><?php
                                    if (isset($data["flashback"])) {
                                        echo $data["flashback"]->getDescription();
                                    }
                                    ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Actif <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div id="gender" class="btn-group" data-toggle="buttons">
                                        <input type="radio" name="active" required="" value="1" data-parsley-multiple="actif" <?php
                                    if (isset($data["flashback"]) && $data["flashback"]->getActive() == 1) {
                                        echo "checked";
                                    }
                                    ?>> Oui
                                        <input type="radio" name="active" required="" value="0" data-parsley-multiple="actif" <?php
                                    if ((isset($data["flashback"]) && $data["flashback"]->getActive() == 0) || !isset($data["flashback"])) {
                                        echo "checked";
                                    }
                                    ?>> Non
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Date de l'évènement <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="birthday" name="date" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text" value="<?php
                                    if (isset($data["flashback"])) {
                                        echo $data["flashback"]->getDate();
                                    }
                                    ?>">
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
