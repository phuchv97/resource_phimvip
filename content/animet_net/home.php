<?php 
$totalphim = MySql::dbselect('id','film',"id != 0");
$phim = count($totalphim);
$totaluser = count(MySql::dbselect('id','user',"id != 0"));
$totalvideo = count(MySql::dbselect('id','media',"id != 0"));
$totalep = count(MySql::dbselect('id','episode',"id != 0"));


 ?>
    <header class="content__title">
                    <h1>Dashboard</h1>

                    <div class="actions">
                            <a href="" class="actions__item zmdi zmdi-trending-up"></a>
                            <a href="" class="actions__item zmdi zmdi-check-all"></a>

                            <div class="dropdown actions__item">
                                <i data-toggle="dropdown" class="zmdi zmdi-more-vert"></i>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="" class="dropdown-item">Refresh</a>
                                    <a href="" class="dropdown-item">Manage Widgets</a>
                                    <a href="" class="dropdown-item">Settings</a>
                                </div>
                            </div>
                        </div>
                </header>
             <div class="content__inner">
                <div class="row quick-stats">
                    <div class="col-sm-6 col-md-3">
                        <div class="quick-stats__item" style="background-size: 1593px 896px; background-position: 0px -260px;">
                            <div class="quick-stats__chart"><i class="bi-icon zmdi zmdi-videocam zmdi-hc-fw"></i></div>
                              <div class="quick-stats__info">
                                <h2><?php echo $phim; ?></h2>
                             <small>Phim</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="quick-stats__item" style="background-size: 1593px 896px; background-position: 0px -260px;">
                            <div class="quick-stats__chart"><i class="bi-icon zmdi zmdi-local-movies zmdi-hc-fw"></i></div>
                              <div class="quick-stats__info">
                                <h2><?php echo $totalep; ?></h2>
                                <small>Tập</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="quick-stats__item" style="background-size: 1593px 896px; background-position: 0px -260px;">
                            <div class="quick-stats__chart"><i class="bi-icon zmdi zmdi-caret-right-circle zmdi-hc-fw"></i></div>
                              <div class="quick-stats__info">
                                <h2><?php echo $totalvideo; ?></h2>
                             <small>Video</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-3">
                        <div class="quick-stats__item" style="background-size: 1593px 896px; background-position: 0px -260px;">
                            <div class="quick-stats__chart"><i class="bi-icon zmdi zmdi-accounts zmdi-hc-fw"></i></div>
                              <div class="quick-stats__info">
                                <h2><?php echo $totaluser; ?></h2>
                             <small>Users</small>
                            </div>
                        </div>
                    </div>
                </div>