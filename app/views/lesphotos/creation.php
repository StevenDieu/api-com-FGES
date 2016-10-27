<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Création d'un album photos</h3>
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
                        <h2>Creation d'un album photos</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br>
                        <form id="form-froala" action="/lesphotos/creation/" method="post" class="form-horizontal form-label-left" >

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Titre de l'évènement<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" name="titre" value="<?php
                                    if (isset($data["lesphotos"])) {
                                        echo $data["lesphotos"]->getTitre();
                                    }
                                    ?>" class="form-control col-md-7 col-xs-12" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Date de l'évènement <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="birthday" name="date" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text" value="<?php
                                    if (isset($data["lesphotos"])) {
                                        echo $data["lesphotos"]->getDate();
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

                <div class="x_panel">

                    <div class="x_title">
                        <h2>Ajouter des photos</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br>
                        <form id="form-froala" action="/lesphotos/ajouterdesphotos/" method="post" class="form-horizontal form-label-left" >

                            <div class="form-group">

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Flashback
                                    </label>
                                    <div  class="col-md-6 col-sm-6 col-xs-12">
                                        <select name="idFlashback" id="selectFlashback" type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
                                            <option value="-1">Choisir un évènement</option>
                                            <?php
                                            if (isset($data["evenements"]) && !empty($data["evenements"])) {
                                                foreach ($data["evenements"] as $evenement) {
                                                    ?>
                                                    <option value="<?php echo $flashbacks["id"]; ?>"><?php echo $flashbacks["titre"]; ?></option>
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
                                    <button type="submit" class="btn btn-primary">Choisir</button>
                                </div>
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
