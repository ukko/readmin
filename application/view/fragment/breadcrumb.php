<ul class="breadcrumb" data-cmd="<?php echo $key ?>">
<li><a href="#"><?php echo $cmd ?></a> <span class="divider">/</span></li>

<li class="dropdown pull-right">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Action <b class="caret"></b></a>
    <ul class="dropdown-menu">
        <li><?php echo Helper_Keys::anchorActionExpire( $key ) ?></li>
        <li><?php echo Helper_Keys::anchorActionRename( $key ) ?></li>
        <li><?php echo Helper_Keys::anchorActionMove( $key ) ?></li>
        <li><?php echo Helper_Keys::anchorActionDelete( $key ) ?></li>
    </ul>
</li>
</ul>
