<?php
    session_start();
    if($_SESSION["role"]!="admin")
    {
        header("location:php/autologin1.php");
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <meta charset="UTF-8">
    <title>Edit Subjects</title>

<script>
function stud_suggestion()
{
var subject = document.getElementById("sub_select").value;
var xhr;
 if (window.XMLHttpRequest) { // Mozilla, Safari, ...
    xhr = new XMLHttpRequest();
} else if (window.ActiveXObject) { // IE 8 and older
    xhr = new ActiveXObject("Microsoft.XMLHTTP");
}
var data = "subject=" + subject;
     xhr.open("POST", "php/stud-suggestion.php", true); 
     xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");                  
     xhr.send(data);
     xhr.onreadystatechange = display_data;
    function display_data() {
     if (xhr.readyState == 4) {
      if (xhr.status == 200) {
      document.getElementById("students").innerHTML = xhr.responseText;
      } else {
        alert('There was a problem with the request.');
      }
     }
    }
}
</script>
</head>

<body>

        <link rel="stylesheet" href="css/bootstrap.min.css">

        <script src="js/jquery.js"></script>

        <script src="js/popper.js"></script>
        <script src="js/bootstrap.js"></script>
        <nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
            <!-- Brand -->
            <a class="navbar-brand" href="#"><img style="height: 75px" src="images/logo1.png"> Internals System</a>

            <!-- Toggler/collapsibe Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href=attendance.php class="nav-link ">New Attendance</a>
                    </li>
                    <li class="nav-item">
                        <a href=internals.php class="nav-link">Add Internals</a>
                    </li>
                    <li class="nav-item">
                        <a href=studentsList.php class="nav-link">View Students List</a>
                    </li>                   
                    <li class="nav-item">
                        <a href=report.php class="nav-link ">View Report</a>
                    </li>
                    <li class="nav-item">
                        <a href=profile.php class="nav-link active">Profile</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="php/logout1.php">Logout</a>
                    </li>

                </ul>
            </div>
        </nav>
        <br>    
        <br>    
        <br>
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h3 class="display-4">Edit Subjects</h3>
                <p class="lead">View and Edit Your Subject Details Here</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">

                <div class="card">
                    <div class="card-body">
                        <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="profile.php">Profile</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Subjects</li>
                          </ol>
                        </nav>
                        <br>
                        <div class="card">
                            <div class="card-body">
                                <h3>Add a Subject</h3>
                                <h5>
                                <form role="form" action="php/addSubject.php" method="post" class="login-form"><br>
                                    Subject Code <font color='red'>*</font>: <input type="text" class="form-control" name="Sid" placeholder="Eg: CS302" required><br>
                                    Subject Name <font color='red'>*</font>: <input type="text" class="form-control" name="Sname" placeholder="Eg: Basics of Electronics Engineering" required><br>
                                    Credits <font color='red'>*</font>: <select class='form-control' name = 'Credit'>
                                            <option value = '01'>1</option>
                                            <option value = '02'>2</option>
                                            <option value = '03'>3</option>
                                            <option value = '04'>4</option>
                                            <option value = '05'>5</option>
                                            <option value = '06'>6</option>
                                            <option value = '07'>7</option>
                                            <option value = '08'>8</option>
                                        </select><br>
                                    Semester <font color='red'>*</font>: <select class='form-control' name = 'Sem'>
                                            <option value = '01'>S1</option>
                                            <option value = '02'>S2</option>
                                            <option value = '03'>S3</option>
                                            <option value = '04'>S4</option>
                                            <option value = '05'>S5</option>
                                            <option value = '06'>S6</option>
                                            <option value = '07'>S7</option>
                                            <option value = '08'>S8</option>
                                        </select><br>
                                    Department <font color='red'>*</font>: 
                                        <select class='form-control' name = 'Dept'>
                                            <option value = '01'>Computer Science & Engineering</option>
                                            <option value = '02'>Civil Engineering</option>
                                            <option value = '03'>Electronics & Communications</option>
                                            <option value = '04'>Electrical & Electronics</option>
                                            <option value = '05'>Instrumentation & Communication</option>
                                            <option value = '06'>Mechanical Engineering</option>
                                        </select><br>
                                    <button class="btn btn-primary btn-lg btn-block" id="login-form-submit" name="login-form-submit" value="login">Submit</button>
                                </form>
                            </h5>
                            </div>
                        </div>
                        <?php
                        $Tid=$_SESSION['id'];
                        require("php/connect.php");
                        $sql= mysqli_query($conn,"SELECT * from subjects where `Tid` = '$Tid'");
                        echo "<br><br><h3>Subjects</h3><table style='width:100%' class='table'>
                                <thead class='thead-dark'>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Credit</th>
                                        <th>Semester</th>
                                        <th>Department</th>
                                    </tr>
                                </thead>
                                <tbody>";
                        if (mysqli_num_rows($sql)>0)
                            {
                                while ($row = mysqli_fetch_array($sql)){
                                    echo "<tr><td>$row[Sid] <a href='php/remove_subject.php?sub_id=$row[SIndex]'>(Remove)</a></td> <td>$row[Sname]</td> <td>$row[Credits]</td> <td>$row[Sem]</td>";
                                    $sql1= mysqli_query($conn,"SELECT * from department where `Did` = '$row[Dept]'");
                                    $row1 = mysqli_fetch_array($sql1);
                                    echo "<td>$row1[DName]</td>";
                                }
                            }
                            echo "</tbody></table>";
                           ?>
                           <div class="alert alert-danger" role="alert">
  Removing the Subject will remove the attendance & internal marks records as well. This action is irreversible. Check the Attendance records <a href="report.php" class="alert-link">here</a>.
</div>
                        </div>
                    </div>
                </div>
            </div>
<br/>
<br/>
</body>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</html>
