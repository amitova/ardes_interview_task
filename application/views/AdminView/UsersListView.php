<div class="col-md-8 col-lg-9">
    <hr>
    <h3 class="card-title text-center">Users list</h3>
    <hr>
    <table id="userList" class="display">
    <thead
        <tr>
            <th>Email</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Status</th>
            <th>Registration date</th>
            <th>Edit User</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($users_data as $key => $user_data) {
            ?>
            <tr>
                <td><?= $user_data['email'] ?></td>
                <td><?= $user_data['fname'] ?></td>
                <td><?= $user_data['lname'] ?></td>
                <td><?= ($user_data['status'] == 1) ? "active" : "block" ?></td>
                <td><?= $user_data['reg_date'] ?></td>
                <td><a class="btn btn-success" href="<?= base_url('dashboard/editUser/'.$user_data['user_id'] )?>" >Edit</a></td>

            </tr>
            <?php
        }
        ?>
    </tbody>
    <tfoot>
        <th>Email</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Status</th>
        <th>Registration date</th>
        <th>Edit User</th>
    </tfoot>

</table>    
</div>
<script>
    function editUser(user_id){
        window.location.href("dashboard/editUsers/"+ user_id)
    }
</script>