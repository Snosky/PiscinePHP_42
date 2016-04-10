<h1>Categories :</h1>
<ul>
    <?php foreach ($categories as $category): ?>
    <li><a href="category.php?cat_id=<?php myecho($category['cat_id']) ?>"><?php myecho($category['cat_name']) ?> (<?php myecho($category['nb_items'])?>)</a></li>
    <?php endforeach; ?>
</ul>