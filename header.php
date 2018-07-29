<header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                                
                            </form>
                            <div class="header-button">
                                <div class="noti-wrap">
                                    <a href="rcon/serverReset.php" target="_blank"><button type="button" class="btn btn-primary">
                                            <i class="fa fa-rss"></i>&nbsp; Server Reset</button></a>&nbsp;&nbsp;&nbsp;
											<a href="rcon/serverKapat.php" target="_blank"><button type="button" class="btn btn-danger">
                                            <i class="fa fa-rss"></i>&nbsp; Server Kapat</button></a>&nbsp;&nbsp;&nbsp;
											<a href="rcon/serverAc.php" target="_blank"><button type="button" class="btn btn-success">
											<i class="fa fa-rss"></i>&nbsp; Server Aç</button></a>&nbsp;&nbsp;&nbsp;
											<a href="rcon/cacheTemizle.php" target="_blank"><button type="button" class="btn btn-warning">
											<i class="fa fa-rss"></i>&nbsp; Cache Temizle</button></a>&nbsp;&nbsp;&nbsp;
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <?php echo  '<img src="'.$steamprofile['avatarfull'].'" />'; ?>
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#"><?php echo $steamprofile['personaname']; ?></a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <?php echo  '<img src="'.$steamprofile['avatarfull'].'" />'; ?>
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#"><?php echo $steamprofile['personaname']; ?></a>
                                                    </h5>
                                                    
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-account"></i>Hesabım</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="#">
                                                    <?php logoutbutton(); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>