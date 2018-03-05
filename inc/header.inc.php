<!-- Le header contient l'en-tête de la page. Le header contient 3 blocs
- > Le mot clé est HE- pour se repérer dans le css 
- > Le 1er bloc doit contenir le logo, -L
- > Le 2e bloc contient le titre et un peu de texte, -T
- > Le 3e bloc contient les liens pour se connecter, -C
résumé : HE, HEL, HET, HEC.
-->
<header>
    <div class="HEL_cont-logo">
        <img id="HEL_logo" src="../doc/607.jpg" alt="Logo : 607 /!\">
        <div id="HEL_mymodal">
            <span class="HEL_close">X</span>
            <img id="HEL_modal-img">
            <div id="HEL_img-alt"></div>
        </div>
    </div>
    <div class="HET_cont-titre">
        <h1>M2L - Maison des Ligues de Lorraine</h1>
        Site crée pour le projet BTS SIO (slam).
    </div>
<?php
    if(isset($_SESSION['login'])) {
?>
        <div class="HEC_cont-carre">
            <div class="HEC_carre">
                <a class="HEC_lien" href="../views/profil.php">Page de profil</a>
                <div class="HEC_drop-cont">
                    <span>OU</span>
                    <a class="HEC_drop-lien" href="../views/deconnexion.php">Se déconnecter</a>
                </div>
            </div>
        </div>
<?php
    } else {
?>
        <div class="HEC_cont-carre">
            <div class="HEC_carre">
                <a class="HEC_lien" href="../views/connexion.php">Se connecter</a>
                <div class="HEC_drop-cont">
                    <span>OU</span>
                    <a class="HEC_drop-lien" href="../views/inscription.php">S'inscrire</a>
                    <!--
                    <div class="HEC_drop-lien">
                        <a href="#">S'inscrire</a>
                    </div>-->
                </div>
            </div>
        </div>
<?php
    }
?>
</header>

<script>
// Get the modal
var modal = document.getElementById('HEL_mymodal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById('HEL_logo');
var modalImg = document.getElementById("HEL_modal-img");
var captionText = document.getElementById("HEL_img-alt");
img.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
}
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("HEL_close")[0];
// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
    modal.style.display = "none";
}
</script>