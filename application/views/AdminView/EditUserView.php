<link rel="stylesheet" href="<?= base_url('resources/css/login.css'); ?>" type="text/css" /> 

<div class="col-md-8 col-lg-9">
    <hr>
    <h3 class="card-title text-center"><?=($method == "editUser") ? "Edit User Data" : "Add User"?></h3>
    <hr>
    <div class="card card-signin flex-row my-5">
        <div class="card-body">
            <?php
            if(isset($errors)){
                echo '<div class="alert alert-danger" id="formError" role="alert">' . $errors . '</div>';
            }
            if($method == "editUser"){
                $action = base_url('dashboard/editUser/'.$user_id);  
            }else{
                $action = base_url('dashboard/addUser');
            }
            ?>
            <form class="form-signin" name="profileForm" action="<?=$action?>" method="post">

                <div class="">
                    <input type="hidden" id="user_id" name="user_id" class="form-control"  value="<?= ($method == "editUser") ? $user_id : 0 ?>">
                </div>
                
                <div class="">
                    <label for="inputEmail">Email address</label>
                    <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" value="<?= ($method == "editUser")? $email : $this->input->post('email') ?>">
                </div>

                <hr>
                
                <div class="">
                    <label for="inputFName">First Name</label>
                    <input type="text" id="inputFName" name="inputFName" value="<?=($method == "editUser")? $fname:$this->input->post('inputFName') ?>" class="form-control" placeholder="First Name" />
                </div>
                
                <hr>
                
                <div class="">
                    <label for="inputLName">Last Name</label>
                    <input type="text" id="inputLName" name="inputLName" value="<?= ($method == "editUser")? $lname : $this->input->post('inputLName')?>" class="form-control" placeholder="Last Name" />
                </div>
                
                <hr>
                
                <label for="selectStatus">Status</label>
                <div class="form-label-group">
                    <select name="selectStatus" id="selectStatus" class="form-control">
                        <option value="1" <?=($method == "editUser" && $status==1) ? 'selected':'' ?>>Active</option>
                        <option value="2" <?=($method == "editUser" && $status==2) ? 'selected':'' ?>>Block</option>
                    </select>
                </div>
                <label for="selectRole">Role</label>
                <div class="form-label-group">
                    <select name="selectRole" id="selectRole" class="form-control">
                        <option value="1" <?=($method == "editUser" && $role==1) ? 'selected':'' ?>>Admin</option>
                        <option value="2" <?=($method == "editUser" && $role==2) ? 'selected':'' ?>>User</option>
                    </select>
                </div>
                
                <?php 
                if($method != "editUser"){
                ?>
                    <div class="">
                        <label for="inputPassword">Password</label>
                        <input type="password" id="inputPassword"  name="inputPassword" class="form-control" placeholder="Password" required>
                    </div>
                    <hr>

                    <div id="divConfirmPassword" class="">
                        <label for="inputConfirmPassword">Confirm password</label>
                        <input type="password" id="inputConfirmPassword" name="inputConfirmPassword" class="form-control" placeholder="Password" required>
                    </div>
                    <hr>
                <?php    
                }
                ?>
                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Save changes</button>


            </form>
        </div>
    </div>
</div>


