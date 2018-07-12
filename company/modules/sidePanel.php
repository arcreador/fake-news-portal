<div class="col-md-3">
            <div class="box box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">Welcome <b><?php echo $_SESSION['name']; ?></b></h3>
              </div>
              <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                  <li 
                  class="<?php 

                        if($currentPage=="Dashboard") 
                            echo "active"; ?>"

                  ><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                  
                  <li 
                  class="<?php 

                        if($currentPage=="my") 
                            echo "active"; ?>"

                  ><a href="edit-company.php"><i class="fa fa-tv"></i> My Company</a></li>
                  
                  <li
                    class="<?php

                      if($currentPage == "createFakePost")
                        echo "active"; ?>"
                    
                  ><a href="create-job-post.php"><i class="fa fa-file-o"></i> Create Fake Post</a></li>
                  
                  <li 
                  class="<?php 

                        if($currentPage=="mypost") 
                            echo "active"; ?>"

                  ><a href="my-job-post.php"><i class="fa fa-file-o"></i> My Post</a></li>
                  
                  <li 
                  class="<?php 

                        if($currentPage=="settings") 
                            echo "active"; ?>"

                  ><li><a href="settings.php"><i class="fa fa-gear"></i> Settings</a></li>
                  
                  <li><a href="../logout.php"><i class="fa fa-arrow-circle-o-right"></i> Logout</a></li>
                </ul>
              </div>
            </div>
          </div>