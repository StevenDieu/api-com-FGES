<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Liste Utilisateur</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Liste des utilisateus</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <div class="form-group">

                            <br>
                            <?php if (isset($data["utilisateurs"]) && !empty($data["utilisateurs"])) { ?>
                                <div class="table-responsive">
                                    <table class="table table-striped jambo_table bulk_action">
                                        <thead>
                                            <tr class="headings">
                                                <th class="column-title">Email </th>
                                                <th class="column-title center-text">Droit d'accés A venir </th>
                                                <th class="column-title center-text">Droit d'accés Les photos </th>
                                                <th class="column-title center-text">Droit d'accés Flashback </th>
                                                <th class="column-title center-text">Droit d'accés Admin </th>
                                                <th class="column-title no-link last center-text"><span class="nobr">Action</span>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            foreach ($data["utilisateurs"] as $utilisateur) {
                                                ?>
                                                <tr class="even pointer">
                                                    <td class=" "><?php echo $utilisateur["email"]; ?></td>
                                                    <td class="center-text">
                                                        <?php if ($utilisateur["avenir"]) { ?> 
                                                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                                        <?php } else { ?>
                                                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>                                                
                                                        <?php } ?>
                                                    </td>
                                                    <td class="center-text">
                                                        <?php if ($utilisateur["lesphotos"]) { ?> 
                                                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                                        <?php } else { ?>
                                                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>                                                
                                                        <?php } ?>
                                                    </td>
                                                    <td class="center-text">
                                                        <?php if ($utilisateur["flashback"]) { ?> 
                                                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                                        <?php } else { ?>
                                                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>                                                
                                                        <?php } ?>
                                                    </td>
                                                     <td class="center-text">
                                                        <?php if ($utilisateur["admin"]) { ?> 
                                                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                                        <?php } else { ?>
                                                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>                                                
                                                        <?php } ?>
                                                    </td>
                                                    <td class=" last center-text"><a href="/utilisateur/modification/<?php echo $utilisateur["id"] ?>">Modifier</a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } else { ?>
                            <div class="alert alert-warning alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                <strong>Attention!</strong> Aucun utilisateurs existent ! Pour en créer un cliquer <a href="/utilisateur/creation" >ici</a>
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
