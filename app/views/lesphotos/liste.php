<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Liste albums</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Liste des albums</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <div class="form-group">

                            <br>
                            <?php if (isset($data["albums"]) && !empty($data["albums"])) { ?>
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
                                            foreach ($data["albums"] as $album) {
                                                ?>
                                                <tr class="even pointer">
                                                    <td class=" "><?php echo $album["titre"]; ?></td>
                                                    <td class=" "><?php echo $album["date_debut"]; ?></td>
                                                    <td class="center-text">
                                                        <?php if ($album["active"]) { ?> 
                                                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                                        <?php } else { ?>
                                                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>                                                
                                                        <?php } ?>
                                                    </td>
                                                    <td class=" last center-text"><a href="/lesphotos/modificationPhotos/<?php echo $album["id"] ?>">Visionner photos</a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
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
