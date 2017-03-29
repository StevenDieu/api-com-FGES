<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Ajou/Suppression des photos dans un album</h3>
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
                <?php if (isset($data["success"]) && isset($data["album"]["id"]) && !empty($data["album"]["id"])) { ?>
                    <div class="alert alert-success alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <strong>Succès!</strong> <?php echo $data['success'] ?>
                    </div>
                <?php } ?>
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Ajout/Suppression des photos dans un album</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <?php if (isset($data["album"]) && !empty($data["album"]) && isset($data["album"]["id"]) && !empty($data["album"]["id"])) { ?>
                            <script type="text/javascript">
                                var idAlbum = <?php echo $data["album"]["id"]; ?>
                            </script>
                            <p>Faites glisser plusieurs fichiers dans la case ci-dessous pour le multi-téléchargement d'images ou cliquez dessus pour sélectionner des images.</p>
                            <div class="form-group">
                                <form action="form_upload.html" id="ajouterImageAlbum" class="dropzone dz-clickable">
                                    <div class="dz-default dz-message">
                                        <span>Glisser les images ici pour télécharger</span>
                                    </div>
                                </form>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action">
                                    <thead>
                                        <tr class="headings">
                                            <th class="center-text column-title">Photo </th>
                                            <th class="column-title no-link last"><span class="nobr">Action</span>
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody id="all-photos">
                                        <?php
                                        if (isset($data["photos"]) && !empty($data["photos"])) {
                                            foreach ($data["photos"] as $photo) {
                                                ?>
                                                <tr class="even pointer" id="<?php echo $photo["id"]; ?>">
                                                    <td class="center-text"><img class="image-photos" src="<?php echo "http://".$_SERVER['HTTP_HOST'].$photo["url"]; ?>" /></td>
                                                    <td class="last"><button data-id="<?php echo $photo["id"]; ?>" class="btn btn-danger supprimerImage">Supprimer</button>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group">
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <a type="submit" href="/lesphotos/liste" class="btn btn-success">Retour</a>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="alert alert-warning alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                                </button>
                                <strong>Attention!</strong> Cette album n'existe pas ! Pour en créer un cliquer <a href="/lesphotos/creation" >ici</a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
