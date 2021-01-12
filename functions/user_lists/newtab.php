<?php
require_once "../db.php";
require_once "../session.php";
    // $pdo->query("CREATE TABLE inventory.24 ( nom VARCHAR(20) NOT NULL , classe VARCHAR(20) NOT NULL , 
    // type VARCHAR(20) NOT NULL , rarete VARCHAR(20) NOT NULL );");
    if (is_connected() && isset($_POST['title']) && isset($_POST['color'])){
        $title = $_POST['title'];
        $color = $_POST['color'];
        $tab_id = md5(uniqid());
        request("INSERT INTO tableaux VALUES( ?, ?, ?, CURRENT_TIMESTAMP, ? )",[$tab_id, $_SESSION['id'],$title,$color]); // Réference la page parmis les pages utilisateurs
        // $tab_id = $pdo->lastInsertId();
    
        request("CREATE TABLE IF NOT EXISTS inventory.usertab_$tab_id ( row_id INT NOT NULL AUTO_INCREMENT , PRIMARY KEY (row_id), cout INT(10) NOT NULL, nom VARCHAR(20) NOT NULL , classe VARCHAR(20) NOT NULL , 
        type VARCHAR(20) NOT NULL , rarete VARCHAR(20) NOT NULL );",[]); // Crée le tableau associé
        header("Location:/user_lists/user_list?tab_id=$tab_id");
    } else header("Location:/main/accueil");
?>