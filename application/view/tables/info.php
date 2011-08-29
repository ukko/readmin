<?php
/**
 *
 */
?>
<table>
    <caption>INFO</caption>
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
            <td><?= htmlspecialchars($name, ENT_QUOTES) ?></td>
            <td><?= htmlspecialchars($value, ENT_QUOTES) ?></td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
