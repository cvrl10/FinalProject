<?php 
    session_start();
    include('include/open.php');
?>
<!DOCTYPE html>
<html>

    <header>
        <title>homepage</title>

        <link rel="stylesheet" href="css/bootstrap.css" />
        <link rel="stylesheet" href="css/homepage.css" />
        <link rel="stylesheet" href="css/navigation_menu.css" />

        <script type="text/javascript" src="js/bootstrap.js"></script>
        <script type="text/javascript" src="js/interactive.js"></script>
        <cript src="//code.jquery.com/jquery-1.11.1.min.js"></script>

        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    </header>
    <?php
            $classes = ["Math", "Eng", "Hist", "Chem"];

            echo "<script>let button = null;</script>";




    ?>
                  
    <?php

        $conn->query('use info');
        if (isset($_POST['submit'])):
            for ($i = 0; $i<sizeof($classes); $i++)
            {
                $id = $_SESSION['id'];
                $class = $classes[$i];
                            
                if (isset($_POST[$classes[$i]]))
                {
                    $statement = "INSERT INTO $class (id)
                                  VALUES ($id)";
                    try
                    {
                        $result = $conn->query($statement);
                    }
                    catch (Exception $e)
                    {

                    }
                }
                else
                {

                    $statement = "DELETE FROM $class 
                                  WHERE id='$id'";

                    $result = $conn->query($statement);
                }
            }
        endif;
                                                                                               
    ?>

    <body img="img/background1.jpg">

        <div id="container" class="container">
            <div id="home">
            <button id="home_button" style="background-color:black"type="button" autofocus="autofocus" onclick="select(id)" onmouseover="over(id)" onmouseout="out(id)"><strong>Home</strong></button>
            </div>

            <div id="register">
                <button id="register_button" type="button" onclick="grid('visible'); select(id)" onmouseover="over(id)" onmouseout="out(id)"><strong>Register</strong></button>
            </div>
        </div>
        <div class="grid">

            <div class="panel sidebar" id="header">
                
                 INFO
                    
            </div>

            <div class="first">

                <em><?php print($_SESSION['first_name']);?></em>

            </div>

            <div class="last">

                <em><?php print($_SESSION['last_name']);?></em>

            </div>
    
            <div class="classes">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="classes" target="_self" >
                </form>
            </div>

            <?php

            for($i = 0; $i<sizeof($classes); $i++)
            {
                $obj = $classes[$i];
                $id = $_SESSION['id'];
                $statement = "SELECT (id)
                              FROM $classes[$i]
                              WHERE id='$id'";

                $result = $conn->query($statement);
                $row = mysqli_fetch_array($result);
                if (1 === is_null($row))
                print("<script>
        
                                grid('hidden');
                                button = document.getElementById($obj);
                                if (button !=null)
                                button.dispatchEvent(new MouseEvent('click'));

                      </script>");
            }
            print("<script>

                           let form = document.getElementById('classes');
                           formn.dispatchEvent(new Event('submit'));

                  </script>");

            ?>

            <div class="nav-side-menu">
                <div class="brand">bookworm</div>
                    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
                <div class="menu-list">
                    <ul id="menu-content" class="menu-content collapse out">
                            <li>
                                <a href="#">
                                    <i class="fa fa-dashboard fa-lg"></i> Dashboard
                                </a>
                            </li>

                            <li  data-toggle="collapse" data-target="#products" class="collapsed active" onclick="dropdown('products')">
                                <a href="#"><i class="fa fa-gift fa-lg"></i> Classes <span class="arrow"></span></a>
                            </li>
                            <ul class="sub-menu collapse" id="products">
                            <?php
                                if(isset($_POST['submit'])):
 
                                    for($i = 0; $i<sizeof($classes); $i++)
                                        if(isset($_POST[$classes[$i]]))
                                        {
                                            $class = $_POST[$classes[$i]];
                                            $id = $_SESSION['id'];

                                            $statement = "SELECT (id)
                                                          FROM $class
                                                          WHERE id='$id'"; 

                                            $result = $conn->query($statement);
                                            $row = mysqli_fetch_array($result);
                                            $id = $row['id'];
                                            
                                            $statement = "SELECT (midterm)
                                                          FROM $class
                                                          WHERE id='$id'"; 

                                            $result = $conn->query($statement);
                                            $row = mysqli_fetch_array($result);
                                            $midterm = $row['midterm'];

                                            $statement = "SELECT (final)
                                                          FROM $class
                                                          WHERE id='$id'"; 
                                            $result = $conn->query($statement);
                                            $row = mysqli_fetch_array($result);
                                            $final = $row['final'];

                                            print("<li onclick='report([$id, $midterm, $final])'>$classes[$i]</li>");
                                        }
                                endif;
                            ?>
                            </ul>


                            <li>
                                <a href="#">
                                    <i class="fa fa-user fa-lg"></i> Profile
                                </a>
                            </li>

                            <li>
                                <form id="exit" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                <input id="logout" name="logout" form="exit" type="text" hidden/>
                                <a href="login.php" onclick="logout('logout')">
                                    <i class="fa fa-users fa-lg"></i> Logout
                                    
                                    <?php
                                        if (isset($_POST['logout'])):
                                            session_destroy();
                                            echo $_SESSION['first_name'];
                                        endif;
                                    ?>
                                </a>
                                </form>
                            </li>
                    </ul>
                </div>
            </div>
            
        </div>
        <?php
            include('include/close.php');
        ?>
    </body> 
</html>