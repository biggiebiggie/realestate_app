<?php

if ($_SESSION) {
    echo '
    <nav>
    <div>
    <a href="index.php">TheRealDeal</a>
    </div>
    <div>
    <a href="profile.php">Profile</a>
    </div>
    <div>
    <a href="logout.php">Logout</a>
    </div>

    </nav>
  ';
} if (!$_SESSION) {
    echo '
    <nav>
    <div>
    <a href="index.php">TheRealDeal</a>
    </div>
    <div>
    <a href="login.php">Login</a>
    </div>
    <div>
    <a href="sign-up.php">Sign up</a>
    </div>

    </nav>
  ';
}
