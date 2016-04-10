<a href="user_add.php" class="btn btn-success">Creer un nouvel utilisateur.</a>

<table>
    <thead>
        <tr>
            <th>Nom d'utilisateur</th>
            <th>Adresse email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo $user['usr_name']; ?></td>
            <td><?php echo $user['usr_email']; ?></td>
            <td><?php echo $user['usr_role']; ?></td>
            <td>
                <a href="user_edit.php?usr_id=<?php echo $user['usr_id'] ?>" class="btn btn-primary">Modifier</a>
                <a href="user_delete.php?usr_id=<?php echo $user['usr_id'] ?>" >Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>