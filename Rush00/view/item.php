<h1><?php myecho($item['itm_name'])?></h1>

<?php if (!empty($item['itm_description'])): ?>
<p>Descrption: <?php myecho($item['itm_description'])?></p>
<?php endif; ?>
<p>Prix: $<?php myecho($item['itm_price']) ?></p>
<p>Quantite:
    <?php if ($item['itm_quantity'] == -1): ?>
     Illimite
    <?php else: ?>
        <?php myecho($item['itm_quantity']) ?>
    <?php endif; ?>
    !!</p>
<form action="cart.php?action=add" method="POST">
    <input type="number" name="quantity" value="1" <?php if ($item['itm_quantity'] != -1) : ?>min="0" max="<?php myecho($item['itm_quantity']) ?>"<?php endif; ?>>
    <input type="hidden" name="itm_id" value="<?php myecho($item['itm_id']) ?>">
    <button class="btn" type="submit">Ajouter au panier</button>
</form>

<?php if (TRUE): ?>

<?php else: ?>

<?php endif; ?>?
