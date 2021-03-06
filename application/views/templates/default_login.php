<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title> <?php echo $title ?> | Stock System</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url() ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <script src="<?php echo base_url() ?>js/jquery-1.12.4.min.js"></script>
    <script src="<?php echo base_url() ?>js/bootstrap.min.js"></script>

    <!-- CSS and Javascript -->
    <link rel="stylesheet" href="<?php echo base_url() ?>css/custom.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>alertify/themes/alertify.core.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>alertify/themes/alertify.default.css">
    <script src="<?php echo base_url() ?>alertify/lib/alertify.min.js"></script>
    

    <style>
      @media screen and (max-width: 767px){
        #login_wrapper{
          margin-top: 18% !important;
          margin-left: 2% !important;
          margin-right: 2% !important;
        } 
      }
      
      #login_wrapper{
        margin-top: 7%;
      }
      #login_box{
        background: rgba(255,255,255,0.5);
        padding: 20px 40px;
      }
      #hassee_logo{
        margin:auto;
        display: block;
        margin-bottom: 20px;
      }
      #remember{
        font-size: 12px;
        display: inline;
        color: white;
      }
      #forgotPass{
        font-size: 12px;
        color: white;
      }
      .login-button{
        background-color: #24082f;
        color: white;
        border: none;
        width: 100%;
        border-radius: 10px;
        margin-top: 20px;
        
      }
    .btn-primary.active, .btn-primary.focus, .btn-primary:active, .btn-primary:focus, .btn-primary:hover, .open>.dropdown-toggle.btn-primary {
          color: #24082f;
          background-color: white;
          
          -webkit-transition: all 0.3s ease-in;
          -moz-transition: all 0.3s ease-in;
          -ms-transition: all 0.3s ease-in;
          -o-transition: all 0.3s ease-in;
          transition: all 0.3s ease-in;
      }

      body{
        background-image: url("<?php echo base_url().'assets/log'.rand(1,2).'.jpg' ?>");
        background-position: center;
        background-attachment: fixed;
        background-size: cover;
      }
      .form-group{
        margin-bottom: 10px;
      }
      .form-control{
        background-color: white;
        color: black;
        font-size: 16px;
        border-radius: 10px;
      }
      .input-group-addon{
        background: rgba(200,200,200,0.5);
        min-width: 40px;
      }
      i{
        color:white;
      }
      a{
        color: #5bc0de ;
      }
      a:hover{
        color: #fff;
        text-decoration: underline;
        -webkit-transition: all 0.3s ease-in;
        -moz-transition: all 0.3s ease-in;
        -ms-transition: all 0.3s ease-in;
        -o-transition: all 0.3s ease-in;
        transition: all 0.3s ease-in;
      }
      .form-control:focus {
          border-color: #24082f;
          outline: 0;
          -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6);
          box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6);
      }

      .btn-default{
        background: rgba(200,200,200,0.5);
        color: white;
      }
      .btn-default.active, .btn-default.focus, .btn-default:active, .btn-default:focus, .btn-default:hover, .open>.dropdown-toggle.btn-default {
          color: #fff;
          background: rgba(44, 62, 80,0.6);
          border-color: #ccc;
          -webkit-transition: all 0.3s ease-in;
          -moz-transition: all 0.3s ease-in;
          -ms-transition: all 0.3s ease-in;
          -o-transition: all 0.3s ease-in;
          transition: all 0.3s ease-in;
      }

      #error-wrapper{
        padding-top: 5px;
        padding-bottom: 5px;
        margin-bottom: 5px;
      }
      #error-wrapper{
        background-color: rgba(44, 62, 80,0.7);
        color: #fff;
      }
      #error-wrapper a{
        color: rgba(44, 62, 80,0.7);
      }



    </style>

  </head>

  <body>
    
    <div class="container">
      <?php echo $body ?>
    </div>

  </body>
</html>