<?php 
    session_start();
    if( $_SESSION['loggedInEmail'] ){ ?>
    <!-------------------- for profile ------------->
    <div id="profile">
        <div class="profile-one"><p><?php echo $_SESSION['loggedInEmail']; ?> <i class="fas fa-caret-down"></i></p></div>
        <div class="profile-two">
            <ul>
                <li><a href="./php/profile.php">Profile</a></li>
                <!-- <li><a href="game_info.php">Participated Games</a></li> -->
                <li><a href="./php/logout.php">Log Out</a></li>
            </ul>
        </div>
    </div>
    <!-------------------------------->
<?php  }else{ ?>

    <a href="./php/login.php"><div class="login"><i class="fas fa-sign-in-alt"></i>
    <p>Login/SignUp</p></div></a>

<?php } ?>