<?php

include_once ('header.php');

$users = get_option('users');
if(!$users) {
    $users = [];
}else {
    $users = json_decode($users, true);
}

$search = isset($_POST['search']) ? $_POST['search'] : '';
if($search) {
    $users = array_filter($users, function($user) use ($search) {
        return strpos(strtolower($user['fullname']), $search) !== false || strpos($user['email'], $search) !== false || strpos($user['phone'], $search) !== false || strpos($user['address'], $search) !== false;
    });
}

?>
<div class="wrap">
    <h2>All Users</h2>
    <form method="post" action="">
        <input type="text" name="search" placeholder="Search users">
        <input class="btn btn-success" type="submit" value="Search" name="submit">
    </form>
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
    <a href="admin.php?page=all-users" class="btn btn-success">Add Member</a>
    <button id="reset" class="btn btn-danger" type="reset" name="reset" value="reset">Reset</button>
</div>
<?php

include_once ('footer.php');
