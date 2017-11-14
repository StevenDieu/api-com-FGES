<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Modification album photos</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Modification d'un album</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br>

                        <form class="form-horizontal form-label-left">
                            <div class="form-group">

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Album
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select id="selectAlbum" type="text" id="first-name" required="required"
                                                class="form-control col-md-7 col-xs-12">
                                            <option value="-1">Choisir un album pour modifier un album</option>
                                            <?php
                                            if (isset($data["albums"]) && !empty($data["albums"])) {
                                                foreach ($data["albums"] as $albums) {
                                                    ?>
                                                    <option value="<?php echo $albums["id"]; ?>"><?php echo $albums["titre"]; ?></option>
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
                                        <a id="linkNextAlbum" type="submit" href="" class="btn btn-success">Suivant</a>
                                    </div>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Ajout/Suppression des photos dans un album</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br>

                        <form class="form-horizontal form-label-left">
                            <div class="form-group">

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Album
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select id="selectPhotos" type="text" id="first-name" required="required"
                                                class="form-control col-md-7 col-xs-12">
                                            <option value="-1">Choisir un album pour l'ajout de photos</option>
                                            <?php
                                            if (isset($data["albums"]) && !empty($data["albums"])) {
                                                foreach ($data["albums"] as $albums) {
                                                    ?>
                                                    <option value="<?php echo $albums["id"]; ?>"><?php echo $albums["titre"]; ?></option>
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
                                        <a id="linkNextPhotos" type="submit" href="" class="btn btn-success">Suivant</a>
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
