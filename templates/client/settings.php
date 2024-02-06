<?php
session_start(); // Assurez-vous que la session est démarrée

// Obtenez la langue à partir des paramètres d'URL, des cookies, etc.
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';

// Chargez le fichier de langue correspondant
$translations = include "../../lang/$lang.php";

// Si le formulaire est soumis, mettez à jour la langue
if (isset($_POST['lang'])) {
    $lang = $_POST['lang'];
    $translations = include "../../lang/$lang.php";
}
include("includes/getUsersInfo.php");

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:wght@300&family=Montserrat:ital,wght@0,100;0,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="icon" type="image/png" href="../static/images/favicon.png" />
    <link rel="stylesheet" href="includes/navigations/navigations.css">
    <link rel="stylesheet" href="css/settings.css">

    <title><?php echo $translations['settings_client_page']['page_title']; ?></title>

</head>
<body>
    <?php include("includes/navigations/navigations.php"); ?>

    <main>
        <h1 class="title_page">Settings</h1>
        <ul>
            <li><a class="active" href="#" onclick="changeSection(event,'home_containers')">Edit Profile</a></li>
            <li><a href="#" onclick="changeSection(event,'account')">Account</a></li>
            <!--
            <li><a href="#" onclick="changeSection(event,'billing')">Billing</a></li>
            <li><a href="#" onclick="changeSection(event,'subscriptions')">Subscriptions</a></li>
            -->
            <li><a href="#" onclick="changeSection(event,'notifications')">Notifications</a></li>
            <?php
            if ($role === 'Owner' or $role === 'Technician' ) :
            ?>
                <li><a href="#" onclick="changeSection(event,'enterprise')">Enterprise</a></li>
            <?php
            endif;
            ?>
        </ul>



        <section id="home_containers" class="home_containers">

            <div class="settings_editprofile">

                <div class="profile_card">
                    <h1>Profile Photo</h1>
                    <div class="sub_container">
                        <div class="left_containers">
                            <div class="photo_profile_rounded">

                            </div>
                            <div class="button_containers">
                                <a href="" class="button_upload">Upload Photo</a><br>
                                <a href="" class="button_remove">Remove</a>
                            </div>
                        </div>
                        <div class="right_containers">
                            <h4>Image requirments:</h4>
                            <p>1. Min.  400 x 400px <br>2. Max. 2MB <br>3. Your face or company logo <br></p>
                        </div>
                    </div>
                </div>

                <div class="profile_form_card">
                    <form action="actions/profile_update.php" method="post">
                        <div class="inline">
                            <div class="column">
                                <label for="Last Name">Last Name</label>
                                <input type="text" required id="lastname" name="lastname" placeholder="LastName">
                            </div>

                            <div class="column">
                                <label for="First Name">First Name</label>
                                <input type="text" required id="firstname" name="firstname" placeholder="First Name">
                            </div>
                        </div>

                        <label for="Email">Email Adress</label>
                        <input type="email" id="email" required name="email" placeholder="Email Adress">

                        <br>
                        <div class="inline">
                            <div class="column">
                                <label for="Password">Password</label>
                                <input type="password" required id="password" name="password" placeholder="Password">
                            </div>

                            <div class="column">
                                <label for="ConfirmPassword">Confirm Password</label>
                                <input type="password" required id="confirmpassword" name="confirmpassword" placeholder="Confirm Password">
                            </div>
                        </div>

                        <input type="submit" value="Update">

                    </form>
                </div>
            </div>

        </section>
        

        <section id="account" class="tasks_containers">
        <div class="notifications_sub_containers">
                <h1>Account</h1>
                <button class="delete" onclick="openPopup()" >Delete Account</button>
            </div>
        </section>

        <section id="billing" class="documents_containers">
            
        </section>

        <section id="subscriptions" class="tasks_containers">
            
        </section>

        <section id="notifications" class="notifications_containers">
            <div class="notifications_sub_containers">
                <h1>Notifications</h1>
                <div class="notifications_box">
                    <div>
                        <p>Enable email notifications :</p>
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <br>
                    <div>
                        <p>Enable push notifications :</p>
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <br>
                    <div>
                        <p>Receive notifications related to friends or contacts :</p>
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <br>
                    <div>
                        <p>Notification reception system :</p>
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
            </div>
        </section>

        <section id="enterprise" class="notifications_containers">
            <div class="notifications_sub_containers">
                <h1>Enterprise</h1>
                <?php include "includes/getEnterpriseCode.php"; ?>

            </div>
        </section>
    </main>


</body>
</html>


<div id="popup">
    <h5>Are you sure you want to delete your account ?</h5>
    <br>
    <div>
        <button onclick="closePopup()">Close</button>
        <button class="delete"><i class="fa-solid fa-ban"></i> Deleted</button>
    </div>
</div>

<script>
        function changeSection(event, sectionId) {
            event.preventDefault();
            document.getElementById('home_containers').style.display = 'none';
            document.getElementById('subscriptions').style.display = 'none';
            document.getElementById('account').style.display = 'none';
            document.getElementById('billing').style.display = 'none';
            document.getElementById('notifications').style.display = 'none';
            document.getElementById('enterprise').style.display = 'none';
            document.getElementById(sectionId).style.display = 'block';
        }
</script>

<script src="js/pop_up.js"></script>