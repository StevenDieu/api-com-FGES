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
                        <h2>Liste des flashback</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <form action="/flashback/suppression" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" method="post">
                            <div class="form-group">

                                <br>
                                <?php if (isset($data["flashbacks"]) && !empty($data["flashbacks"])) { ?>
                                    <div class="table-responsive">
                                        <table class="table table-striped jambo_table bulk_action">
                                            <thead>
                                                <tr class="headings">
                                                    <th class="column-title">Titre </th>
                                                    <th class="column-title">Date </th>
                                                    <th class="column-title center-text">Active </th>
                                                    <th class="column-title no-link last center-text"><span class="nobr">Action</span>
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                foreach ($data["flashbacks"] as $flashback) {
                                                    ?>
                                                    <tr class="even pointer">
                                                        <td class=" "><?php echo $flashback["titre"]; ?></td>
                                                        <td class=" "><?php echo $flashback["date_debut"]; ?></td>
                                                        <td class="center-text">
                                                            <?php if ($flashback["active"]) { ?> 
                                                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                                            <?php } else { ?>
                                                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>                                                
                                                            <?php } ?>
                                                        </td>
                                                        <td class=" last center-text"><a href="/flashback/liste/<?php echo $flashback["id"] ?>">Visionner</a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php } else if (isset($data["flashback"]) && isset($data["flashback"]["id"])) { ?>

                                    <h1 class="center-text"><?php echo $data["flashback"]["titre"]; ?></h1>

                                    <div class="center-auto">
                                        <div class="col-md-6 col-sm-6 col-xs-12 center-auto fr-view">
                                            <br/>
                                            <strong>Date :</strong> <?php echo $data["flashback"]["date_debut"]; ?>
                                            <br/>
                                            <strong>Active :</strong>
                                            <?php if ($data["flashback"]["active"]) { ?> 
                                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                            <?php } else { ?>
                                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>                                                
                                            <?php } ?>
                                            <br/>
                                            <strong>Description :</strong><br/><br/>
                                            <?php echo $data["flashback"]["description"]; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <a type="submit" href="/flashback/liste/" class="btn btn-default">Retour</a>
                                        <a type="submit" href="/flashback/modification/<?php echo $data["flashback"]["id"]; ?>" class="btn btn-warning">Modifer</a>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="alert alert-warning alert-dismissible fade in" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <strong>Attention!</strong> Ce flasback n'existe pas ! Pour en créer un cliquer <a href="/flashback/creation" >ici</a>
                                </div>
                            <?php } ?>


                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- /page content -->
