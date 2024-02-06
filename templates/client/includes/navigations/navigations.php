<link rel="stylesheet" href="navigations.css"> 
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

<?php
// Obtenez le nom de la page actuelle à partir de l'URL
    $current_page = basename($_SERVER['PHP_SELF']);
?>
<section class="sidebars_containers_navigations">
    <img src="../../static/images/logo_sound_png.png" height="auto" width="150px" alt="">

    <div class="rounded_menu">
        <a <?php if ($current_page == 'messaging.php') echo 'class="active_r" disabled="disabled"'; ?> href="messaging.php"><i class="fa-solid fa-user fa-lg"></i></a>
        <a <?php if ($current_page == 'settings.php') echo 'class="active_r"'; ?> href="settings.php"><i class="fa-solid fa-gear fa-lg"></i></a>
        <a href="#" onclick='afficherPopup()' ><i class="fa-solid fa-bell fa-lg"></i></a>
    </div>

    <ul class="tabs">
        <li><a <?php if ($current_page == 'dashboard.php') echo 'class="active"'; ?> href="dashboard.php"><i class="fa-solid fa-house fa-lg"></i> <?php echo $translations['navigations']['home']; ?></a></li>
        <li><a <?php if ($current_page == 'sensor.php') echo 'class="active"'; ?> href="sensor.php"><i class="fa-solid fa-satellite-dish fa-lg"></i> <?php echo $translations['navigations']['sensor']; ?></a></a></li>
        <li><a <?php if ($current_page == 'events.php') echo 'class="active"'; ?> href="events.php"><i class="fa-solid fa-calendar-days fa-lg"></i> <?php echo $translations['navigations']['events']; ?></a></li>
        <li><a <?php if ($current_page == 'messaging.php') echo 'class="active"'; ?> href="messaging.php"><i class="fa-solid fa-comments fa-lg"></i> <?php echo $translations['navigations']['messaging']; ?></a></li>
    </ul>

    <ul class="bottom">
         <li><a <?php if ($current_page == 'support.php') echo 'class="active_s"'; ?>  href="support.php"><i class="fa-solid fa-circle-question fa-lg"></i> <?php echo $translations['navigations']['support']; ?></a></li>
        <li><a href="../../includes/logout.php"><i class="fa-solid fa-arrow-right-from-bracket fa-lg"></i> <?php echo $translations['navigations']['logout']; ?></a></li>
    </ul>
</section>








<section id="popup_notifications" class="popup_notifications" style="display:none;">
    <div class="header_norifications">
        <h1>Notifications</h1>
        <a href="#" onclick='fermerPopup()'><i class="fa-regular fa-circle-xmark fa-lg"></i></a>

    </div>

    <div class="notifications_list">

    </div>
</section>


<script>
function afficherPopup() {
    var popup = document.getElementById("popup_notifications");
    popup.style.display = "flex";
}

function fermerPopup() {
    var popup = document.getElementById("popup_notifications");
    popup.style.display = "none";
}

</script>