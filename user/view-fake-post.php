<?php

//To Handle Session Variables on This Page
session_start();

//If user Not logged in then redirect them back to homepage. 
//This is required if user tries to manually enter view-job-post.php in URL.
if(empty($_SESSION['id_user'])) {
  header("Location: ../index.php");
  exit();
}

//Including Database Connection From db.php file to avoid rewriting in all files  
require_once("../db.php");
?>
<?php
  require_once("modules/header.php");
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin-left: 0px;">

    <section id="candidates" class="content-header">
      <div class="container">
        <div class="row">
          <?php
            require_once("modules/sidePanel.php");
          ?>
          <div class="col-md-9 bg-white padding-2">
            <div class="row margin-top-20">
              <div class="col-md-12">
              <?php
               $sql = "SELECT * FROM fake_news WHERE id_user='$_SESSION[id_user]' AND id_fakepost='$_GET[id]'";
                $result = $conn->query($sql);

                //If Job Post exists then display details of post
                if($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) 
                  {
                      ?>
                    <div class="pull-left">
                      <h2><b><i><?php echo $row['title']; ?></i></b></h2>
                    </div>
                    <div class="pull-right">
                      <a href="my-job-post.php" class="btn btn-default btn-lg btn-flat margin-top-20"><i class="fa fa-arrow-circle-left"></i> Back</a>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <?php
                      $sqlquery = "select city from `user` where id_user = $_SESSION[id_user];";
                      $row_result= $conn->query($sqlquery);
                      $row_city = $row_result->fetch_assoc();
                      $user_city = $row_city['city'];
                    ?>
                    <div>
                      <p>
                        <span class="margin-right-10">
                          <i class="fa fa-location-arrow text-green"></i> 
                          <?php echo $user_city; ?>
                        </span> 
                          <i class="fa fa-calendar text-green"></i>
                          <?php echo date("d-M-Y", strtotime($row['createdat'])); ?>
                      </p>
                    </div>
                    <div>
                      <?php echo stripcslashes($row['description']); ?>
                    </div>
                    <div>
                      <!--for admin description-->
                      <section id="candidates" class="content-header">
                          <div>
                            <div class="row">          
                              <div class="col-md-12 bg-white padding-2">
                                <?php
                                if($row['approval_status']==1){
                                  echo '
                                  <div class="pull-middel">
                                    <h2><b><i>Admin description on fake post</i></b></h2>
                                  </div>
                                  <div class="col-mid-3">
                                    '.stripcslashes($row['admin_clarification']).'
                                  </div>';
                                }else{
                                  echo'
                                  <div class="pull-middel">
                                    <h4>
                                      Your post is pending for admin approval
                                    </h4>
                                  </div>                                    
                                  ';
                                }
                                ?>
                              </div>
                            </div>
                          </div>
                        </section>
                    </div>
                    <?php
                  }
                }
                ?>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </section>


    

  </div>
  <!-- /.content-wrapper -->

  <?php
    require_once("modules/footer.php");
  ?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg">
  </div>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<!-- AdminLTE App -->
<script src="../js/adminlte.min.js"></script>

</body>
</html>
