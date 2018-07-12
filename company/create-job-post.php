<?php

//To Handle Session Variables on This Page
session_start();

//If user Not logged in then redirect them back to homepage. 
if(empty($_SESSION['id_company'])) {
  header("Location: ../index.php");
  exit();
}

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
            $currentPage = "createFakePost";
            require_once("modules/sidePanel.php");
          ?>
          <div class="col-md-9 bg-white padding-2">
            <h2><i>Create About Fake News Post</i></h2>
            <div class="row">
              <form method="post" action="addpost.php" 
              enctype="multipart/form-data" 
              >
                <div class="col-md-12 latest-job ">
                  <div class="form-group">
                    <input class="form-control input-lg" type="text" id="jobtitle" name="fakenewstitle" placeholder="Fake News Title">
                  </div>
                  <div class="form-group">
                    <textarea class="form-control input-lg" rows="10" id="aboutme" name="aboutfake" placeholder="Text about the fake news*" required></textarea>
                  </div>
                  <div class="form-group">
                    <label>Attach Photo</label>
                    <input type="file" name="image" class="form-control input-lg" />  
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-flat btn-success">Upload</button>
                  </div>
                </div>
              </form>
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
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../js/adminlte.min.js"></script>
</body>
</html>
