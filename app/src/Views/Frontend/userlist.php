<?php
/**
 * @var $users \App\Entity\User
 */
?>

<table>
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col">Email</th>
            <th scope="col">Is Admin</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
    <?php
    foreach ($users as $user) : ?>
        <tr>
            <th scope="row"><?= $user['user_id'] ?></th>
            <td><?= $user['last_name'] ?></td>
            <td><?= $user['first_name'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= $user['role'] ?></td>

        </tr>
    <?php endforeach; ?>
    </tbody>
</table>