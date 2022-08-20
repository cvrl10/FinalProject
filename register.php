<?php

    include('include/open.php');
    session_start();
?>
<!DOCTYPE html>
<html>
    <header>
        <link rel="stylesheet" href="css/index.css" type="text/css"/>
        <link rel="stylesheet" href="css/bootstrap.css" type="text/css"/>
        
        <script type="text/javascript" src="js/bootstrap.js"></script>
    </header>
    <body>

        <?php

            if(isset($_POST['submit'])):
                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $email = $_POST['email'];

                $statement = "SELECT (first_name) 
                              FROM Members
                              WHERE first_name='$first_name' AND last_name='$last_name'";
                
            
                $result = $conn->query($statement);
                $row = mysqli_fetch_array($result);
                if($row):
                    $statement = "SELECT (id) 
                                  FROM Members
                                  WHERE first_name='$first_name' AND last_name='$last_name'";

                    $result = $conn->query($statement);
                    $row = mysqli_fetch_array($result);
                    
                    if($row):
                        $id = $row['id'];
                    endif;
                    print("<script>
                                document.location = 'homepage.php';
                           </script>");
                           $_SESSION['first_name'] = $first_name;
                           $_SESSION['last_name'] = $last_name;
                           $_SESSION['id'] = $row['id'];
                endif;
            endif;
        ?>

        <!-- Pills navs -->
        <div class="container">
        <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="tab-login" data-mdb-toggle="pill" href="login.php" role="tab"
                aria-controls="pills-login" aria-selected="false">Login</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="tab-register" data-mdb-toggle="pill" href="#pills-register" role="tab"
                aria-controls="pills-register" aria-selected="true">Register</a>
            </li>
        </ul>

        <!-- Pills navs -->
        <div class="form" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
        
                <div class="text-center mb-3"></div>
      
                <!-- Name input -->
                <div class="form-outline mb-4">
                    <input name="first_name" type="text" id="registerName" class="form-control" />
                    <label class="form-label" for="registerName">First name</label>
                </div>

                <!-- Username input -->
                <div class="form-outline mb-4">
                    <input name="last_name" type="text" id="registerUsername" class="form-control" />
                    <label class="form-label" for="registerUsername">Last name</label>
                </div>

                <!-- Email input -->
                <div class="form-outline mb-4">
                    <input  name="email" id="registerEmail" class="form-control" /> <!--type="email"-->
                    <label class="form-label" for="registerEmail">Email</label>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <input name="password" type="password" id="registerPassword" class="form-control" />
                    <label class="form-label" for="registerPassword">Password</label>
                </div>

                <!-- Repeat Password input -->
                <div class="form-outline mb-4">
                    <input name="repeat" type="password" id="registerRepeatPassword" class="form-control" />
                    <label class="form-label" for="registerRepeatPassword">Repeat password</label>
                </div>

                <!-- Submit button -->
                <button name="submit" type="submit" class="btn btn-primary btn-block mb-3">Sign in</button>

            </form>
        </div>
        </div>
        <?php
            include('include/close.php');
        ?>
    </body>
</html>