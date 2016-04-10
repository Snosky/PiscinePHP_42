<h1>Panier</h1>
<?php if (empty($items)): ?>
<h3>Le panier est vide ! Dépêchez vous d'acheter !!!!</h3>
<?php else: ?>
<table border="true">
    <thead>
        <tr>
            <td>Article</td>
            <td>Quantite</td>
            <td>Prix</td>
            <td></td>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <td colspan="4" class="text-right">Total: <?php myecho(cart_get_total($items)) ?></td>
        </tr>
    </tfoot>
    <tbody>
    <?php foreach ($items as $item): ?>
        <tr>
            <td><a href="item.php?itm_id=<?php myecho($item['itm_id']) ?>"><?php myecho($item['itm_name']) ?></a></td>
            <td>
                <a href="cart.php?action=less&itm_id=<?php myecho($item['itm_id']) ?>">-</a>
                <?php myecho($item['itm_quantity']) ?>
                <a href="cart.php?action=more&itm_id=<?php myecho($item['itm_id']) ?>">+</a>
            </td>
            <td><?php myecho($item['itm_price']) ?></td>
            <td><a href="cart.php?action=del&quantity=all&itm_id=<?php myecho($item['itm_id']) ?>">X</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
    <a href="valid_cart.php" class="btn">Valider la commande</a>
<?php endif; ?>