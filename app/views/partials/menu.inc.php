<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="/" class="site_title"><i class="fa fa-bullhorn"></i> <span>COM'IN</span></a>
                </div>

                <div class="clearfix"></div>
                <br/>

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>General</h3>
                        <ul class="nav side-menu">
                            <?php if ($_SESSION["LOGIN"]["admin"] || $_SESSION["LOGIN"]["avenir"]) { ?>
                                <li class="">
                                    <a><i class="fa fa-plus"></i> A venir ... <span
                                                class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="/avenir/liste">Liste à venir</a></li>
                                        <li><a href="/avenir/creation">Création à venir</a></li>
                                        <li><a href="/avenir/modification">Modification à venir</a></li>
                                        <li><a href="/avenir/suppression">Suppression à venir</a></li>
                                        <li><a href="/avenir/commentaire">Commentaire à venir
                                                <b>(<?php echo $data["countCommentInatifAvenir"]; ?>)</b></a></li>
                                    </ul>
                                </li>
                            <?php } ?>
                            <?php if ($_SESSION["LOGIN"]["admin"] || $_SESSION["LOGIN"]["lesphotos"]) { ?>
                                <li class="">
                                    <a><i class="fa fa-picture-o"></i> Les photos <span
                                                class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="/lesphotos/liste">Liste albums photos</a></li>
                                        <li><a href="/lesphotos/creation">Création albums photos</a></li>
                                        <li><a href="/lesphotos/modification">Modification albums photos</a></li>
                                        <li><a href="/lesphotos/suppression">Suppression albums photos</a></li>
                                        <li><a href="/lesphotos/commentaire">Commentaire photo
                                                <b>(<?php echo $data["countCommentInatifPhoto"]; ?>)</b></a></li>
                                    </ul>
                                </li>
                            <?php } ?>
                            <?php if ($_SESSION["LOGIN"]["admin"] || $_SESSION["LOGIN"]["flashback"]) { ?>
                                <li class="">
                                    <a><i class="fa fa-reply"></i> Flashback <span
                                                class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="/flashback/liste">Liste flashback</a></li>
                                        <li><a href="/flashback/creation">Création flashback</a></li>
                                        <li><a href="/flashback/modification">Modification flashback</a></li>
                                        <li><a href="/flashback/suppression">Suppression flashback</a></li>
                                        <li><a href="/flashback/commentaire">Commentaire flashback
                                                <b>(<?php echo $data["countCommentInatifFlashback"]; ?>)</b></a></li>
                                    </ul>
                                </li>
                            <?php } ?>
                            <?php if ($_SESSION["LOGIN"]["admin"]) { ?>
                                <li class="">
                                    <a><i class="fa fa-user"></i> Utilisateur <span
                                                class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="/utilisateur/liste">Liste utilisateur</a></li>
                                        <li><a href="/utilisateur/creation">Création utilisateur</a></li>
                                        <li><a href="/utilisateur/modification">Modification utilisateur</a></li>
                                        <li><a href="/utilisateur/suppression">Suppression utilisateur</a></li>

                                    </ul>
                                </li>
                            <?php } ?>
                            <li class="">
                                <a href="/notification"><i class="fa fa-comment"></i> Notification </a>
                            </li>
                        </ul>
                    </div>

                </div>
                <!-- /sidebar menu -->

            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="/login/disconnect" class="user-profile">
                                Se déconnecter
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->