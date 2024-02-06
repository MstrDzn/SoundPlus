<?php
// Start the session
session_start();

$userId = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="icon" type="image/png" href="images/favicon.png" />
    <link rel="stylesheet" href="css/loading_account.css">
    <title>FeelVibes</title>
  </head>
  <body>
    <main>
        <section>
            <img src="images/logo_nobg.png" width="200px" height="200px" alt="">
            <h1>slogan</h1>
            <img src="" alt="">
        </section>




        <section class="animate__animated animate__fadeInRightBig animate__slow" id="section2">
          <div>
            <form action="back_end_post/process_create_enterprise.php" method="post">
              <div>
                <i class="fa-solid fa-city"></i>
                <input type="text" id="name" name="name" placeholder="Company Name"><br>
              </div>

                  <input type="submit" value="Create">
            </form>

            <p> OR </p>

            <form action="back_end_post/process_join_enterprise.php" method="post">
              <div>
                <i class="fa-solid fa-key"></i>
                <input type="password" id="password" name="password" placeholder="Company password"><br>
              </div>

                  <input type="submit" value="Join">
            </form>
          </div>
        </section>



    </main>
  </body>
</html>






<script>
  function changeSection(event, sectionId) {
    event.preventDefault();
    document.getElementById('section1').style.display = 'none';
    document.getElementById(sectionId).style.display = 'flex';
  }
</script>
