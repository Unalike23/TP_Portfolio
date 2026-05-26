<?php
function controleurPrincipal($action) {
    $lesActions = array();
    $lesActions["defaut"] = "jouets.php";
    $lesActions["jouets"] = "jouets.php";
    $lesActions["statistiques"] = "statistiques.php";

    if (array_key_exists($action, $lesActions)) {
        return $lesActions[$action];
    } else {
        return $lesActions["defaut"];
    }
}
?>
