<?php
    require_once('dbConnectLogin.php');
 ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Eclipse GYM MIS</title>
    <!-- Favicon-->
    <link rel="icon" href="assets/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="assets/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="assets/plugins/animate-css/animate.css" rel="stylesheet" />

    <link href="assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    <!-- Custom Css -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body class="login-page" style="background-color: #2E2E2E; margin-left: 410px; background-color: black;">
    <div class="login-box" style="width: 600px;">
        <div class="logo">
            <a href="login.php" style="color:green;"></a>
            <small style="color:blue;"><h4>Survey Application</h4></small>
        </div>
        <div class="card">
            <div class="body">
               <?php

                    if(isset($_POST['username'])&& isset($_POST['password'])){
                        
                        $username = $_POST['username'];
                        $password = md5($_POST['password']);
                        $stmt = $pdo->prepare("SELECT * FROM users WHERE username=? AND password=?");
                        $stmt->bindParam(1, $username);
                        $stmt->bindParam(2, $password);
                        $stmt->execute();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        $user = $row['username'];
                        $pass = $row['password'];
                        $id = $row['userID'];
                        $type = $row['userType'];
                        if($username==$user && $password==$pass){
                            session_start();
                            $_SESSION['username'] = $user;
                            $_SESSION['password'] = $pass;
                            $_SESSION['userID'] = $id;
                            $_SESSION['userType'] = $type;
                                if($type =="admin"){ ?>
                                    <script> window.location.href="admin/index.php"</script>
                                    <?php } 
                                        else($type =="coach") 
                                    ?>
                                <script> window.location.href="coach/index.php"</script>
                        <?php 
                        } else { ?>
                        <script>

                        window.location.href="login.php"</script>
                <?php     }
                } 
                ?>
                <form id="sign_in" method="POST">
                    <div class="msg">Sign in to start your session</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Name" required>
                        </div>
                        <span class="input-group-addon">
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
                        </div>
                        <span class="input-group-addon">
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="confirmpass" id="confirmpass" placeholder="Confirm Password" require>
                        </div>
                    </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="input-group">
                            <div class="col-md-3">
                                <label style="margin-top: 9px;">Date of Birth: </label>
                            </div>
                            <div class="col-md-3">
                                <?php
                                function get_date()
                                {
                                    $var="";
                                    for ($i = 1; $i < 31; $i++) {
                                        $num_padded=sprintf("%02d", $i);
                                        $var .='<option value="'.$i.'">  '.$num_padded.' </option>';
                                    }
                                    return $var;
                                }
                                ?>
                                <select class="form-control show-tick" name = "C_day">
                                    <option>Day</option>
                                    <?php echo get_date(); ?>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <?php
                                function get_month()
                                {
                                    $var="";
                                    for ($m=1; $m<=12; $m++) {
                                        $var .= '<option value="'.$m.'">'.date('F', mktime(0,0,0,$m, 1,      date('Y'))).' </option>';
                                    }
                                    return $var;
                                }
                                ?>
                                <select class="form-control show-tick" name = "C_month">
                                    <option>Month</option>
                                    <?php echo get_month(); ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <?php
                                function get_year($start,$end){
                                    $var="";
                                    while($start <= $end){
                                        $var .="<option value=".$start.">".$start."</option>";
                                        $start++;
                                    }
                                    return $var;
                                }
                                ?>
                                <select class="form-control show-tick" name="C_year">
                                    <option>Year</option>
                                    <?php echo get_year(1947,2017); ?>
                                </select>
                            </div>
                          </div>  
                        </div>
                        <div class="container-fluid">
                        <div class="row" style="margin-top:-10px;">
                            <div class="col-md-6">
                                 <label style="margin-left:-16px;">Country: </label>
                            </div>
                            <div class="col-md-6">
                                <select class="form-control show-tick" name="Country" style="margin-top:-8px; margin-left: 12px;">
                                    <option>Macedonia</option>
                                    <option>Philippines</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="radio">
                                <input type="radio" name="optradio"><label>I agree to the terms of use and privacy policy.</label>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4 pull-right">
                            <button class="btn btn-block bg-green waves-effect" name="btn-login" type="submit" data-type="success">Complete</button>
                        </div>
                        <div class="col-xs-4 pull-left">
                            <a href="login.php" class="btn btn-block bg-green waves-effect" role="button" name="btn-cancel" data-type="success">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="assets/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="assets/plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="assets/plugins/jquery-validation/jquery.validate.js"></script>

    <script src="assets/js/pages/ui/dialogs.js"></script>

    <script src="assets/plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Custom Js -->
    <script src="assets/js/admin.js"></script>
    <script src="assets/js/pages/examples/sign-in.js"></script>
</body>

</html>