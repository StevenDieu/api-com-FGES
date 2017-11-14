<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Modification à venir</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <?php if (isset($data["error"])) { ?>
                    <div class="alert alert-warning alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">×</span>
                        </button>
                        <strong>Attention!</strong> <?php echo $data['error'] ?>
                    </div>
                <?php } ?>
                <?php if (isset($data["success"]) && isset($data["avenir"]["id"]) && !empty($data["avenir"]["id"])) { ?>
                    <div class="alert alert-success alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">×</span>
                        </button>
                        <strong>Succès!</strong> <?php echo $data['success'] ?>
                    </div>
                <?php } ?>
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Modification à venir</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br>

                        <?php if (isset($data["avenir"]) && !empty($data["avenir"])) { ?>
                            <?php if (isset($data["avenir"]["id"]) && !empty($data["avenir"]["id"])) { ?>
                                <form action="/avenir/modification/<?php echo $data["avenir"]["id"]; ?>"
                                      class="form-horizontal form-label-left" method="post">
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Titre
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="first-name" name="titre" value="<?php
                                            if (isset($data["avenir"])) {
                                                echo $data["avenir"]["titre"];
                                            }
                                            ?>" class="form-control col-md-7 col-xs-12" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Description
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <textarea id="edit" class="form-control col-md-7 col-xs-12"
                                                      name="description"><?php
                                                if (isset($data["avenir"])) {
                                                    echo $data["avenir"]["description"];
                                                }
                                                ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Date de début <span
                                                    class="required">*</span>
                                        </label>
                                        <div class="col-md-2 col-sm-2 col-xs-12">
                                            <input id="datedebut" name="dateDebut"
                                                   class="date-picker form-control col-md-7 col-xs-12"
                                                   required="required" type="text" value="<?php
                                            if (isset($data["avenir"])) {
                                                echo $data["avenir"]["date_debut"];
                                            }
                                            ?>">
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-12">
                                            <select class="form-control col-md-7 col-xs-12" name="dateDebutHeure">
                                                <?php for ($hours = 0; $hours <= 23; $hours++) { ?>
                                                    <option value="<?php echo $hours; ?>" <?php if (isset($data["avenir"]["date_debut_heure"]) && $data["avenir"]["date_debut_heure"] == $hours) { ?> selected <?php } ?>><?php echo $hours; ?>
                                                        Heure
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-12">
                                            <select class="form-control col-md-7 col-xs-12" name="dateDebutMinute">
                                                <?php for ($minute = 00; $minute <= 59; $minute++) { ?>
                                                    <option value="<?php echo $minute; ?>" <?php if (isset($data["avenir"]["date_debut_minute"]) && intval($data["avenir"]["date_debut_minute"]) == $minute) { ?> selected <?php } ?>><?php echo $minute; ?>
                                                        Minute
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Date de fin <span
                                                    class="required">*</span>
                                        </label>
                                        <div class="col-md-2 col-sm-2 col-xs-12">
                                            <input id="datefin" name="dateFin"
                                                   class="date-picker form-control col-md-7 col-xs-12"
                                                   required="required" type="text" value="<?php
                                            if (isset($data["avenir"])) {
                                                echo $data["avenir"]["date_fin"];
                                            }
                                            ?>">
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-12">
                                            <select class="form-control col-md-7 col-xs-12" name="dateFinHeure">
                                                <?php for ($hours = 0; $hours <= 23; $hours++) { ?>
                                                    <option value="<?php echo $hours; ?>" <?php if (isset($data["avenir"]["date_fin_heure"]) && $data["avenir"]["date_fin_heure"] == $hours) { ?> selected <?php } ?>><?php echo $hours; ?>
                                                        Heure
                                                    </option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-12">
                                            <select class="form-control col-md-7 col-xs-12" name="dateFinMinute">
                                                <?php for ($minute = 00; $minute <= 59; $minute++) { ?>
                                                    <option value="<?php echo $minute; ?>" <?php if (isset($data["avenir"]["date_fin_minute"]) && $data["avenir"]["date_fin_minute"] == $minute) { ?> selected <?php } ?>><?php echo $minute; ?>
                                                        Minute
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Lieu
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="first-name" name="lieu" value="<?php
                                            if (isset($data["avenir"])) {
                                                echo $data["avenir"]["lieu"];
                                            }
                                            ?>" class="form-control col-md-7 col-xs-12" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Actif <span
                                                    class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div id="gender" class="btn-group" data-toggle="buttons">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="active" required="" value="1"
                                                               data-parsley-multiple="actif" <?php
                                                        if (isset($data["avenir"]) && $data["avenir"]["active"] == 1) {
                                                            echo "checked";
                                                        }
                                                        ?>> Oui
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="active" required="" value="0"
                                                               data-parsley-multiple="actif" <?php
                                                        if ((isset($data["avenir"]) && $data["avenir"]["active"] == 0) || !isset($data["avenir"])) {
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
                                            <a type="submit" href="/avenir/liste" class="btn btn-success return-page">Retour</a>
                                            <input type="submit" class="btn btn-success" value="Modifier">
                                        </div>
                                    </div>
                                </form>
                            <?php } else { ?>
                                <div class="alert alert-warning alert-dismissible fade in" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                aria-hidden="true">×</span>
                                    </button>
                                    <strong>Attention!</strong> Cette à venir n'existe pas ! Pour en créer un cliquer <a
                                            href="/avenir/creation">ici</a>
                                </div>
                            <?php } ?>
                        <?php } else { ?>
                            <form class="form-horizontal form-label-left">
                                <div class="form-group">

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">A
                                            venir
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select id="selectAvenir" type="text" id="first-name" required="required"
                                                    class="form-control col-md-7 col-xs-12">
                                                <option value="-1">Choisir un à venir</option>
                                                <?php
                                                if (isset($data["avenirs"]) && !empty($data["avenirs"])) {
                                                    foreach ($data["avenirs"] as $avenirs) {
                                                        ?>
                                                        <option value="<?php echo $avenirs["id"]; ?>"><?php echo $avenirs["titre"]; ?></option>
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
                                            <a id="linkNextAvenir" type="submit" href=""
                                               class="btn btn-success">Suivant</a>
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
