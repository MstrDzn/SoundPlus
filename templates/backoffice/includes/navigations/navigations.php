<link rel="stylesheet" href="navigations.css"> 
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">


<nav class="sidebars_containers_navigations">
    <img src="../../static/images/logo_sound_png.png" height="auto" width="150px"  alt="">
    <nav>
        <ul>
            <li><a href=""><i class="fa-solid fa-table-columns"></i></a></li>
        </ul>
    </nav>
</nav>







<section id="popup" style="display:none;">
</section>


<script>
    document.addEventListener("DOMContentLoaded", function () {
    // Vérifier si l'utilisateur a déjà visité le site
    if (!localStorage.getItem("premiereConnexion")) {
        // Afficher le popup
        afficherPopup();

        // Marquer que l'utilisateur a visité le site
        localStorage.setItem("premiereConnexion", "true");
    }
});

function afficherPopup() {
    var popup = document.getElementById("popup");
    popup.style.display = "block";
}

function fermerPopup() {
    var popup = document.getElementById("popup");
    popup.style.display = "none";
}

</script>