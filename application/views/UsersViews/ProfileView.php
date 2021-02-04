<link rel="stylesheet" href="<?= base_url('resources/css/login.css'); ?>" type="text/css" /> 

      <div class="col-md-8 col-lg-9">
        <hr>
            <h3 class="card-title text-center">Profile data</h3>
        <hr>
        <div class="card card-signin flex-row my-5">
          <div class="card-body">
            <?php
            if(validation_errors()){
                echo '<div class="alert alert-danger" id="formError" role="alert">'.validation_errors().'</div>';
            }
			if($success){
				echo '<div class="alert alert-success" role="alert">'.$success.'</div>';	
			}
            ?>
            <form class="form-signin" name="profileForm" action="<?=base_url('dashboard/editProfile')?>" method="post">
                
              <div class="form-label-group">
                  <input type="hidden" id="user_id" name="user_id" class="form-control"  value="<?=$user_id?>">

              </div>
                
              <div class="form-label-group">
                  <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" value="<?=$email?>" disabled="">
                <label for="inputEmail">Email address</label>
              </div>
              
              <hr>

              <div class="form-label-group">
                  <input type="text" id="inputFName" name="inputFName" value="<?=$fname?>" class="form-control" placeholder="First Name" />
                <label for="inputFName">First Name</label>
              </div>
              
              <div class="form-label-group">
                  <input type="text" id="inputLName" name="inputLName" value="<?=$lname?>" class="form-control" placeholder="Last Name" />
                <label for="inputLName">Last Name</label>
              </div>
              <hr>

              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Edit</button>

              
            </form>
          </div>
        </div>
      </div>

