<h5>INFO</h5>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th class="span2">name</th>
            <th class="span9">value</th>
        </tr>
    </thead>
    <tbody>
    <?php if(isset($items)) : ?>
        <?php foreach ($items as $name => $value) : ?>
        <tr>
            <td><?php echo htmlspecialchars($name, ENT_QUOTES) ?></td>
            <td><?php echo htmlspecialchars($value, ENT_QUOTES) ?></td>
        </tr>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
