<h5>SMEMBERS <?php echo htmlspecialchars($key, ENT_QUOTES) ?></h5>
<table>
    <thead>
    <tr>
        <th>value</th>
    </tr>
    </thead>
    <tbody>
        <?php foreach( $value as $k => $v ) : ?>
        <tr>
            <td><?php echo htmlspecialchars($v, ENT_QUOTES) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
