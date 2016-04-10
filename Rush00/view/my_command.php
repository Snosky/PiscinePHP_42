<h1>Mes commandes</h1>
<?php if (empty($commands)): ?>
<h3>Vous n'avez passe aucune commande.</h3>
<?php else: ?>
<?php foreach ($commands as $c): ?>
    <table border="true">
        <thead>
        <tr>
            <th colspan="2">Commande du <?php echo date('d/M/Y', strtotime($c['com_date'])); ?></th>
        </tr>
        <tr>
            <th colspan="2">
                Etat:
                <?php if ($c['com_status'] == -1):?>
                    En attente
                <?php elseif ($c['com_status'] == 0): ?>
                    Commande annule
                <?php elseif ($c['com_status'] == 1): ?>
                    Commande valide
                <?php endif; ?>
            </th>
        </tr>
        </thead>
        <tfoot>
            <tr>
                <td colspan="2" class="text-right" >Total : $<?php echo $c['com_total']; ?></td>
            </tr>
        </tfoot>
        <tbody>
        <?php if (empty($c['items'])): ?>
            <tr><td colspan="2">Les articles n'existent plus.</td></tr>
        <?php else: ?>
            <?php foreach ($c['items'] as $item): ?>
                <tr>
                    <td><?php echo $item['itm_name'] ?> x <?php echo $item['wanted_quantity']; ?> | En stock : <?php echo $item['itm_quantity'] ?></td>
                    <td>$<?php echo $item['itm_price'] ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
<?php endforeach; ?>
<?php endif; ?>
