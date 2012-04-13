<ul class="breadcrumb" data-cmd="<?php echo $key ?>">
    <li><a href="#">SMEMBERS <?php echo htmlspecialchars($key, ENT_QUOTES) ?></a> <span class="divider">/</span></li>

    <li class="dropdown pull-right">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Action <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><a href="SADD <?php echo $key?>" class="execute">SADD</a></li>
            <li class="divider"></li>
            <li><?php echo Helper_Keys::anchorAction($key, 'zset', Helper_Keys::ACTION_EXPIRE) ?></li>
            <li><?php echo Helper_Keys::anchorAction($key, 'zset', Helper_Keys::ACTION_RENAME) ?></li>
            <li class="divider"></li>
            <li><?php echo Helper_Keys::anchorAction($key, 'zset', Helper_Keys::ACTION_MOVE) ?></li>
            <li><?php echo Helper_Keys::anchorAction($key, 'zset', Helper_Keys::ACTION_DELETE) ?></li>
        </ul>
    </li>
</ul>


<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th class="chckbox"><input type="checkbox"></th>
            <th class="span8">Value</th>
            <th class="action">Action</th>
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
