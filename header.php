<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <a href="index.php" class="logo">
                        <img src="img/logo2.png" alt="">
                    </a>
              
                    
                    <ul class="nav">
                        
                        <?php 
                        if (empty($_SESSION['user'])){
                           echo " <li><a class='active' href='SignUp.php'>Join US</a></li>" ;
                        }
                        else{
                            if ($_SESSION['role']!="ClubPresident"&&$_SESSION['role']=="admin"){
                                echo " <li><a class='active' href='manage_users.php'>Manage Users</a></li>" ;
                            }
                            else{
                                if ($_SESSION['role']=="ClubPresident"){
                                echo " <li><a class='active' href='add_events.php'>Add Events</a></li>" ;
                                echo " <li><a class='active' href='manage_events.php'>Manage Events</a></li>" ;
                            }

                            }
                        }
                        ?>
                        <?php
                            
                                if (!empty($_SESSION['user'])){
                                    echo "<li><a class='active' href='my_archive.php'>My Reservations</a></li>" ;
                                }
                        ?>
                        <li><a class='active' href="clubs.php">Our Clubs</a></li>
                        <li><a  class='active' href="all_events.php">Our Events</a></li>
                        <?php 
                        if (empty($_SESSION['user']))
                            { echo"<li><a href='login.php'>Login <img src='https:/cdn-icons-png.flaticon.com/512/6681/6681204.png' ></a></li>" ;} 
                        else
                            { echo"<li><a href='Logout.php'>LogOut <img src='https://cdn-icons-png.flaticon.com/512/3580/3580154.png' ></a></li>" ;} 
                    

                        ?>
                    </ul>   
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                </nav>
            </div>
        </div>
    </div>
  </header>


