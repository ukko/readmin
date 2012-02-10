<h5>SMEMBERS <?php echo htmlspecialchars($key, ENT_QUOTES) ?></h5>
<table class="table table-striped table-bordered">
    <thead>
    <tr>
        <th class="span10">Value</th>
        <th class="span1">Action</th>
    </tr>
    </thead>
    <tbody>
        <?php foreach( $value as $k => $v ) : ?>
        <tr>
            <td><?php echo htmlspecialchars($v, ENT_QUOTES) ?></td>
            <td>
                <div class="btn-group">
                    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-pencil"></i> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                    </ul>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
