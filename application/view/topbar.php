<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="brand" href="<?php echo Helper_Url::create() ?>">Re:admin</a>

            <div class="nav-collapse">
                <ul class="nav pull-right">
                    <li id="fat-menu" class="dropdown">
                        <a href="#" id="database" value="<?php echo Request::factory()->getDb() ?>" class="dropdown-toggle" data-toggle="dropdown">Database: 0<b class="caret"></b></a>
                        <ul class="dropdown-menu database">
                            <?php
                            for ($i = 0; $i < Config::get('databases'); $i++) {
                                $count = isset($dbkeys[$i]) ? number_format($dbkeys[$i]) : 0;
                                echo '<li><a var-id="' . $i . '">' . $i . ' — ' . $count . '  keys</a></li>';
                            }
                            ?>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user icon-white"></i><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="" class="disabled"><?php echo (isset($_SESSION['login']) ? $_SESSION['login'] : '') . '@' .Config::get('host') . ':' . Config::get('port') ?></a></li>
                            <li class="divider"></li>
                            <li><a class="cmd" href="<?php echo History::getUrl($_SESSION['login']) ?>"><i class="icon-list-alt"></i>&nbsp;History</a></li>
                            <li class="divider"></li>
                            <li><a href="/index/logout"><i class="icon-eject"></i>&nbsp;Logout</a></li>
                        </ul>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</div>
