<h1><?php myecho($category['cat_name']) ?></h1>
<?php if (!empty($items)): ?>
<ul>
    <?php foreach ($items as $itm): ?>
    <li>
        <a href="item.php?itm_id=<?php myecho($itm['itm_id']) ?>">
            <?php myecho($itm['itm_name']) ?> - $<?php myecho($itm['itm_price']) ?> - Q:<?php myecho($itm['itm_quantity']) ?>
        </a>
    </li>
    <?php endforeach; ?>
</ul>
<?php else: ?>
<h3>Il n'y a pas d'articles dans cette categorie.</h3>
<?php endif; ?>
