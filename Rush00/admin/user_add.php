<?php
include ('../global/global.php');
include ('../global/admin_global.php');
include ('../model/include.php');

$form['val_username'] = "";
$form['val_email'] = "";

// Envoi du formulaire
if ($_POST)
{
    $form_is_valid = TRUE;

    //Verification username TODO: verifieer username existe deja
    if (!isset($_POST['username']) || empty($_POST['username']) || strlen($_POST['username']) < 3 || strlen($_POST['username']) > 254 || !preg_match('/^[a-z\-_\ 0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]*$/i', $_POST['username']))
    {
        add_flash_message('error', 'Le nom d\'utilisateur doit etre alpha-numerique et contenir entre 3 et 253 caracteres.');
        $form_is_valid = FALSE;
    }

    // Verification username deja utilise
    if (db_findUserByUsername($_POST['username']) != FALSE)
    {
        add_flash_message('error', 'Le nom d\'utilisateur est deja utilise.');
        $form_is_valid = FALSE;
    }

    //Verification password
    if (!isset($_POST['password']) || empty($_POST['password']) || $_POST['password'] != $_POST['password_conf'])
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

    if(db_findUserByEmail($_POST['email']) != FALSE)
    {
        add_flash_message('error', 'L\'adresse email est deja utilise.');
        $form_is_valid = FALSE;
    }

    if (!isset($_POST['role']) || empty($_POST['role']) || !in_array($_POST['role'], array('ROLE_ADMIN', 'ROLE_USER')))
    {
        add_flash_message('error', 'Le role n\'est pas valide.');
        $form_is_valid = FALSE;
    }


    $form['val_email'] = $_POST['email'];
    $form['val_username'] = $_POST['username'];

    if ($form_is_valid)
    {
        // On enregistre en bdd, on co et on redirige
        $salt = substr(sha1(time()), 0 , 32);

        $_POST['password'] = hash_pwd($_POST['password'], $salt);

        $data = array(
            'username'  => $_POST['username'],
            'email'     => $_POST['email'],
            'password'  => $_POST['password'],
            'salt'      => $salt,
            'usr_role'  => $_POST['role'],
        );

        if (!db_addUser($data))
            add_flash_message('error', 'Erreur lors de l\'enregistrement des donnees :'.mysqli_error($db));
        else
        {
            add_flash_message('success', 'L\'utilisateur a ete cree.');
            header('Location:user.php');
            die();
        }
    }

}


render('admin/user_add.php', array(
    'form'  => $form,
), 'admin/layout.php');