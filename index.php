<?php
session_start();
if (!isset($_SESSION['userid'])) {
    $_SESSION['userid'] = 0;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>	
        <title>My Gradebook</title>

        <!-- Override CSS file - add your own CSS rules -->
        <link rel="stylesheet" href="assets/css/styles.css">

    </head>
    <body>
        <div class="header">
            <div class="container">
                <h1 class="header-heading">My Gradebook</h1>
            </div>
        </div>
        <div class="nav-bar">
            <div class="container">
                <ul class="nav">
                    <?php                   
                    //check to see if the submit button was pushed
                    if ((isset($_POST['submit']))) {

                        require_once '.\controller\courseview.php';

                        //getting data input into the form and assigning
                        //it to variables
                        $userName = $_POST['userName'];
                        $password = $_POST['password'];

                        $status = select_user($userName, $password);

                        if ($status == 0) {
                            echo '<li><a href="index.php">Home</a></li>';
                        } else {
                            $_SESSION['userid'] = $status;

                            echo '<li><a href="index.php">Home</a></li>';
                            echo '<li><a href="gradebook.php">Courses</a></li>';
                        }
                    } else {
                        echo '<li><a href="index.php">Home</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div class="content">
            <div class="container">
                <div class="main">
                    <h1>Login</h1>
                    <div class="well">
                        <form name="login" id="login" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
                            <div class="form-group">
                                <label for="userName">User Name</label>
                                <input name="userName" type="text" class="form-control" id="userName" required="" maxlength="45">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input name="password" type="password" class="form-control" id="password" required="" maxlength="45">
                            </div>                                                
                            <button name="submit" type="submit" class="btn btn-primary">Login</button>
                        </form>
                        <?php
                        //check to see if the submit button was pushed
                        if ((isset($_POST['submit']))) {
                            if ($status == 0) {
                                echo '<p class="help-block">You\'re not a valid user of My Gradebook!</p>';
                            } else {
                                $_SESSION['userid'] = $status;
                                echo '<p class="help-block">Welcome to My Gradebook!</p>';
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="aside">
                    <h3>My Gradebook</h3>
                    <p>
                        My Gradebook allows professors
                        to view the courses information for the courses they are teaching. 
                    </p>                   
                    <p>
                        In order to view their courses, professors must
                        enter their username and password and push Login.
                    </p>
                    <p>
                        If they are valid users, they will see a welcome message
                        stating that and they will have access
                        to the Courses page.
                    </p>
                    <p>
                        If they are not valid users, they will see a message
                        stating they are not a valid user and they will not have access
                        to the courses page.
                    </p>
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="container">
                My GradeBook
            </div>
        </div>
    </body>
</html>