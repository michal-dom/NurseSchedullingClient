<?php
/**
 * Created by PhpStorm.
 * User: Michał Domagała
 * Date: 2018-05-02
 * Time: 22:49
 */
error_reporting(E_ALL ^ E_NOTICE);



//echo MainTableView;

//echo json_encode('test3');


    if(isset($_SESSION['mail']) && isset($_SESSION['pass'])){
        $mail = $_POST['mail'];
        $password = $_SESSION['pass'];


        $conn = mysqli_connect('localhost','root','','nurse');

        $data = mysqli_query($conn, "SELECT * FROM users WHERE mail='{$mail}' AND password='{$password}'");

        $row_cnt = mysqli_num_rows($data);

        if($row_cnt == 1){
            $row = mysqli_fetch_array($data);
            $id = $row['id_nurse'];

            $data = mysqli_query($conn, "SELECT * FROM nurses WHERE id = '{$id}'");
            $row = mysqli_fetch_array($data);

            $firstname = $row['name'];
            $surname = $row['surname'];
            $type = $row['type'];
            $work_hours = $row['work_hours'];

            session_start();
            $_SESSION['user_id'] = $id;
            $_SESSION['mail'] = $mail;
            $_SESSION['firstname'] = $firstname;
            $_SESSION['surname'] = $surname;
            $_SESSION['type'] = $type;
            $_SESSION['work_hours'] = $work_hours;

            //administrator - tak na probe
            if($id == 1)
                require_once '../../adminpanel.html';
            else	//nurse
                require_once '../../nursepanel.html';
        }else{
            require_once '../../index.html';
        }


}