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
    <link rel="stylesheet" href="<?php echo base_url() ?>css/custom.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>css/datepicker.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap-tour.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/jquery.webui-popover.min.css">
    <link href="<?php echo base_url() ?>css/footable.core.css" type="text/css" rel="stylesheet">
    <link href="<?php echo base_url() ?>css/footable.metro.min.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url() ?>alertify/themes/alertify.core.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>alertify/themes/alertify.default.css">
    <link rel="stylesheet" href="<?php echo base_url();?>css/yamm.css">
    
    
    
    
    <!-- Javascript -->
    <script src="<?php echo base_url() ?>alertify/lib/alertify.min.js"></script>
    <script src="<?php echo base_url() ?>js/jquery-1.12.4.min.js"></script>
    <script src="<?php echo base_url() ?>js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>js/bootstrap-tour.js"></script>
    <script src="<?php echo base_url() ?>js/jscolor.js"></script>
    <script src="<?php echo base_url() ?>js/footable.js"></script>
    <script src="<?php echo base_url() ?>js/footable.filter.js"></script>
    <script src="<?php echo base_url() ?>js/footable.paginate.js"></script>
    <script src="<?php echo base_url() ?>js/footable.sort.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>js/moment.js"></script>
    <script src="<?php echo base_url() ?>js/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url();?>js/jquery.webui-popover.min.js"></script> 
    <script src="<?php echo base_url();?>js/script.js"></script>

    <!-- CSS and Javascript -->
    <style>

    @font-face {
        font-family: bebas-neue;
        src: url("<?php echo base_url('fonts/BebasNeue.otf') ?>");
    }
    .bebas{
      font-family: 'bebas-neue';
      font-size: 25px;
      line-height: 30px;
      font-weight: bolder;

    }
    .segoe{
      font-family: 'Segoe UI';
      font-size: 12px;
      line-height: 30px;
    }
    
    .btn-custom{
      background-color: #2c3e50;
      color: #fff !important;
      font-family: 'bebas-neue';
      letter-spacing: 1px;
      font-size: 22px;
      line-height: 30px;
      font-weight: 100;
      padding: 12px;
      border-radius: 10px;
      min-width: 150px;
    }

    .page_subtitle{
      font-size: 60px;
      font-weight: bold;
      display: inline-block;
      font-family: 'bebas-neue';
      line-height: 1;
      letter-spacing: 1px;

    }
    #txt{
      font-family: 'bebas-neue';
      font-size: 18px;
    }
    .webui-popover-content{
      width: 175px;
    }
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
      border-top: none;
      vertical-align: middle;
      padding-top: 5px;
      padding-bottom: 0px;
    }

    .navbar{
      background-color: #2ABB9B;
      height: 75px;
    }
    .navbar-nav>li>a,.navbar a{
      color: #fff !important;
    }
    .navbar-nav>li{
      height: 67px;
    }
    .navbar-nav>li>a{
      line-height: 37px;
    }
    .menu-a{
      padding-bottom: 0px !important;
      padding-top: 5px !important;
    }
    .menu-a p{
      margin-top: -12px !important;
    }
    #home{
      background-color: rgba(192, 57, 43,1.0);
    }
    #trans{
      background-color: #d35400;
    }
    #invent{
      background-color: #f39c12;
    }
    #contact{
      background-color: #27ae60;
    }
    .navbar-nav > .active > a {
        color: red;
    }
    .card{
      width: 100%; 
      height: 200px; 
      margin:auto; 
      padding-top: 50px;
    }

  </style>
  
<script>


    function startTime() {
        var today = new Date();
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
        var d = today.getDate();
        var D = today.getDay();
        var M = today.getMonth();
        var Y = today.getFullYear();
        h = checkTime(h);
        m = checkTime(m);
        s = checkTime(s);
        document.getElementById('txt').innerHTML =
        getDayName(D) + ", "+ d + " " + getMonthName(M) + " " + Y + " " + h + ":" + m + ":" + s;
        var t = setTimeout(startTime, 500);
    }
    function checkTime(i) {
        if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
        return i;
    }
</script>
 

  </head>
  <body onload="startTime()">
  <?php 
    $active_user = $this->crud_model->get_by_condition('outlets',array('id' => $this->session->userdata('is_active')))->row();
    if($active_user->photo == ''){
      $active_photo = base_url()."uploads/photos/no-photo.png";
    }else{
      $active_photo = base_url().$active_user->photo; 
    }
    
    $role = $this->crud_model->get_by_condition('outlets',array('id' => $this->session->userdata('is_active')))->row('role');
   ?>
  
  <nav class="navbar navbar-default yamm">
      <div class="container-fluid" style="padding-left: 20px;padding-right: 20px">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo base_url('main') ?>" style="padding-top: 0px;"><img src="<?php echo base_url() ?>assets/logo1.png" width="62" id="hassee_logo" class="img img-responsive" alt="Hassee Logo"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav" role="menu">
            <li><a href="<?php echo base_url('main') ?>" id="home" class="menu-a text-center"><i class="fa fa-home fa-3x" aria-hidden="true"></i><p class="segoe">Home</p></a></li>
            <!--Transactions-->
            <li class="dropdown yamm-fw">
              <a href="#" class="dropdown-toggle menu-a text-center" data-toggle="dropdown" id="trans"><i class="fa fa-money fa-3x" aria-hidden="true"></i><p class="segoe">Transactions</p></a>
              <div class="dropdown-menu yamm-content">
              <div class="row" style="padding-top: 35px; padding-bottom: 35px;">
              
                  <div class="col-md-1"></div>  
                  <div class="col-md-10">
                    <div class="row">
                      <div class="col-md-6">
                        <a href="<?php echo base_url('selling') ?>" class="text-center">
                          <div class="card" style="background-color:#2ecc71; height: 420px;">
                              <span class="fa fa-shopping-cart fa-5x" aria-hidden="true"></span><p class="segoe">Daftar Penjualan</p>
                          </div>
                        </a>
                      </div>
                      <div class="col-md-6">
                        <div class="row">
                          <a href="<?php echo base_url('purchasing') ?>" class="text-center">
                            <div class="card" style=" height: 200px; background-color:#e74c3c; margin:auto;">
                                <span class="fa fa-shopping-basket fa-5x" aria-hidden="true"></span><p class="segoe">Daftar Pembelian</p>
                            </div>
                          </a>  
                        </div>
                        <div class="row" style="margin-top: 20px;">
                          <a href="<?php echo base_url('purchasing') ?>" class="text-center">
                            <div class="card" style=" height: 200px; background-color:#e74c3c; margin:auto;">
                                <span class="fa fa-shopping-basket fa-5x" aria-hidden="true"></span><p class="segoe">Daftar Pembelian</p>
                            </div>
                          </a>  
                        </div>
                      </div>

                    </div>

                    <div class="row" style="margin-top: 20px;">
                      <div class="col-md-6">
                        <a href="<?php echo base_url('selling') ?>" class="text-center">
                        <div class="card" style=" height: 200px; background-color:#f1c40f; margin:auto;">
                            <span class="fa fa-dollar fa-5x" aria-hidden="true"></span>
                            <p class="segoe">Penjualan Baru</p>
                        </div>
                        </a>
                      </div>
                      <div class="col-md-6">
                          <div class="row"> 
                        <a href="<?php echo base_url('selling') ?>" class="text-center">
                        <div class="card" style=" height: 200px; background-color:#f1c40f; margin:auto;">
                            <span class="fa fa-dollar fa-5x" aria-hidden="true"></span>
                            <p class="segoe">Penjualan Baru</p>
                            </div>
                        </div>
                        </a>
                      </div>
                    </div>

                  </div>
                  <div class="col-md-1"></div>
                  
              
            </div>
            
            </div>
            </li>
            <!--Transaction end-->

            <!--Inventories-->
            <li class="dropdown yamm-fw">
              <a href="#" class="dropdown-toggle menu-a text-center" data-toggle="dropdown" id="invent"><i class="fa fa-dropbox fa-3x" aria-hidden="true"></i><p class="segoe">Inventory</p></a>
              <div class="dropdown-menu yamm-content">
                <div class="row">
                  <div class="col-md-4">
                    <a href="<?php echo base_url('products') ?>" ><i id="template-button" class="fa fa-archive fa-3x" aria-hidden="true"></i><span><p class="segoe">Produk</p></span></a>
                  </div>
                  <div class="col-md-4">
                    <a href="<?php echo base_url('products/all_category') ?>" ><span class="glyphicon glyphicon-tags" aria-hidden="true"></span><span>Kategori</span></a>
                  </div>
                  <div class="col-md-4">
                    <a href="<?php echo base_url('mutasi') ?>" ><span class="fa fa-institution fa-3x" aria-hidden="true"></span><span>Mutasi</span></a>
                  </div>
                </div>
              </div>
            </li>
            <!--Inventory End-->

            <!--Contacts-->
            <li class="dropdown yamm-fw">
              <a href="#" class="dropdown-toggle menu-a text-center" data-toggle="dropdown" id="contact"><i class="fa fa-phone fa-3x" aria-hidden="true"></i><p class="segoe">Contacts</p></a>
              <div class="dropdown-menu yamm-content">
                <div class="row">
                    <div class="col-md-3">
                      <a href="<?php echo base_url('customers') ?>" ><span class="fa fa-users fa-3x" aria-hidden="true"></span><span>Customer</span></a>
                    </div>
                    <div class="col-md-3">
                      <a href="<?php echo base_url('outlets') ?>" ><span class="glyphicon glyphicon-tags" aria-hidden="true"></span><span>Outlets</span></a>
                    </div>
                    <div class="col-md-3">
                      <a href="<?php echo base_url('drivers') ?>" ><span class="fa fa-car fa-3x" aria-hidden="true"></span><span>Driver</span></a>
                    </div>
                    <div class="col-md-3">
                      <a href="<?php echo base_url('supplier') ?>" ><span class="fa fa-users fa-3x" aria-hidden="true"></span><span>Supplier</span></a>
                    </div>
                </div>
              </div>
            </li>
            <!--Contacts End-->
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li style="padding-bottom: 0px !important;">
              <table class="table" style="margin-bottom: 0px !important;"><tr>
                <td>
                <a class="show-pop" data-animation="pop"  data-placement="right"
                      data-content='<?php if($this->session->userdata('user_logged')){                        
                          $i = 0;
                          foreach ($this->session->userdata() as $user)
                          { 
                            //Skip the first 4 keys
                            if($i < 3)
                            {
                              $i++;
                              continue;
                            }else
                            {
                              $i++;
                            }

                            $profile = $this->crud_model->get_by_condition('outlets',array('id' => $user['user_id']))->row();
                            //After 3 keys are bypassed user info are passed!
                            
                            
                            if($profile->photo == ''){
                              $photo = base_url()."uploads/photos/no-photo.png";
                            }else{
                              $photo = base_url().$profile->photo.'?timestamp='.mt_rand(100000000,999999999); 
                            }

                            $user_id = $user['user_id'];

                            if($user_id != $this->session->userdata('is_active')){
                              echo'<a href="'.base_url('accounts/switch_account/'.$profile->id).'" style="display:block" class="profile-pop btn btn-default">
                              <table>
                              <tr>
                              <td>
                              <span class="pop-photo" style="background-image: url('.$photo.')"></span></td><td><div class="pop-detail" style="display:inline-block; width:100px"><p class="pop-name">'.$profile->name.'</p><p>'.$profile->pic.'</p> </div></td></tr></table></a>';
                            }
                                                                            
                          }

                        } ?>
                        <div class="row btn-collection text-center" style="margin:0">
                        <a href="<?php echo base_url('accounts/login') ?>" class="btn btn-primary pop-btn">Add Account</a>
                        </div>
                        '


                      style="display:inline-block;cursor:pointer;height: 57px; width: 57px; border-radius: 50%;background-size: cover;background-position: center; background-image: url('<?php
                        if($active_user->photo == ''){
                          echo base_url()."uploads/photos/no-photo.png";
                        }else{
                          echo base_url().$active_user->photo.'?timestamp='.mt_rand(100000000,999999999); 
                        }                      
                       ?>')"></a>
                  </td>
                  <td>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><b style="font-family:'bebas-neue';  font-weight: 100; font-size: 18px;">Welcome</b>,<br><?php echo $active_user->name ?><span class="caret"></span></a>
                  </td>
              </tr></table>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
    <!--Navbar Ends-->
    <div class="container-fluid">
      <div class="col-xs-12">

       
           
     
             
          <div class="row" style="padding: 20px 0 0">
          
              <div class="col-xs-12" style="padding:0">
                <p class="page_subtitle"><?php echo $subtitle ?></p>
                <div class="pull-right" style="overflow: hidden; display: inline-block;">
                  <a href="<?php echo base_url('user/settings')?>" style="float:right;padding:10px 0;"><i class="fa fa-cog fa-3x" aria-hidden="true"></i></a>
                  <div id="txt" style="float: left; margin: 20px 20px 0 0"></div>
                </div>
              </div>
            
          </div>
            
              <?php echo $body ?>
           
          
      </div>
    </div>
  
  
   <script>
      (function(){


        var settings = {
            trigger:'click',         
            multi:true,           
            closeable:false,
            style:'',
            delay:300,
            padding:true,
            backdrop:false
        };

        function initPopover(){         
          $('a.show-pop').webuiPopover('destroy').webuiPopover(settings);       
          
          var tableContent = $('#tableContent').html(),
            tableSettings = {content:tableContent,
                      width:500
                    };
         
        }
        initPopover();    
          
      })();
      
    </script>
  <script>
      //Tour Script
        var tour = new Tour({
        backdrop: true,
        backdropContainer: '#templatebody',
        backdropPadding: false,
        steps: [
        {
          element: "#nav-button",
          title: "Getting Started",
          content: "Click this icon to access all the available menu"
        },
        {
          element: "#submit-button",
          title: "Submitting Report",
          content: "Click this menu to submit the reports which are assigned to you"
        },
        {
          element: "#template-button",
          title: "Report Templates",
          content: "Here you can see, edit, and delete the already existing report templates. You can also create new report template here. Now we will proceed to this menu."
        },
        {
          path:"/reporting/templates",
          element: "#add-template",
          title: "Add New Report Template",
          content: "Create new template of report to be submitted by the staffs. Let's see what's needed when creating new report template."
        },
        {
          path:"/reporting/templates/add_template",
          element: "#template_title",
          title: "Template Title",
          content: "Type the title of report template that is going to be created."
        },
        {
          path:"/reporting/templates/add_template",
          element:"#elementfield",
          title:"Manage Content Fields",
          content:"Drag and drop the form elements to the area to manage needed type of input field (whether it's text field, or date picker, or yes/no answer), that are going to be included to report.",
          placement: "left",
        },
        {
          path:"/reporting/templates/add_template",
          element:"#assign_staff",
          title:"Complete Template Content Management",
          content:"After the template content is complete, proceed by clicking this button. Next step includes deciding the deadline of the report, frequency of submitting the report, and choosing staff that will be required to fill the report and the one that will be notified when report is submitted.",
          placement: "left",
        },
        {
          path:"/reporting/templates",
          element: "#deactivate",
          title: "Deactivate Report Temporarily",
          content: "Turn off the report notification and obligation by pressing this button.",
          placement: "left",
        },
        {
          path:"/reporting/templates",
          element: "#templateaction",
          title: "Edit Existing Templates",
          content: "You can either edit, copy, or delete the already existing templates.",
          placement: "left",
        }
        ,
        {
          element: "#setting-button",
          title: "Profile Setting",
          content: "You can change the detail of your personal profile through this option."
        },
        {
          element: "#service-button",
          title: "Customer Service",
          content: "If you have any inquiries or difficulties regarding our system, you can contact us through our customer service."
        }

      ]});

      // Initialize the tour
      tour.init();      
  </script>
  <script>
    $(document).ready(function(){
        $('#webtour').click(function(){
            tour.restart();
        });
    });
  </script>

  
  </body>
</html>