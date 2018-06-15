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

        $timeout = 3 * 60; // 3 minutes
        $fingerprint = md5('SECRET-SALT'.$_SERVER['HTTP_USER_AGENT']);
        session_start();

        if(!is_null($select_week_stmt->fetchAll())){

        } else {
            error_log(json_encode($select_week_stmt->fetchAll()));
            $_SESSION['last_active'] = time();
            $_SESSION['fingerprint'] = $fingerprint;

            $_SESSION['mail'] = $mail;
            $_SESSION['pass'] = $pass;

            echo json_encode($select_week_stmt->fetchAll());
        }



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

        $raw = $select_week_stmt->fetchAll();

        session_start();

        $_SESSION['time'] = time();
        $_SESSION['mail'] = $raw[0]['mail'];
        $_SESSION['name'] = $raw[0]['name'];
        $_SESSION['surname'] = $raw[0]['surname'];
        $_SESSION['work_hours'] = $raw[0]['work_hours'];
        $_SESSION['type'] = $raw[0]['type'];

        echo json_encode($raw);


    }

}