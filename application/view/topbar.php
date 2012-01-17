<div class="topbar-wrapper">
    <div class="topbar">
        <div class="topbar-inner">
            <div class="container">
                <a class="brand" href="#">Re:admin</a>
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
                            <li><a href="">127.0.0.1:6379</a></li>
                            <li><a href="">127.0.0.1:6380</a></li>
                            <li class="divider"></li>
                            <li><a href="">127.0.0.1:6381</a></li>
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

