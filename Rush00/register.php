<?php
include ('global/global.php');
include ('lib/include.php');

// Load Models
include_once ('model/include.php');

if (is_connected())
{
    add_flash_message('error', 'Cette page n\'existe pas.');
    header('Location:index.php');
    die();
}

$form['val_username'] = "";
$form['val_email'] = "";

// Envoi du formulaire
if ($_POST)
{
    $form_is_valid = TRUE;

    //Verification username TODO: verifieer username existe deja
    if (!isset($_POST['username']) || empty($_POST['username']) || strlen($_POST['username']) < 3 || strlen($_POST['username']) > 254 || !preg_match('/^[a-z\-_\ 0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]*$/i', $_POST['username']))
    {
        add_flash_message('error', 'Le champs "Nom d\'utilisateur" ne doit faire entre 3 et 254 caracteres et doit uniquement contenir des caracteres alpha-numerique');
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
        add_flash_message('error', 'L\'adresse email est deje utilise.');
        $form_is_valid = FALSE;
    }


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
            'usr_role'  => 'ROLE_USER',
        );

        if (!db_addUser($data))
            add_flash_message('error', 'Erreur lors de l\'enregistrement des donnees :'.mysqli_error($db));
        else
        {
            add_flash_message('success', 'Vous etes bien inscrit.');
            header('Location:index.php');
            die();
        }
    }

}


render('register.php', array(
    'form'  => $form,
));