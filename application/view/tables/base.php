<?php
/**
 * 
 */
?>
<table>
    <thead>
        <tr>
            <th><input type="checkbox" /></th>
            <th>type</th>
            <th>name</th>
            <th>value</th>
        </tr>
    </thead>
    <tbody>
        <?php if(isset($items)) : ?>
        <?php foreach ($items as $name => $value) : ?>
        <tr>
            <td><input type="checkbox" /></td>
            <td>S</td>
            <td><?= $name ?></td>
            <td><?= $value ?></td>
        </tr>        
        <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>