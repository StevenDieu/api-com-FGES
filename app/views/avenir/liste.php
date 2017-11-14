<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Liste Flashback</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Liste des à venir</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <div class="form-group">

                            <br>
                            <?php if (isset($data["avenirs"]) && !empty($data["avenirs"])) { ?>
                                <div class="table-responsive">
                                    <table class="table table-striped jambo_table bulk_action">
                                        <thead>
                                        <tr class="headings">
                                            <th class="column-title">Titre</th>
                                            <th class="column-title">Date debut</th>
                                            <th class="column-title">Date fin</th>
                                            <th class="column-title center-text">Active</th>
                                            <th class="column-title no-link last center-text"><span
                                                        class="nobr">Action</span>
                                            </th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php
                                        foreach ($data["avenirs"] as $avenir) {
                                            ?>
                                            <tr class="even pointer">
                                                <td class=" "><?php echo $avenir["titre"]; ?></td>
                                                <td class=" "><?php echo $avenir["date_debut"]; ?></td>
                                                <td class=" "><?php echo $avenir["date_fin"]; ?></td>
                                                <td class="center-text">
                                                    <?php if ($avenir["active"]) { ?>
                                                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                                    <?php } else { ?>
                                                        <span class="glyphicon glyphicon-remove"
                                                              aria-hidden="true"></span>
                                                    <?php } ?>
                                                </td>
                                                <td class=" last center-text"><a
                                                            href="/avenir/modification/<?php echo $avenir["id"] ?>">Modifier</a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } else { ?>
                                <div class="alert alert-warning alert-dismissible fade in" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                                aria-hidden="true">×</span>
                                    </button>
                                    <strong>Attention!</strong> Aucun à venir existe ! Pour en créer un cliquer <a
                                            href="/avenir/creation">ici</a>
                                </div>
                            <?php } ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
