<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Modification Flashback</h3>
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
                <?php if (isset($data["success"]) && isset($data["flashback"]["id"]) && !empty($data["flashback"]["id"])) { ?>
                    <div class="alert alert-success alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">×</span>
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

                        <?php if (isset($data["flashback"]) && !empty($data["flashback"])) { ?>
                            <?php if (isset($data["flashback"]["id"]) && !empty($data["flashback"]["id"])) { ?>
                            <script type="text/javascript">
                                var nextId = <?php echo $data["flashback"]["id"]; ?>
                            </script>
                            <form id="form-froala"
                                  action="/flashback/modification/<?php echo $data["flashback"]["id"]; ?>"
                                  class="form-horizontal form-label-left" method="post">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Titre
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="first-name" name="titre" value="<?php
                                            if (isset($data["flashback"])) {
                                                echo $data["flashback"]["titre"];
                                            }
                                            ?>" class="form-control col-md-7 col-xs-12" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Description
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <textarea id="edit" name="content"></textarea>
                                            <input type="hidden" id="description" name="description" value="<?php
                                            if (isset($data["flashback"])) {
                                                echo htmlspecialchars($data["flashback"]["description"]);
                                            }
                                            ?>"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Date de l'évènement
                                            <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="birthday" name="date"
                                                   class="date-picker form-control col-md-7 col-xs-12"
                                                   required="required" type="text" value="<?php
                                            if (isset($data["flashback"])) {
                                                echo $data["flashback"]["date_debut"];
                                            }
                                            ?>">
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
                                                        if (isset($data["flashback"]) && $data["flashback"]["active"] == 1) {
                                                            echo "checked";
                                                        }
                                                        ?>> Oui
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="active" required="" value="0"
                                                               data-parsley-multiple="actif" <?php
                                                        if ((isset($data["flashback"]) && $data["flashback"]["active"] == 0) || !isset($data["flashback"])) {
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
                                            <a type="submit" href="/flashback/liste" class="btn btn-success">Retour</a>
                                            <input type="submit" class="btn btn-success" value="Modifier">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        <?php } else { ?>
                            <div class="alert alert-warning alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                            aria-hidden="true">×</span>
                                </button>
                                <strong>Attention!</strong> Ce flasback n'existe pas ! Pour en créer un cliquer <a
                                        href="/flashback/creation">ici</a>
                            </div>
                        <?php } ?>
                        <?php } else { ?>
                            <form class="form-horizontal form-label-left">
                                <div class="form-group">

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Flashback
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select id="selectFlashback" type="text" id="first-name" required="required"
                                                    class="form-control col-md-7 col-xs-12">
                                                <option value="-1">Choisir un flashback</option>
                                                <?php
                                                if (isset($data["flashbacks"]) && !empty($data["flashbacks"])) {
                                                    foreach ($data["flashbacks"] as $flashbacks) {
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
                                            <a id="linkNextFlashback" type="submit" href="" class="btn btn-success">Suivant</a>
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
