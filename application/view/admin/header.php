<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo URL; ?>assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="<?php echo URL; ?>assets/img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Administrator</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="<?php echo URL; ?>assets/css/bootstrap.min.css" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="<?php echo URL; ?>assets/css/material-dashboard.css?v=1.2.0" rel="stylesheet" />
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="<?php echo URL; ?>assets/css/demo.css" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
    <!--   Core JS Files   -->
    <script src="<?php echo URL; ?>assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="<?php echo URL; ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo URL; ?>assets/js/material.min.js" type="text/javascript"></script>
    <!--  Charts Plugin -->
    <script src="<?php echo URL; ?>assets/js/chartist.min.js"></script>
    <!--  Dynamic Elements plugin -->
    <script src="<?php echo URL; ?>assets/js/arrive.min.js"></script>
    <!--  PerfectScrollbar Library -->
    <script src="<?php echo URL; ?>assets/js/perfect-scrollbar.jquery.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="<?php echo URL; ?>assets/js/bootstrap-notify.js"></script>
    <!-- Material Dashboard javascript methods -->
    <script src="<?php echo URL; ?>assets/js/material-dashboard.js?v=1.2.0"></script>
    <script src="<?php echo URL; ?>assets/js/sweetalert.min.js"></script>

</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-color="blue" data-image="<?php echo URL; ?>assets/img/sidebar-1.jpg">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    --> 
            <div class="logo">
                <a href="http://www.creative-tim.com" class="simple-text">
                    OPUS
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="contractsNav"> 
                        <a href="<?=URL.$_SESSION['role'].'/contracts';?>">
                            <i class="material-icons">assignment</i>
                            <p>Contracts</p>
                        </a>
                    </li>
                    <li class="createContractNav"> <!--class="active"-->
                        <a href="<?=URL.$_SESSION['role'].'/createContract';?>">
                            <i class="material-icons">note_add</i>
                            <p>Create Contract</p>
                        </a>
                    </li>
                    <li class="usersNav">
                        <a href="<?=URL.$_SESSION['role'].'/users';?>">
                            <i class="material-icons">group</i>
                            <p>Users</p>
                        </a>
                    </li>

                    <li class="active-pro">
                        <a href="upgrade.html">
                            <i class="material-icons">unarchive</i>
                            <p>Test</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <nav class="navbar navbar-transparent navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">  </a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a class="dropdown-toggle" style="cursor: pointer;" data-toggle="dropdown">
                                    <i class="material-icons">person</i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="#" class="btn-info">Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>