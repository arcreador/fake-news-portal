<?php

//To Handle Session Variables on This Page
session_start();

if(empty($_SESSION['id_user'])) {
  header("Location: ../index.php");
  exit();
}

//Including Database Connection From db.php file to avoid rewriting in all files
require_once("../db.php");

//if user Actually clicked Add Post Button
if(isset($_POST)) {

	// New way using prepared statements. This is safe from SQL INJECTION. Should consider to update to this method when many people are using this method.


	

	
	//var_dump($stmt);
	//exit();

	$title = $_POST['title'];
	$description = $_POST['description'];
	$approval_status = "0";

	$title = mysqli_real_escape_string($conn, $_POST['title']);
	$description = mysqli_real_escape_string($conn, $_POST['description']);
	$approval_status = mysqli_real_escape_string($conn, $_POST['approval_status']);

			//This variable is used to catch errors doing upload process. False means there is some error and we need to notify that user.
		$uploadOk = true;

		//Folder where you want to save your image. THIS FOLDER MUST BE CREATED BEFORE TRYING
		$folder_dir = "uploads/img/";

		//Getting Basename of file. So if your file location is Documents/New Folder/myResume.pdf then base name will return myResume.pdf
		$base = basename($_FILES['image']['name']); 
		//This will get us extension of your file. So myimage.pdf will return pdf. If it was image.doc then this will return doc.
		$imageFileType = pathinfo($base, PATHINFO_EXTENSION); 

		//Setting a random non repeatable file name. Uniqid will create a unique name based on current timestamp. We are using this because no two files can be of same name as it will overwrite.
		$file = uniqid() . "." . $imageFileType; 

		//This is where your files will be saved so in this case it will be uploads/image/newfilename
		$filename = $folder_dir .$file;  
		//We check if file is saved to our temp location or not.
		if(!file_exists($filename)) { 

			//Next we need to check if file type is of our allowed extention or not. I have only allowed pdf. You can allow doc, jpg etc. 
			if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType=="svg")  {

				//Next we need to check file size with our limit size. I have set the limit size to 5MB. Note if you set higher than 2MB then you must change your php.ini configuration and change upload_max_filesize and restart your server
				if($_FILES['image']['size'] < 500000) { // File size is less than 5MB
					//If all above condition are met then copy file from server temp location to uploads folder.
					move_uploaded_file($_FILES["image"]["tmp_name"], "../".$filename);
					$image = $filename;
					$uploadOk=true;

				} else {
					//Size Error
					$_SESSION['uploadError'] = "Wrong Size. Max Size Allowed : 5MB";
					$uploadOk = false;
					
					exit();
				}
			} else {
				//Format Error
				$_SESSION['uploadError'] = "Wrong Format. Only jpg & png Allowed";
				$uploadOk = false;
				header("Location: create-job-post.php");
				exit();
			}
		} else {
				//File not copied to temp location error.
				$_SESSION['uploadError'] = "Something Went Wrong. File Not Uploaded. Try Again.";
				$uploadOk = false;
				echo "error";
		}

		//If there is any error then redirect back.
		if($uploadOk == false) {

			if(isset($_SESSION['uploadError'])) {
				$error= $_SESSION['uploadError'];
				echo $error;
				exit();
			}

			$image = "";
		}



	$id_user = $_SESSION['id_user'];
	$stmt = $conn->prepare("INSERT INTO fake_news(id_user, title, description, image, approval_status) VALUES(?, ?, ?, ?, ?)");
	$stmt->bind_param("issss", $id_user, $title, $description, $image, $approval_status);

	/*
		$query = "INSERT INTO job_post(id_company,fakenewstitle,aboutfake) VALUES('$id_company','$fakenewstitle','$aboutfake')";
		$query = "INSERT INTO job_post(id_company,fakenewstitle,aboutfake,createdat,image) VALUES('$id_company','$fakenewstitle','$aboutfake',NOW(),'$image')";
	$result = mysqli_query($conn,$query) or die(mysqli_error($conn));
	*/

	if($stmt->execute()) {
		//If data Inserted successfully then redirect to dashboard
		$_SESSION['jobPostSuccess'] = true;
		header("Location: index.php");
		exit();
	} else {
		//If data failed to insert then show that error. Note: This condition should not come unless we as a developer make mistake or someone tries to hack their way in and mess up :D
		echo "Error ";
	}

	$stmt->close();
	//THIS IS NOT SAFE FROM SQL INJECTION BUT OK TO USE WITH SMALL TO MEDIUM SIZE AUDIENCE
	//Insert Job Post Query 
	// $sql = "INSERT INTO job_post(id_company, jobtitle, description, minimumsalary, maximumsalary, experience, qualification) VALUES ('$_SESSION[id_company]','$jobtitle', '$description', '$minimumsalary', '$maximumsalary', '$experience', '$qualification')";
	// if($conn->query($sql)===TRUE) {
	// 	//If data Inserted successfully then redirect to dashboard
	// 	$_SESSION['jobPostSuccess'] = true;
	// 	header("Location: dashboard.php");
	// 	exit();
	// } else {
	// 	//If data failed to insert then show that error. Note: This condition should not come unless we as a developer make mistake or someone tries to hack their way in and mess up :D
	// 	echo "Error " . $sql . "<br>" . $conn->error;
	// }
	//Close database connection. Not compulsory but good practice.

	$conn->close();

} else {
	//redirect them back to dashboard page if they didn't click Add Post button
	header("Location: create-fnews-post.php");
	exit();
}