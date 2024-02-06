<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">


<nav class="nav_containers_navigations">
    <img src="static/images/logo_sound_png.png" height="50px" width="auto"  alt="">

    <ul>
        <li><a href="index.php"><?php echo $translations['navigations']['home']; ?></a></li>
        <li><a href="about.php"><?php echo $translations['navigations']['about']; ?></a></li>
        <li><a href="events.php"><?php echo $translations['navigations']['events']; ?></a></li>
        <li><a href="index.php#faq"><?php echo $translations['navigations']['faq']; ?></a></li>
        <li><a href="#contact"><?php echo $translations['navigations']['contact']; ?></a></li>
    </ul>
    <div class="dropdown">
        <button class="dropbtn">Dropdown</button>
        <div class="dropdown-content">
            <a href="index.php"><?php echo $translations['navigations']['home']; ?></a>
            <a href="about.php"><?php echo $translations['navigations']['about']; ?></a>
            <a href="events.php"><?php echo $translations['navigations']['events']; ?></a>
            <a href="index.php#faq"><?php echo $translations['navigations']['faq']; ?></a>
            <a href="#contact"><?php echo $translations['navigations']['contact']; ?></a>
            <a href="templates/accounts/login.php"><?php echo $translations['navigations']['login']; ?></a>
            <a href="templates/accounts/signin.php"><?php echo $translations['navigations']['register']; ?></a>
        </div>
    </div>
    <div class="register_login_button_div">
        <a class="login_button" href="templates/accounts/login.php"><?php echo $translations['navigations']['login']; ?></a>
        <a class="register_button" href="templates/accounts/signin.php"><?php echo $translations['navigations']['register']; ?></a>
    </div>
</nav>


