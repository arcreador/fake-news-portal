<?php

session_start();

require_once("db.php");

$limit = 4;

if(isset($_GET["page"])) {
	$page = $_GET['page'];
} else {
	$page = 1;
}

$start_from = ($page-1) * $limit;

$sql = "SELECT * FROM fake_news WHERE approval_status = '1' LIMIT $start_from, $limit";
$result = $conn->query($sql);
if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$sql1 = "SELECT * FROM user WHERE id_user='$row[id_user]'";
              $result1 = $conn->query($sql1);
              if($result1->num_rows > 0) {
                while($row1 = $result1->fetch_assoc()) 
                {
             ?>

		  <div class="attachment-block clearfix">
            <!-- <img class="attachment-img" src="uploads/img/<?/*php echo $row1['image']; */?>" alt="Attachment Image">-->
              <div class="attachment-pushed">
                <h4 class="attachment-heading"><a href="view-fnews-post.php?id=<?php echo $row['id_fakepost']; ?>"><?php echo $row['title']; ?></a> <span class="attachment-heading pull-right"><?php echo $row['createdat']; ?></span></h4>
                <div class="attachment-text">
                    <div><strong><?php echo $row1['first_name']; ?> | <?php echo $row1['city']; ?> |<?php echo $row1['state']; ?></strong></div>
                </div>
              </div>
          </div>

		<?php
			}
		}
	}
}

$conn->close();