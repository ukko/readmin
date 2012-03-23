<?php if (isset($exception) && $exception instanceof Exception) : ?>
<h1>Exception:</h1>
<dl>
    <dt>Code</dt>
    <dd><?php echo $exception->getCode() ?></dd>

    <dt>File</dt>
    <dd><?php echo $exception->getFile() ?></dd>

    <dt>Line</dt>
    <dd><?php echo $exception->getLine() ?></dd>

    <dt>Message</dt>
    <dd><?php echo $exception->getMessage() ?></dd>

    <dt>Previous</dt>
    <dd><?php echo $exception->getPrevious() ?></dd>

    <dt>Trace</dt>
    <dd><pre><?php echo $exception->getTraceAsString() ?></pre></dd>
</dl>
<?php endif; ?>
