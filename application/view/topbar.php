<div class="topbar-wrapper">
    <div class="topbar">
        <div class="topbar-inner">
            <div class="container">
                <a class="brand" href="<?php echo Helper_URL::create() ?>">Re:admin</a>
                <ul class="nav">
                    <li>
                        <ul class="nav secondary-nav">
                            <li class="dropdown">
                                <a class="dropdown-toggle" href="#" id="database" value="<?php echo $currentdb ?>">Database: <?php echo $currentdb ?></a>
                                <ul class="dropdown-menu">
                                <?php
                                    for ($i = 0; $i < Config::get('databases'); $i++) {
                                        $count = isset( $dbkeys[$i] ) ? number_format($dbkeys[$i]) : 0;
                                        echo '<li><a var-id="' . $i . '">' . $i .' — ' . $count . '  keys</a></li>';
                                    }
                                ?>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>


                <p class="pull-right">
                <ul class="nav secondary-nav">
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#">ukko@127.0.0.1:6379</a>
                        <ul class="dropdown-menu">
                            <?php foreach( Config::get('hosts') as $host ) : ?>
                            <li><a var-host="<?php echo $host['host'] ?>" var-port="<?php $host['port']?>"><?php echo $host['host'] . ':' . $host['port'] ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                </ul>
                </p>

                <!--<form action="" class="pull-right">-->
                <!--<input type="text" placeholder="login" />-->
                <!--<input type="text" placeholder="password" />-->
                <!--</form>-->
            </div>
        </div>
    </div>
</div>

