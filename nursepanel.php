<!DOCTYPE html>
<?php session_start();?>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Lato:300" rel="stylesheet">
    <link href="css/nursepanel.css" type="text/css" rel="stylesheet">
    <script>
        $(document).ready(function(){
            $("#checkduty").click(function(){
                $("#myduty").show();
                $("#mydata").hide();
                $("#mycontact").hide();
            });

            $("#checkdata").click(function(){
                $("#myduty").hide();
                $("#mydata").show();
                $("#mycontact").hide();
            });

            $("#generate-pdf").click(function(){
                $.ajax({
                    url: "php/generators/pdf.php",
                    type: "POST",
                    dataType: "json"

                }).done(function (msg) {
                    console.log(msg);
                })
            });

            $("#generate-pdf").click(function(){
                $.ajax({
                    url: "php/generators/pdf.php",
                    type: "POST",
                    dataType: "json"

                }).done(function (msg) {
                    console.log(msg);
                })
            });

            $("#contact").click(function(){
                $("#myduty").hide();
                $("#mydata").hide();
                $("#mycontact").show();
            });

        });
    </script>
</head>
<body>

<div id="header">
    Welcome <?php       echo $_SESSION['name']." ".$_SESSION['surname'];   ?><br>
    <span>nurse panel</span>
    <div id="logout">
        <a href="php/controllers/LogoutController.php">logout</a>
    </div>
</div>

<div id="side-panel">
    <br />
    <ul>
        <div id="checkduty" class="menu-btn">Check duty</div>
        <div id="checkdata" class="menu-btn">Check my data</div>
        <div id="contact" class="menu-btn">Contact to administrator</div>
        <br>

        <div id="generate-exc" class="menu-btn">

            <form method="post" action="php/generators/export.php">
                <input type="submit" name="export" class="btn btn-success" style="margin-top: 10px" value="EXCEL" />
            </form>
        </div>


        <div id="generate-pdf" class="menu-btn">
            <form method="post" action="php/generators/pdf.php">
                <input type="submit" name="pdf" class="btn btn-success" value="PDF" />
            </form>
        </div>
    </ul>
</div>

<section class="content">
    <p class="data" id="myduty" style="display: none;">
        <img src="img/n1.jpg" alt="Avatar"><br><br>
        Type of work: <?php             echo $_SESSION['type'];                 ?><br><br>
        Time:             <?php         echo $_SESSION['work_hours']." hours";  ?><br><br>
    </p>

    <p class="data" id="mydata">
        <img src="img/n1.jpg" alt="Avatar"><br><br>
        Name:             <?php         echo $_SESSION['name'];    ?><br><br>
        Surname:          <?php         echo $_SESSION['surname'];              ?><br><br>
        E-mail:           <?php         echo $_SESSION['mail'];                 ?><br><br>
    </p>

    <p class="data" id="mycontact" style="display: none;">
        <img src="http://cdn.onlinewebfonts.com/svg/img_181369.png"><br><br>
        <b>Contact administrator</b><br><br>
        <b>E-mail:</b> nurseshedule.admin@gmail.com<br>
        <b>Phone:</b> 123-123-123<br>
    </p>
</section>
</body>
</html>