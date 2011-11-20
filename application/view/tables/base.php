<h5></h5>
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
            <td><?= htmlspecialchars($name, ENT_QUOTES) ?></td>
            <td><?= htmlspecialchars($value, ENT_QUOTES) ?></td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
