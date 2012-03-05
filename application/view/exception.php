<?php
/**
 * @var Exception $exception
 */
?>
<!DOCTYPE html>
<html>
<?php echo View::factory('head') ?>
<body>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="brand" href="<?php echo Helper_URL::create() ?>">Re:admin</a>
        </div>
    </div>
</div>
<div class="container">
    <div class="content">
        <h3>Exception</h3>
        <div class="well">
            <div class="accordion" id="accordion">
            <?php while ( $exception ) : ?>
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion"
                           href="#collapseOne">
                            <?php echo $exception->getMessage() ?>
                        </a>
                    </div>
                    <div id="collapseOne" class="accordion-body in collapse" style="height: auto; ">
                        <div class="accordion-inner">
                            <div>
                                <span class="label">line:</span> <?php echo $exception->getLine() ?>
                                <span class="label">file:</span> <?php echo $exception->getFile() ?>
                            </div>

                            <div class="alert">
                                <?php foreach ($exception->getTrace() as $step) : ?>
                                <?php var_dump($step); ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $exception = $exception->getPrevious(); ?>
            <?php endwhile; ?>
            </div>
        </div>
    </div>
    <?php echo View::factory('footer') ?>
</div>
<script type="text/javascript">
    $(function () {
        $(".collapse").collapse();
    });
</script>
</body>
</html>
