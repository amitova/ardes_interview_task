<div class="col-md-8 col-lg-9">
    <hr>
    <h3 class="card-title text-center">Currencies data</h3>
    <hr>
<table id="currenciesTable" class="display">
    <thead>
        <tr>
            <th>Currency</th>
            <th>Value</th>
            <th>Base on</th>
            <th>Date/Time</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($rates as $currency => $value) {
            ?>
            <tr>
                <td><?= $currency ?></td>
                <td><?= $value ?></td>
                <td><?= $base ?></td>
                <td><?= date('d/m/Y H:i:s', $timestamp) ?></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
    <tfoot>
        <th>Currency</th>
        <th>Value</th>
        <th>Base on</th>
        <th>Date/Time</th>
    </tfoot>

</table>    
</div>