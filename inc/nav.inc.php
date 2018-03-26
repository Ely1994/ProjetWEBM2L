<nav>
    <div class="NA1_cont-drop"> <!-- -->
        <a class="NA1_lien" href="../views/formation.php">Formations</a>
        <div class="NA1_list-lien">
            <a href="#">La formation uno</a>
            <a href="#">La formasion quatro</a>
            <a href="#">La formasion à quatre mille euros</a>
        </div>
    </div> 
    <div class="NA2_cont-drop"> <!-- -->
        <a class="NA2_lien" href="./index.php">Formations 2</a>
        <div class="NA2_list-lien">
            <a href="#">plop</a>
        </div>
    </div>
    <?php
    if(isset($_SESSION['login']) && isset($_SESSION['mdp'])) {
        $abc = estGrade($_SESSION['id']);
        if(estGrade($_SESSION['id']) == true) {
            ?>
            <div class="NAA_cont-drop"> <!-- affiché si utilisateur connecté et avec droits avancés -->
            <a class="NAA_lien" href="./index.php">Accès patron</a>
                <div class="NAA_list-lien">
                    <a href="#">Le parton c le boss</a>
                </div>
            </div> 
            <?php
        } else {

        }
    }
    ?>
</nav>