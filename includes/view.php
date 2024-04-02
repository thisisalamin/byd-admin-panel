<?php

$users = get_option('users');
if(!$users) {
    $users = [];
}else {
    $users = json_decode($users, true);
}

?>
<div class="wrap">
    <h2>All Users</h2>
    </br>
    <table class="wp-list-table widefat fixed striped posts">
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Date of Birth</th>
                <th>Nationality</th>
                <th>City</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($users as $user): ?>
                <tr>
                    <td ><?php echo $user['fullname']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['phone']; ?></td>
                    <td><?php echo $user['birthday']; ?></td>
                    <td><?php echo $user['nationality']; ?></td>
                    <td><?php echo $user['address']; ?></td>
                    <td><?php echo $user['salary']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br>
</div>