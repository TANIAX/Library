<?php
ob_start(); ?>
<h1>Liste des utilisateurs</h1>
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Login</th>
        <th scope="col">Prenom</th>
        <th scope="col">Nom</th>
        <th scope="col">E-mail</th>
        <th scope="col">Adresse</th>
        <th scope="col">Telephone</th>
        <th scope="col">rôle</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($user as $user): ?>
        <tr>
            <th scope="row"><?= $user->user_id ?></th>
            <td><?= $user->user_login ?></td>
            <td><?= $user->user_name ?></td>
            <td><?= $user->user_firstname ?></td>
            <td><?= $user->user_email ?></td>
            <td><?= $user->user_adresse ?></td>
            <td><?= $user->user_tel ?></td>
            <td><?php if ($user->user_role == 1) {
                    echo "Admin";
                } else {
                    echo "Membre";
                } ?></td>
            <td>
                <div class="button-container">
                    <form action="list_user">
                        <input type="hidden" name="id" value=<?= $user->user_id ?>>
                        <button class="btn btn-outline-success" type="submit">Editer</button>
                    </form>
                    <?php if ($_SESSION['login'] != $user->user_login): ?>
                        <form action="delete_user">
                            <input type="hidden" name="id" value=<?= $user->user_id ?>>
                            <button class="btn btn-outline-danger">Supprimer</button>
                        </form>
                        <?php //include 'controller/delete_user' ?>
                    <?php endif ?>
                    </form>
                </div>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
<?php
$title = 'Gestion des utilisateurs';
$content = ob_get_clean();
include 'includes/layout.php';
?>
