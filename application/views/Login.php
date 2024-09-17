<?php $this->load->view('Components/header'); ?>
<body style="background-image: url('assets/img/login-background.png'); background-size: cover; background-repeat: no-repeat; background-attachment: fixed;">


  <div class="container h-100 w-100" id="wrapper">
        <div class="container-fluid" style="height">
            <div class="row justify-content-center h-100">
                <div class="col-xl-5 col-lg-7 d-flex flex-column align-items-center justify-content-center">

                    <div id="alert" class="mt-3">
                        <?php if ($this->session->flashdata('error')): ?>
                            <?php echo $this->session->flashdata('error'); ?>
                        <?php elseif ($this->session->flashdata('success')): ?>
                            <?php echo $this->session->flashdata('success'); ?>
                        <?php endif; ?>
                    </div>

                    <div class="card shadow mb-4 px-3" >

                        <!-- Card Header -->
                        <div class="card-body py-3 d-flex flex-column align-items-center justify-content-center" >
                            <img class="mx-auto" src="<?= base_url('assets/img/CJT Blue.svg') ?>" alt="" style="width:120px">
                            <h4 class="m-0 font-weight-bold text-center" style="color:#567DE2">CARLJO TRANSPORT SERVICE</h4>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                        <form id="loginForm" method="post" action="<?php echo base_url('Control_login/Login_attempt');?>">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background-color:#567DE2"><i class="fas fa-user-tie" style="color:#fff"></i></span>
                                </div>
                                <input type="Email" class="form-control" placeholder="Email" id="inptEmail" name="inptEmail">
                            </div>

                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background-color:#567DE2"><i class="fas fa-key" style="color:#fff"></i></span>
                                </div>
                                <input type="password" class="form-control" placeholder="Password" id="inptPassword" name="inptPassword">
                            </div>
                            
                            <button type="submit" id="loginButton" class="btn" style="width: 100%;background-color:#567DE2;color:white;">Login</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <?php $this->load->view('Components/scripts'); ?>
  </body>
</html>