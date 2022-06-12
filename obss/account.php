<?php
session_start();

?>

<?php
 if(!isset($_SESSION['uname']))
 {
     echo "you are logged out login again";
     header('location: userlogin.php');
 }
 else
 {
    $uid=$_SESSION['id'];
 }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Edit Profile Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">
<div class="row flex-lg-nowrap">
  <div class="col-12 col-lg-auto mb-3" style="width: 200px;">
    <div class="card p-3">
      <div class="e-navlist e-navlist--active-bg">
        <ul class="nav">
          <li class="nav-item"><a class="nav-link px-2 active" href="http://localhost/obss/product.php?uid=<?php echo $uid ?>"><i class="fa fa-fw fa-bar-chart mr-1"></i><span>Home</span></a></li>
          <li class="nav-item"><a class="nav-link px-2" href="http://localhost/obss/cart.php?uid=<?php echo $uid ?>"><i class="fa fa-fw fa-th mr-1"></i><span>Cart</span></a></li>
        </ul>
      </div>
    </div>
  </div>

  <div class="col">
    <div class="row">
      <div class="col mb-3">
        <div class="card">
          <div class="card-body">
            <div class="e-profile">
              <div class="row">
                <div class="col-12 col-sm-auto mb-3">
                  <div class="mx-auto" style="width: 140px;">
                    <div class="d-flex justify-content-center align-items-center rounded" style="height: 140px; background-color: rgb(233, 236, 239);">
                      <span style="color: rgb(166, 168, 170); font: bold 8pt Arial;">
                        <img src="user_images\<?php 
                        if(isset($_SESSION['uname']))
                          {
                            echo $_SESSION['image'];
                            
                          }
                          ?>" alt="Maxwell Admin" width="140" height="140">
                      </span>
                    </div>
                  </div>
                </div>
                <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                  <div class="text-center text-sm-left mb-2 mb-sm-0">
                    <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">
                    <?php
                    if(isset($_SESSION['uname']))
                    {
                      echo $_SESSION['uname'];
                     
                    }
                    ?>
                    </h4>
                    <p class="mb-0">
                    <?php
                    if(isset($_SESSION['uname']))
                    {
                      echo $_SESSION['uemail'];
                    }
                    ?>
                    </p>
                    <div class="text-muted"><small>Last seen 2 hours ago</small></div>
                    <div class="mt-2">
                    <form class ="form" action="imageupdate.php" method="POST" enctype="multipart/form-data" id="pic">
                    <?php
                    if(isset($_SESSION['uname']))
                    {
                      echo $_SESSION['status'];
                      
                    }
                    ?>
   <!--update image submit button-->
                    </p>
                    <input type="file" name="uploadfile" id="image">
                      <button class="btn btn-primary" type="submit" name="submit" id="submit" form="pic">
                        <i class="fa fa-fw fa-camera"></i>
                        <span>Change Photo</span>
                      </button>
                      </form>
                    </div>
                    
                  </div>
                  <div class="text-center text-sm-right">
                    <span class="badge badge-secondary">user</span>
                    <div class="text-muted"><small></small></div>
                  </div>
                </div>
              </div>
              <ul class="nav nav-tabs">
                <li class="nav-item"><a href="" class="active nav-link">Settings</a></li>
              </ul>
              <div class="tab-content pt-3">
                <div class="tab-pane active">
                  <br />
  <!--update details submit button-->
                  <form class="form" action="updateuser.php?uid=<?php echo $uid;?>" method="POST" id="update">
                    <div class="row">
                      <div class="col">
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>First Name</label>
                              <input class="form-control" type="text" name="fname" readonly placeholder="John Smith" value="<?php
                                                                                          if(isset($_SESSION['uname']))
                                                                                          {
                                                                                            echo $_SESSION['uname'];
                                                                                          
                                                                                          }
                                                                                          ?>">
                            </div>
                          </div>
                          <div class="col">
                            <div class="form-group">
                              <label>Lastname</label>
                              <input class="form-control" type="text" name="lname" placeholder="johnny.s" readonly value="<?php echo $_SESSION['lastname'];?>">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Email</label>
                              <input class="form-control" type="text" placeholder="user@example.com" readonly value ="<?php
                    if(isset($_SESSION['uname']))
                    {
                      echo $_SESSION['uemail'];
                     
                    }
                    ?>">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col mb-3">
                            <div class="form-group">
                              <label>username</label>
                              <input class="form-control" type="text" readonly placeholder="username" name="username" value="<?php echo $_SESSION['username'];?>">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-12 col-sm-6 mb-3">
                      <?php
                    if(isset($_SESSION['uname']))
                    {
                      echo $_SESSION['status'];
                      
                    }
                    ?>
                        <div class="mb-2"><b>Change Password</b></div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>New Password</label>
                              <input class="form-control" type="password" name="newpswd" placeholder="••••••" required>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Confirm <span class="d-none d-xl-inline">Password</span></label>
                              <input class="form-control" type="password" name="confnewpswd" placeholder="••••••" required></div>
                          </div>
                        </div>
                      </div>
                      <div class="col-12 col-sm-5 offset-sm-1 mb-3">
                        <div class="mb-2"><b>Keeping in Touch</b></div>
                        <div class="row">
                          <div class="col">
                            <label>Email Notifications</label>
                            <div class="custom-controls-stacked px-2">
                              <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="notifications-blog" checked="">
                                <label class="custom-control-label" for="notifications-blog">Blog posts</label>
                              </div>
                              <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="notifications-news" checked="">
                                <label class="custom-control-label" for="notifications-news">Newsletter</label>
                              </div>
                              <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="notifications-offers" checked="">
                                <label class="custom-control-label" for="notifications-offers">Personal Offers</label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit" name="update" id="update" form="update">Save Changes</button>
                      </div>
                    </div>
<!--form end  --> </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-md-3 mb-3">
        <div class="card mb-3">
          <div class="card-body">
            <div class="px-xl-3">
              <a href="logout.php">
              <button class="btn btn-block btn-secondary">
                <i class="fa fa-sign-out">
                </i>
                <span>Logout</span>
              </button>
              </a>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <h6 class="card-title font-weight-bold">Support</h6>
            <p class="card-text">Get fast, free help from our friendly assistants.</p>
            <a href="contact1.php">
            <button type="button" class="btn btn-primary">Contact Us</button>
            </a>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
</div>

<style type="text/css">
body{
    margin-top:20px;
    background:#f8f8f8
}
</style>

<script type="text/javascript">

</script>
</body>
</html>