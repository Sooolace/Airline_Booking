<?php
 include "includes/header.php";
 include "includes/head.php"; 
 ?>

  
<section class="vh-100 gradient-custom">
  <div class="container py-5 h-50">
    <div class="row justify-content-center align-items-center h-100">
      <div class="col-12 col-lg-9 col-xl-7">
        <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
          <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Login</h3>

            <!-- <div class="row mb-4">
            <div class="col-md-6 mb-4">
                <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="userRoleDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Select Role
                </button>
                <div class="dropdown-menu" aria-labelledby="userRoleDropdown">
                    <a class="dropdown-item" href="#" onclick="displayRole('ADMIN')">ADMIN</a>
                    <a class="dropdown-item" href="#" onclick="displayRole('USER')">USERS</a>
                </div>
                </div>
            </div>
            </div> -->

            <form method="POST" action="loginprocess.php">
              <div class="row">
                <div class="col-md-12 mb-4">

                <?php if (isset($_GET['error'])) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo $_GET['error']; ?>
                    </div>
                <?php } ?>



                  <div class="form-outline">
                    <input type="text" id="username" name="username" class="form-control form-control-lg" />
                    <label class="form-label" for="username">User name</label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 mb-4">
                  <div class="form-outline">
                    <input type="password" id="password" name="password" class="form-control form-control-lg" />
                    <label class="form-label" for="password">Password</label>
                  </div>
                </div>
              </div>
              <input type="hidden" id="selectedRoleInput" name="selectedRole" value="" />
              <div>
                <input class="btn btn-primary btn-lg" type="submit" value="Submit" />
              </div>
            </form>

            <!-- Registration link -->
            <p class="mt-3 mb-0"><a href="admin\login.php">Log in as admin</a></p>
            <p class="mt-3 mb-0">Don't have an account? <a href="register.php">Register</a></p>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- <script>
  function displayRole(role) {
    document.getElementById('userRoleDropdown').textContent = role;
    document.getElementById('selectedRoleInput').value = role; //
  }
</script> -->