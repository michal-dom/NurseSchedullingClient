<?php
/**
 * Created by PhpStorm.
 * User: Michał Domagała
 * Date: 2018-05-03
 * Time: 12:48
 */

require_once ("../data.base.handler/Connection.php");

if(isset($_POST)) {

    if ($_POST['opt'] == 1) {

        $reg = Connection::getInstance();
        $pdo = $reg->getPdo();

        $mail = $_POST['mail'];
        $pass = $_POST['pass'];

        if($mail == "admin"){
            $select_week_stmt = $pdo->prepare("SELECT * FROM users WHERE mail='$mail' AND password='$pass'" );
        }else{
            $select_week_stmt = $pdo->prepare("SELECT * FROM users INNER JOIN nurses ON nurses.id = users.id_nurse WHERE mail='$mail' AND password='$pass'" );
        }

        $select_week_stmt->execute([]);

        echo json_encode($select_week_stmt->fetchAll());

    }

    if ($_POST['opt'] == 2) {
        $reg = Connection::getInstance();
        $pdo = $reg->getPdo();

        $mail = $_POST['mail'];
        $pass = $_POST['pass'];

        error_log($mail);
        error_log($pass);

        $select_week_stmt = $pdo->prepare("SELECT * FROM users INNER JOIN nurses ON nurses.id = users.id_nurse WHERE mail='$mail' AND password='$pass'" );
        $select_week_stmt->execute([]);


        echo json_encode($select_week_stmt->fetchAll());


    }

}