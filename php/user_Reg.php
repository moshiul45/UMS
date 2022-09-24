<?php
include_once 'dbh.class.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title id="title"></title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="../fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="../css/reg_style.css">
</head>

<body>

    <div class="main">

        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h3 id="h3" class="form-title"></h3>

                        <!-- Php doesn't insert data into database at the same time in POST and GET methods. That's why setting a GET method URL -->
                        <form action="user_Reg.php?id='<?php echo $_GET['id'] ?>'" method="POST" class="register-form"
                            id="register-form">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input user=<?php echo $_GET['id'] ?> type="text" name="name" id="name"
                                    placeholder="Enter Faculty's Name" />
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Enter Email" />
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="pass" id="pass" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="re_pass" id="re_pass" placeholder="Repeat password" />
                            </div>
                            <div class="form-group">
                                <label for="phone"><i class="zmdi zmdi-lock"></i></label>
                                <input type="number" name="phone" id="num" placeholder="Phone Number" />
                            </div>
                            <div class="form-group">
                                <label for="Address"><i class="zmdi zmdi-email"></i></label>
                                <input type="text" name="address" id="address" placeholder="Enter Address" />
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all
                                    statements in <a href="terms.class.php" class="term-service">Terms of
                                        service</a></label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register" />
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="../images/signup-image.jpg" alt="sign up image"></figure>
                        <a href="admin.php" class="signup-image-link">
                            <h3>Admin Dashboard</h3>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- JS -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../js/main.js"></script>
    <script>
    //User name and id is passed from admin page. So, using the URL, I Got the user_Role_id and according to user_Role _Id, below 4 if conditions are written to set the placeholders.
    var a = document.getElementById("name").getAttribute("user");

    function redirect() {
        var a = document.getElementById("name").getAttribute("user");
        window.location.href = "user_Reg.php?id=a";
    }
    if (a == 1) {
        document.getElementById("name").setAttribute("placeholder", "Enter Faculty Name");
        document.getElementById("h3").innerText = "Faculty Registration";
        document.getElementById("title").innerText = "Faculty Registration";
    }
    if (a == 2) {
        document.getElementById("name").setAttribute("placeholder", "Enter School Manager Name");
        document.getElementById("h3").innerText = "School Manager Registration";
        document.getElementById("title").innerText = "School Manager Registration";
    }
    if (a == 3) {
        document.getElementById("name").setAttribute("placeholder", "Enter HOD Name");
        document.getElementById("h3").innerText = "HOD Registration";
        document.getElementById("title").innerText = "HOD Registration";
    }
    if (a == 4) {
        document.getElementById("name").setAttribute("placeholder", "Enter University Authority Name");
        document.getElementById("h3").innerText = "University Authority Registration";
        document.getElementById("title").innerText = "University Authority Registration";
    }
    </script>

</body>

</html>

<?php
// }
class Registration extends Dbh
{
    public $name;
    public $phone;
    public $address;
    public $email;
    public $password;
}
if (isset($_POST['signup'])) {
    // Getting the id from the URL and putting it into a variable. Cause we can not insert directly GET method because form is sending data in POST method and PHP doesn't support both method at the same time.
    $a = $_GET['id'];

    $data = new Registration();

    //Generating a random string for email verification
    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['address'])) {
        echo "<script>alert('Please fill up all fields!');</script>";
        echo "<script type='text/javascript'>a = document.getElementById('name').getAttribute('user');
                window.location.href='user_Reg.php?id='+a;
                </script>";
    } else {
        if (isset($_POST['agree-term'])) {
            //below if condition is written if a email is already exist or not and later we used a condition to check that.
            $sql = $data->getData("select user_Email from user where user_Email='" . $_POST['email'] . "' ");
            $rows = $sql->fetch(PDO::FETCH_ASSOC);
            //If email is not registered yet
            if ($rows == null) {

                //checking if the password and confirm password are same
                if ($_POST['pass'] == $_POST['re_pass']) {

                    // if (!empty($_POST['name']) && !empty( $_POST['phone']) && !empty($_POST['address']) && !empty($_POST['email']) && !empty($_POST['pass'])){
                    $database = new Dbh();

                    //Inserting Data into faculty table
                    $database->connect($sql = "Insert into user(user_Name, user_Email, user_Phone, user_Address, user_Password,user_Role_Id) values('" . $_POST['name'] . "','" . $_POST['email'] . "','" . $_POST['phone'] . "','" . $_POST['address'] . "','" . $_POST['pass'] . "',$a)");
                    echo '<script>alert("New Record Added Successfully!")</script>';
                    echo "<script type='text/javascript'>a = document.getElementById('name').getAttribute('user');
                            window.location.href='user_Reg.php?id='+a;
                            </script>";
                } else {
                    echo '<script>alert("Password not matched")</script>';
                    echo "<script type='text/javascript'>a = document.getElementById('name').getAttribute('user');
                        window.location.href='user_Reg.php?id='+a;
                        </script>";
                }
            } else {
                echo '<script>alert("Email Already Exists!")</script>';
                echo "<script type='text/javascript'>a = document.getElementById('name').getAttribute('user');
                    window.location.href='user_Reg.php?id='+a;
                    </script>";
            }
        } else {
            echo "<script type='text/javascript'>alert('You Must Have to Agree to Continue!')</script>";
            echo "<script type='text/javascript'>a = document.getElementById('name').getAttribute('user');
                    window.location.href='user_Reg.php?id='+a;
                    </script>";
        }
    }
}
?>