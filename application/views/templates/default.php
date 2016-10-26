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
    .menu-text,fa{
      font-size: 12px !important;
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
  
  <div id="mySidenav" class="sidenav" >
       <a id="menu-button" onclick="openNav()" style="cursor:pointer;"><i id="nav-button" class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
        <div class="company_logo" style="margin-bottom: 5px; padding-left: 15px; padding-bottom:10px; border-bottom:1px solid #000">
          <img src="<?php echo base_url()?>assets/logo1.png" width="100px" style="margin-left:23%;">
        </div>

        <div class="company_logo" style="margin-bottom: 10px; padding-left: 15px; padding-bottom:0px; border-bottom:1px solid #000">
        <table>
          <tr>
            <td><a class="show-pop" data-animation="pop"  data-placement="right"
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
                            $photo = base_url().$profile->photo.'?timestamp='.mt_rand(1000000000,9999999999); 
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
                      <a href="<?php echo base_url('accounts/logout') ?>" class="btn btn-default pop-btn">Sign Out</a>
                      </div>
                      '


                    style="display:inline-block;cursor:pointer;height: 80px; width: 80px; border-radius: 50%;background-size: cover;background-position: center; background-image: url('<?php
                      if($active_user->photo == ''){
                        echo base_url()."uploads/photos/no-photo.png";
                      }else{
                        echo base_url().$active_user->photo.'?timestamp='.mt_rand(1000000000,9999999999); 
                      }
                       

                     ?>')"></a></td>
                     <td style="padding-left: 10px;max-width: 135px"><b style="font-family:'bebas-neue';  font-weight: 100; font-size: 18px;">Welcome</b>,<br><?php echo $active_user->name ?></td>
          </tr>
        </table>
          
        </div>

        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()" style="border-bottom: none;font-size:25px!important; display: none">&times;</a>

        <a href="<?php echo base_url('main') ?>"><i class="fa fa-home" aria-hidden="true"></i><span class="menu-text pull-right">Home</span></a>
       
        <a href="<?php echo base_url('products') ?>" ><i id="template-button" class="fa fa-archive" aria-hidden="true"></i><span class="menu-text pull-right" >Products</span></a>
        
        <?php if($role == 'admin'): ?>
          <a href="<?php echo base_url('products/all_category') ?>" ><i id="template-button" class="glyphicon glyphicon-tags" aria-hidden="true"></i><span class="menu-text pull-right" >Category</span></a>

          <a href="<?php echo base_url('outlets') ?>" ><span class="glyphicon glyphicon-tags" aria-hidden="true"></span><span class="menu-text pull-right" >Outlets</span></a>
        <?php else: ?>
          <a href="<?php echo base_url('transaction') ?>" ><span class="fa fa-money" aria-hidden="true"></span><span class="menu-text pull-right" >Semua Transaksi</span></a>

          <a href="<?php echo base_url('mutasi') ?>" ><span class="fa fa-institution" aria-hidden="true"></span><span class="menu-text pull-right" >Mutasi</span></a>

          <a href="<?php echo base_url('selling') ?>" ><span class="fa fa-shopping-cart" aria-hidden="true"></span><span class="menu-text pull-right" >
          Penjualan</span></a>

          <a href="<?php echo base_url('purchasing') ?>" ><span class="fa fa-shopping-basket" aria-hidden="true"></span><span class="menu-text pull-right" >Pembelian</span></a>

        <?php endif; ?>
        <a href="<?php echo base_url('customers') ?>" ><i id="template-button" class="fa fa-users" aria-hidden="true"></i><span class="menu-text pull-right" >Customer</span></a>

        <!-- <a href="<?php echo base_url('drivers') ?>"><i class="fa fa-car" aria-hidden="true"></i><span class="menu-text pull-right" >Driver</span></a> -->

        <a href="<?php echo base_url('') ?>"><i class="fa fa-file-text" id="service-button" aria-hidden="true"></i><span class="menu-text pull-right" >Notes</span></a>

        <a href="<?php echo base_url('') ?>"><i class="fa fa-comments" id="service-button" aria-hidden="true"></i><span class="menu-text pull-right" >Private Message</span></a>

        <div class="bottom-align-text-2 text-center">Hassee Stock System V1.0</div>
        <div class="bottom-align-text text-center">For help and feedback contact office@gethassee.com</div>
      </div>


    <div class="container-fluid">
      

       <div id="main" >
           
     
             
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
    /* Set the width of the side navigation to 250px and the left margin of the page content to 250px and add a black background color to body */
      function openNav() {
          document.getElementById("mySidenav").style.width = "250px";
          
        
          
          $('.menu-text').show();
          $('.company_logo').show();
          $('#menu-button').hide();
          $('.closebtn').show();
          $('.bottom-align-text').show();
          $('.bottom-align-text-2').show();

      }

      /* Set the width of the side navigation to 0 and the left margin of the page content to 0, and the background color of body to white */
      function closeNav() {
          document.getElementById("mySidenav").style.width = "40px";
          document.getElementById("main").style.marginLeft = "30px";

          $('.menu-text').hide();
          $('.company_logo').hide();
          $('#menu-button').show();
          $('.closebtn').hide();
          $('.bottom-align-text').hide();
          $('.bottom-align-text-2').hide();
      }
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