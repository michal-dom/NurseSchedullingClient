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

if(isset($_POST)){

    if($_POST['opt'] == 1 ){
        require_once '../views/MainTableView.php';
    }
    if($_POST['opt'] == 2 ){
        require_once '../views/NurseTableView.php';
    }

}