<?php
    /**
     * Main "layout" template
     */
?>
<!DOCTYPE html>
<html>
<?php echo View::factory('head') ?>
<body>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="brand" href="<?php echo Helper_Url::create() ?>">Re:admin</a>
        </div>
    </div>
</div>
<div class="container">
    <div class="content">
        <div class="row">
            <div class="span2">&nbsp;</div>
            <div class="span16" id="content">

                <form class="form-horizontal" method="post">
                    <fieldset>
                        <legend>Please log in:</legend>
                        <div class="alert alert-info">
                            login: <b>admin</b><br/>
                            password: <b>admin</b>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="login">Login</label>

                            <div class="controls">
                                <input name="login" class="input-xlarge focused" id="login" type="text" placeholder="Your login" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="password">Password</label>

                            <div class="controls">
                                <input name="password" class="input-xlarge focused" id="password" type="password" placeholder="Your password" />
                            </div>
                        </div>

                        <div class="control-group success">
                            <label class="control-label" for="connect">Connect to server</label>

                            <div class="controls">
                                <select id="connect" name="server" class="input-xlarge">
                                <?php
                                foreach ( Config::get('hosts') as $host => $users )
                                {
                                    echo "<option value='{$host}'>{$host}</option>";
                                }
                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary">Log in</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <?php echo View::factory('footer') ?>
</div>
<!-- /container -->
</body>
</html>
