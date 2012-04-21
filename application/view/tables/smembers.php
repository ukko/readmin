<?= View::factory('fragment/breadcrumb', array('cmd' => $cmd, 'key' => $key ) ) ?>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th class="chckbox"><input type="checkbox"></th>
            <th class="span8">Value</th>
            <th class="action">Action <a href="SADD <?php echo $key?>" class="execute"><i class="icon-plus-sign" title="SADD"></i></a></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach( $value as $k => $member ) : ?>
        <tr>
            <td><input type="checkbox" id="<?php echo $key ?>"/></td>
            <td>
                <div class="span9"><?php echo htmlspecialchars($member, ENT_QUOTES) ?></div>
            </td>
            <td>
                <div class="btn-group">
                    <a class="btn textarea" data-toggle="dropdown" href="#">
                        <i class="icon-pencil"></i>
                    </a>
                    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><?php echo Helper_Sets::anchorActionDelete( $key, $member ) ?></li>
                    </ul>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
