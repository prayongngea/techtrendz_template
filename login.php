<?php
require_once 'lib/config.php';
require_once 'lib/session.php';
require_once 'lib/pdo.php';
require_once 'lib/user.php';

require_once 'templates/header.php';

$errors = [];
$messages = [];

// Si le formulaire a été soumis
if (isset($_POST['loginUser'])) {

    // Vérifier que les champs ne sont pas vides
    if (!empty($_POST['email']) && !empty($_POST['password'])) {

        $email = trim($_POST['email']);
        $password = $_POST['password'];

        // Appel de la fonction pour vérifier l'utilisateur
        $user = verifyUserLoginPassword($pdo, $email, $password);

        if ($user) {
            // Stocker l'utilisateur dans la session
            $_SESSION['user'] = $user;

            // Redirection selon le rôle
            if ($user['role'] === 'admin') {
                header('Location: admin/index.php');
            } else {
                header('Location: index.php');
            }
            exit;

        } else {
            // Identifiants incorrects
            $errors[] = "Email ou mot de passe incorrect.";
        }

    } else {
        $errors[] = "Veuillez remplir tous les champs.";
    }

}
?>

<h1>Login</h1>

<?php 
// Affichage des erreurs
foreach ($errors as $error) : ?>
    <div class="alert alert-danger" role="alert">
        <?= htmlspecialchars($error) ?>
    </div>
<?php endforeach; ?>

<form method="POST">
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>

    <input type="submit" name="loginUser" class="btn btn-primary" value="Se connecter">

</form>

<?php
require_once 'templates/footer.php';
?>
