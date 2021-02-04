   
    <div class="row">
        <div class="col-md-4 col-lg-3" style="background-color:#333131;">

            <div class="bootstrap-vertical-nav">

                <button class="btn btn-primary btn-lg btn-block" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    <span class="">Menu</span>
                </button>

                <div class="collapse" id="collapseExample">
                    <ul class="nav flex-column" id="exCollapsingNavbar3">
                        <?php if($this->session->role == 2){?>
                        <li class="nav-item">
                            <a class="nav-link active" href="<?=base_url('dashboard/data')?>">Data</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=base_url('dashboard/charts')?>">Charts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=base_url('dashboard/profile')?>">Profile</a>
                        </li>
                        <?php }else{ ?>
                        <li class="nav-item">
                            <a class="nav-link active" href="<?=base_url('dashboard/addUser')?>">Add User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=base_url('dashboard/editUsers')?>">Edit User</a>
                        </li>
                        <?php }?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=base_url('logout')?>">LogOut</a>
                        </li>
                    </ul>
                </div>

            </div>

        </div>