<?php
/**
 * 
 */
?>
<table>
    <thead>
        <tr>
            <th>name</th>
            <th>value</th>
        </tr>
    </thead>
    <tbody>
        <?php if(isset($items)) : ?>
        <?php foreach ($items as $name => $value) : ?>
        <tr>
            <td><?= $name ?></td>
            <td><?= $value ?></td>
        </tr>        
        <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>