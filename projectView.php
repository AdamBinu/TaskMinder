<?php
session_start();
include('config.php');

$desc = 'Sample Project Description';		// Project description variable
$projTitle = 'Sample Project Title';

// If project title is passed in URL, retrieve project description from project's table in database
if (isset($_GET['title'])) {
	$conn = OpenCon();
	$projTitle = $_GET['title'];
    	$query = "SELECT description FROM `" . $projTitle . "`;";
	$result = $conn->query($query);
	CloseCon($conn);


        if ($result->num_rows > 0) {
      		error_log( $projTitle . " description read successfully\n", 0);
		while($row = $result->fetch_assoc()) {
			$desc = $row['description'];
		}
	} else {
       		error_log( "No results for " . $projTitle . "\n");
        }

} else {
    error_log("No title variable passed to project page",0);
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="dashBoard.css">
<link rel="stylesheet" href="taskboard.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Hybrid Project Management System</title>
  </head>
  <body>
    <div id="viewport">
    <!-- Sidebar -->
    <div id="sidebar">
      <header>
        <a href="dashBoard.html">HPMS</a>
      </header>
      <nav class="navbar-dark bg-dark">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="sampledash.php">Projects</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Team</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Documents</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="taskboard.php">TaskBoard</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="#">Schedule Model</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="#">RACI</a>
          </li>
          <a class="nav-link" href="#">Communication Plan</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="#">Risk Register</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="#">Solution Architecture</a>
          </li>
		<li class="nav-item">
		<a class="nav-link" href="serviceDelivery.php?title=<?php echo $projTitle; ?>">SDD </a>
		</li>
        </ul>
      </nav>
    </div>

    <!-- Content -->
    <div id="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <br>
	<h1 contenteditable="false" id="title"><?php echo $projTitle; ?></h1>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <br>
	  <div class="form-control" rows="10" id="description"><?php echo $desc; ?></div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <br>
        <button class="btn btn-primary" id="editBtn">Edit</button>
      </div>
    </div>
  </div>
</div>

<script>
const title = document.getElementById('title');
const description = document.getElementById('description');
const editBtn = document.getElementById('editBtn');

// Load data from localStorage
//window.addEventListener('load', () => {
//title.textContent = localStorage.getItem('title') || 'Project Title';
//description.textContent = localStorage.getItem('description') || 'Project Description';
//});

// Load data from database
title.textContent = <?php echo $projTitle; ?>;
description.textContent = <?php echo $desc; ?>;

// Save data to localStorage
function saveData() {
localStorage.setItem('title', title.textContent);
localStorage.setItem('description', description.textContent);
}

// Enable/disable edit mode
function toggleEditMode() {
if (title.isContentEditable) {
  title.contentEditable = false;
  description.contentEditable = false;
  editBtn.textContent = 'Edit';
  saveData();
} else {
  title.contentEditable = true;
  description.contentEditable = true;
  editBtn.textContent = 'Save';
}
}

// Event listener for edit button
editBtn.addEventListener('click', toggleEditMode);

</script>

  </body>
</html>
