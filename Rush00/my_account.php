<?php
include ('global/global.php');
include ('lib/include.php');
include ('model/include.php');

if (is_connected())
{
    if (!($user = db_findUserById(get_user()['id'])))
    {
        add_flash_message('error', 'Erreur lors de l\'acces au compte. Veuillez reassaye plus tard.');
        header('Location:index.php');
        die();
    }

    $form = $user;

    if ($_POST)
    {
        $form_is_valid = TRUE;

        //Verification password
        $old_password = hash_pwd($_POST['old_password'], $user['usr_salt']);
        if ($old_password != $user['usr_password'])
        {
            add_flash_message('error', 'Mot de passe errone.');
            $form_is_valid = FALSE;
        }

        if ($_POST['new_password'] != $_POST['new_password_conf'])
        {
            add_flash_message('error', 'Les mots de passe ne correspondent pas.');
            $form_is_valid = FALSE;
        }

        //Verification email  //TODO : Verifier email existe deja
        if (!isset($_POST['email']) || empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        {
            add_flash_message('error', 'L\'adresse email n\'est pas valide.');
            $form_is_valid = FALSE;
        }

        if(db_findUserByEmail($_POST['email'], $user['usr_id']) != FALSE)
        {
            add_flash_message('error', 'L\'adresse email est deje utilise.');
            $form_is_valid = FALSE;
        }

        if ($form_is_valid)
        {
            if (isset($_POST['action']) && $_POST['action'] == 'delete')
            {
                if ((db_deleteUser($user['usr_id'])))
                {
                    add_flash_message('success', 'Votre compte a bien ete supprime.');
                    deconnect_user();
                    header('Location:index.php');
                    die();
                }
                else
                {
                    add_flash_message('error', 'Erreur lors de la suppression du compte.');
                    header('Location:my_account.php');
                    die();
                }
            }

            $data = array(
                'usr_id'        => $user['usr_id'],
                'usr_name'      => $user['usr_name'],
                'usr_email'     => $_POST['email'],
                'usr_role'      => $user['usr_role'],
            );

            if (!empty($_POST['new_password']))
                $data['usr_password'] = hash_pwd($_POST['new_password'], $user['usr_salt']);

            if (!db_editUser($data))
                add_flash_message('error', 'Erreur lors de l\'enregistrement des donnees :'.mysqli_error($db));
            else
            {
                add_flash_message('success', 'Votre compte a bien ete modifie.');
                header('Location:index.php');
                die();
            }
        }
    }

    render('my_account.php', array(
        'form'  => $form
    ));
}
else
{
    add_flash_message('error', 'Cette page n\'existe pas.');
    header('Location:index.php');
    die();
}