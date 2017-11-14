<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Gestion commentaire flashback</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="x_panel">
                    <div class="x_title">
                        <h2>liste commentaire de : flashback</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <a href="/flashback/commentaire"
                           class="btn <?php if (isset($data["classFilter"]) && $data["classFilter"] == 'ALL') {
                               echo "btn-primary";
                           } ?>">
                            Tous
                        </a>
                        <a href="/flashback/commentaire/1"
                           class="btn <?php if (isset($data["classFilter"]) && $data["classFilter"] == 'ACTIF') {
                               echo "btn-primary";
                           } ?>">
                            Actif
                        </a>
                        <a href="/flashback/commentaire/0"
                           class="btn <?php if (isset($data["classFilter"]) && $data["classFilter"] == 'INACTIF') {
                               echo "btn-primary";
                           } ?>">
                            Inactif
                        </a>
                        <br/><br/>
                        <button class="btn btn-default dropdown-toggle" onclick="PNotify.removeAll();">Retirer les
                            notifications
                        </button>
                        <br/><br/>
                        <?php if (isset($data["comments"]) && !empty($data["comments"])) { ?>
                            <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                    <tr class="headings">
                                        <th class="column-title">Titre</th>
                                        <th class="column-title">Prenom Nom</th>
                                        <th class="column-title" style="width: 50%;">Commentaire</th>
                                        <th class="column-title center-text">Jour de création</th>
                                        <th class="column-title center-text">Active</th>
                                        <th class="column-title no-link last center-text"><span
                                                    class="nobr">Action</span>
                                        <th class="column-title no-link last center-text"><span
                                                    class="nobr">Suppression</span>
                                        </th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php
                                    foreach ($data["comments"] as $comment) {
                                        ?>
                                        <tr class="even pointer line-comment-<?php echo $comment["id"]; ?>">
                                            <td class=" "><?php echo $comment["titre"]; ?></td>
                                            <td class=" "><?php echo $comment["name"]; ?></td>
                                            <td class=" "><?php echo $comment["text"]; ?></td>
                                            <td class="center-text"><?php echo $comment["created"]; ?></td>

                                            <td class="center-text">
                                                <?php if ($comment["active"]) { ?>
                                                    <button class="btn btn-success change-active change-active-<?php echo $comment["id"]; ?>"
                                                            data-id="<?php echo $comment["id"]; ?>" data-active="0">
                                                        Actif
                                                    </button>
                                                <?php } else { ?>
                                                    <button class="btn btn-danger change-active change-active-<?php echo $comment["id"]; ?>"
                                                            data-id="<?php echo $comment["id"]; ?>" data-active="1">
                                                        Inactif
                                                    </button>
                                                <?php } ?>
                                            </td>
                                            <td class="center-text">
                                                <button type="button" class="btn btn-primary show-article-comment"
                                                        data-id="<?php echo $comment["idType"]; ?>"
                                                        data-type="flashback" data-toggle="modal"
                                                        data-target=".bs-example-modal-lg">Voir
                                                </button>
                                            </td>
                                            <td class="center-text">
                                                <button class="btn btn-danger delete-comment"
                                                        data-id="<?php echo $comment["id"]; ?>">X
                                                </button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php } else { ?>
                            <div class="alert alert-warning alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                            aria-hidden="true">×</span></button>
                                <strong>Attention !</strong> Aucun commentaire existe !
                            </div>
                        <?php } ?>
                        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true"
                             style="display: none;">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span
                                                    aria-hidden="true">×</span>
                                        </button>
                                        <h4 class="modal-title" id="myModalLabel">Commentaire : flashback</h4>
                                    </div>
                                    <div class="modal-body" id="modal-body">

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
