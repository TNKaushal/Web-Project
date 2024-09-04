<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Responsive Web Project</title>

    <!-- CSS Link -->
    <link rel="stylesheet" href="loginstyle.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="footnav.css">
    
    <!-- JOST Font Importing from Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- INTER Font Importing from Google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
   
    <!-- CDNJS Font Awsome Tool -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   
    <!-- Boxicon Stylesheet -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">



</head>
<body>

        <nav>
            <div class="nav-bar">
              <i class="bx bx-menu sidebarOpen"></i>
              <span class="logo navLogo"><img id="logo" src="img/logotp1.png" alt="Logo"></span>
              <div class="menu">
                <div class="logo-toggle">
                  <span class="logo"><img id="sidebar-logo" src="img/logotp1.png" alt="Sidebar Logo"></span>
                  <i class="bx bx-x sidebarClose"></i>
                </div>
                <ul class="nav-links">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="Men's Shoes.php">Men's Shoes</a></li>
                    <li><a href="Women's Shoes.php">Women's Shoes</a></li>
                    <li><a href="Kids' Shoes.php">Kids' Shoes</a></li>
                    <li><a href="sale.php">Sale</a></li>
                </ul>
              </div>
                
                <div class="cart-btn">
                  <a href="cart.php"><i class="bx bx-cart cart"></i></a>
                </div>
            
              <div class="login-btn">

            <!-- PHP Session details. Do not change php contents -->
              <?php
              if(isset($_SESSION["usersname"]))
                {
                    echo '<a href="profile.php" class="link">
                            <span class="link-icon">
                                <i class="bx bx-user"></i>
                            </span>
                            <span class="link-title">'.$_SESSION["usersname"].'</span>
                        </a>';

                    echo '<a href="includes/logout.inc.php" class="link">
                        <span class="link-icon">
                            <i class="bx bx-log-out"></i>
                        </span>
                        <span class="link-title">Logout</span>
                        </a>';

                }
                else
                {
                    echo '<a href="login.php" class="link">
                            <span class="link-icon">
                                <i class="bx bx-user"></i>
                            </span>
                            <span class="link-title">Login</span>
                        </a>';
                }
                ?>

              <!-- End of php session part -->

              </div>


                <!-- <div class="login-btn"></a>
                  <a href="login.php"><i class="bx bx-user user"></i></a>
                </div> -->

                <div class="searchBox">
                    <div class="searchToggle">
                      <i class="bx bx-x cancel"></i>
                      <i class="bx bx-search search"></i>
                </div>

                <div class="search-field">
                <input type="text" placeholder="Search..." />
                <i class="bx bx-search"></i>
              </div>
           </div>
        </div>
     </div>
 </nav>

  

    
        