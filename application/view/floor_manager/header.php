<!doctype html>
<html lang="en">
 
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo URL; ?>assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="<?php echo URL; ?>assets/img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Flor Managment</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <link href="<?php echo URL; ?>assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo URL; ?>assets/css/material-dashboard.css?v=1.2.0" rel="stylesheet" />
    <link href="<?php echo URL; ?>assets/css/demo.css" rel="stylesheet" />
    <link href="<?php echo URL; ?>assets/css/font-awesome.min.css" rel="stylesheet" />
    <link href="<?php echo URL; ?>assets/css/material-icons.css" rel="stylesheet" />
    <script src="<?php echo URL; ?>assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="<?php echo URL; ?>assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo URL; ?>assets/js/material.min.js" type="text/javascript"></script>
    <!--<script src="<?php echo URL; ?>assets/js/chartist.min.js"></script>-->
    <script src="<?php echo URL; ?>assets/js/arrive.min.js"></script>
    <script src="<?php echo URL; ?>assets/js/perfect-scrollbar.jquery.min.js"></script>
    <script src="<?php echo URL; ?>assets/js/bootstrap-notify.js"></script>
    <script src="<?php echo URL; ?>assets/js/material-dashboard.js?v=1.2.0"></script>
    <script src="<?php echo URL; ?>assets/js/sweetalert.min.js"></script>
    <script src="<?php echo URL; ?>assets/js/dropzone.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo URL;?>assets/css/dropzone.css" />
    <script type="text/javascript" src="<?php echo URL; ?>assets/js/moment.min.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>assets/js/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>assets/css/daterangepicker.css" />
    <script type="text/javascript" src="<?php echo URL; ?>assets/js/bootstrap-datetimepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>assets/css/bootstrap-datetimepicker.min.css" />

</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-color="blue" data-image="<?php echo URL; ?>assets/img/sidebar-1.jpg">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    --> 
            <div class="logo">
              <!--   <a href="<?=URL;?>" class="simple-text">
                    OPUS
                </a> -->
                <img style="width: 238px" src="<?php echo URL; ?>assets/img/jc.png"> 
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="contractsNav"> 
                        <a href="<?=URL.$_SESSION['role'].'/contracts';?>">
                            <i class="material-icons">assignment</i>
                            <p>Contratti</p>
                        </a>
                    </li>
                    <li class="usersNav">
                        <a href="<?=URL.$_SESSION['role'].'/users';?>">
                            <i class="material-icons">group</i>
                            <p>Operatori</p>
                        </a>
                    </li>
                    <li class="campaignNav">
                        <a href="<?=URL.$_SESSION['role'].'/campaigns';?>">
                            <i class="material-icons">event_note</i>
                            <p>Campagna</p>
                        </a>
                    </li>
                    <li class="statusNav">
                        <a href="<?=URL.$_SESSION['role'].'/statuses';?>">
                            <i class="material-icons">category</i>
                            <p>Stato Pratica</p>
                        </a>
                    </li>

<!--                     <li class="active-pro">
                        <a href="mailto:adalenvladi@gmail.com">
                            <i class="material-icons">unarchive</i>
                            <p>Support</p>
                        </a>
                    </li> -->
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
                            <li class="dropdown" style="padding-top: 15px;padding-bottom: 15px;">
                                 <?=$_SESSION['full_name'];?>
                            </li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" style="cursor: pointer;" data-toggle="dropdown">
                                    <i class="material-icons">person</i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="<?=URL.'home/logout';?>" class="btn-info">Esci</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>