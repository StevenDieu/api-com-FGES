<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Gestion a venir</h3>
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
                        <h2>Creation d'un a venir</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br>
                        <form id="form-froala" action="/avenir/creation/" method="post" class="form-horizontal form-label-left" >

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Titre <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" name="titre" value="<?php
                                    if (isset($data["avenir"])) {
                                        echo $data["avenir"]->getTitre();
                                    }
                                    ?>" class="form-control col-md-7 col-xs-12" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Description <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea id="edit" class="form-control col-md-7 col-xs-12" name="description"><?php
                                        if (isset($data["avenir"])) {
                                            echo $data["avenir"]->getDescription();
                                        }
                                        ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Date de début <span class="required">*</span>
                                </label>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <input id="datedebut" name="dateDebut" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text" value="<?php
                                    if (isset($data["avenir"])) {
                                        echo $data["avenir"]->getDateDebut();
                                    }
                                    ?>">
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-12">

                                    <select class="form-control col-md-7 col-xs-12" name="dateDebutHeure">
                                        <?php for ($hours = 0; $hours <= 23; $hours++) { ?>
                                            <option value="<?php echo $hours; ?>"><?php echo $hours; ?> Heure </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <select class="form-control col-md-7 col-xs-12" name="dateDebutMinute">
                                        <?php for ($minute = 00; $minute <= 59; $minute++) { ?>
                                            <option value="<?php echo $minute; ?>"><?php echo $minute; ?> Minute </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Date de fin <span class="required">*</span>
                                </label>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <input id="datefin" name="dateFin" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text" value="<?php
                                    if (isset($data["avenir"])) {
                                        echo $data["avenir"]->getDateFin();
                                    }
                                    ?>">
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <select class="form-control col-md-7 col-xs-12" name="dateFinMinute">
                                        <?php for ($hours = 0; $hours <= 23; $hours++) { ?>
                                            <option value="<?php echo $hours; ?>"><?php echo $hours; ?> Heure </option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-12">
                                    <select class="form-control col-md-7 col-xs-12" name="dateFinHeure">
                                        <?php for ($minute = 00; $minute <= 59; $minute++) { ?>
                                            <option value="<?php echo $minute; ?>"><?php echo $minute; ?> Minute </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Lieu <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" name="lieu" value="<?php
                                    if (isset($data["avenir"])) {
                                        echo $data["avenir"]->getLieu();
                                    }
                                    ?>" class="form-control col-md-7 col-xs-12" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Actif <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div id="gender" class="btn-group" data-toggle="buttons">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="active" required="" value="1" data-parsley-multiple="actif" <?php
                                                if (isset($data["avenir"]) && $data["avenir"]->getActive() == 1) {
                                                    echo "checked";
                                                }
                                                ?>> Oui
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="active" required="" value="0" data-parsley-multiple="actif" <?php
                                                if ((isset($data["avenir"]) && $data["avenir"]->getActive() == 0) || !isset($data["avenir"])) {
                                                    echo "checked";
                                                }
                                                ?>> Non
                                            </label>
                                        </div>
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
