<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="brand" href="<?php echo Helper_URL::create() ?>">Re:admin</a>
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <ul class="nav pull-right">
                <li id="fat-menu" class="dropdown">
                    <a href="#" id="database" value="<?php echo Request::factory()->getDb() ?>" class="dropdown-toggle" data-toggle="dropdown">Database: 0<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <?php
                        for ($i = 0; $i < Config::get('databases'); $i++) {
                            $count = isset($dbkeys[$i]) ? number_format($dbkeys[$i]) : 0;
                            echo '<li><a var-id="' . $i . '">' . $i . ' — ' . $count . '  keys</a></li>';
                        }
                        ?>
                    </ul>
                </li>
            </ul>

        </div>
    </div>
</div>
