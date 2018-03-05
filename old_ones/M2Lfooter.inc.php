
<footer>
    <h2>Crois-tu au duel que se livrent les cookies du côté obscur et ceux du côté pas obscur ?</h2><p>
    <?php if(isset($_COOKIE['darkcookie'])==TRUE) {
        echo "Tu disposes de ".$_COOKIE['darkcookie']." cookies obscurs.";
        ?>
        </p><p>
        <?php
    } else {
        echo "oh non vous n'avez pas de cookie obscurs";
        ?>
        </p><p>
        <?php
    }
    if(isset($_COOKIE['holycookie'])==TRUE) {
        echo "Tu disposes de ".$_COOKIE['holycookie']." cookies qui ont étés renforcés par la lumière sacrée.";
    } else {
        echo "oh non vous n'avez pas de cookie qui ont été renforcés par la lumière sacrée";
    }  ?>
    </p>
</footer>