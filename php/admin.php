<?php
    // if (isset($_SESSION['id'])){
    include "dbh.class.php";
    $data=new dbh();
    $sql=$data->getdata("SELECT COUNT(id) from student; ");
    $sql1=$data->getdata("SELECT COUNT(Id) from user where user_Role_Id=1; ");
    $sql2=$data->getdata("SELECT COUNT(Id) from user where user_Role_Id=2;");
    $sql3=$data->getdata("SELECT COUNT(Id) from user where user_Role_Id=4;");
    $sql4=$data->getdata("SELECT COUNT(Id) from user where user_Role_Id=3; ");
    $row=$sql->fetch(PDO::FETCH_ASSOC);
    $row1=$sql1->fetch(PDO::FETCH_ASSOC);
    $row2=$sql2->fetch(PDO::FETCH_ASSOC);
    $row3=$sql3->fetch(PDO::FETCH_ASSOC);
    $row4=$sql4->fetch(PDO::FETCH_ASSOC);
    
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/admin.css">

</head>

<body>
    <header>
        <span>
            Admin Dashboard
        </span>
        <a class="log" href="logout.php"><button>Log Out</button></a>
    </header>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2">
                <div class="sidebar">
                    <a href="studentreg.php">+ Add Student</a>
                    <a id="faculty" href="#" onclick="usercheck(this)">+ Add Faculty</a>
                    <a id="schoolmanager" href="#" onclick="usercheck(this)">+ Add School Manager</a>
                    <a id="HOD" href="#" onclick="usercheck(this)">+ Add HOD</a>
                    <a id="universityauthority" href="#" onclick="usercheck(this)">+Add Univeristy
                        Authority</a>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="student">
                            <p>Total HOD</p>
                            <span><?php echo $row2['COUNT(Id)']; ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="student">
                            <p>Total Students</p>
                            <span><?php echo $row['COUNT(id)']; ?></span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="student">
                            <p>Total Faculties</p>
                            <span><?php echo $row1['COUNT(Id)']; ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="student">
                            <p>Total School Managers</p>
                            <span><?php echo $row3['COUNT(Id)']; ?></span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="student">
                            <p>Total University Authorities</p>
                            <span><?php echo $row4['COUNT(Id)']; ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
    <script>
    // This function is created to check which button is clicked from the admin side menu and according to that button it will create a GET link so that we can GET the value from user_Reg page
    function usercheck(e) {
        if (e.getAttribute("id") == "faculty") {
            window.location.href = "user_Reg.php?user=faculty&id=1";
        }
        if (e.getAttribute("id") == "schoolmanager") {
            window.location.href = "user_Reg.php?user=schoolmanager&id=2";
        }
        if (e.getAttribute("id") == "HOD") {
            window.location.href = "user_Reg.php?user=HOD&id=3";
        }
        if (e.getAttribute("id") == "universityauthority") {
            window.location.href = "user_Reg.php?user=universityauthority&id=4";
        }
    }
    </script>

</body>

</html>