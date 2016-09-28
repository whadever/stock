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
    
    
    
    
    <script src="<?php echo base_url() ?>js/jquery-1.12.4.min.js"></script>
    <script src="<?php echo base_url() ?>js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>js/bootstrap-tour.js"></script>
    <script src="<?php echo base_url() ?>js/jscolor.js"></script>
    
    <script type="text/javascript" src="<?php echo base_url() ?>js/moment.js"></script>

    <script src="<?php echo base_url() ?>js/bootstrap-datepicker.js"></script>
  
    <script src="<?php echo base_url();?>js/jquery.webui-popover.min.js"></script> 

    <!-- CSS and Javascript -->
    <style>
    body{
      font-family: 'helvetica', sans-serif !important;
    }

    .sidenav {
        height: 100%; /* 100% Full-height */
        width: 40px; /* 0 width - change this with JavaScript */
        position: fixed; /* Stay in place */
        z-index: 1; /* Stay on top */
        top: 0;
        left: 0;
        background-color: #203244; /* Black*/
        color: #fff;
        overflow-x: hidden; /* Disable horizontal scroll */
        padding-top: 20px; /* Place content 60px from the top */
        transition: 0.5s; /* 0.5 second transition effect to slide in the sidenav */

    }

    /* The navigation menu links */
    .sidenav a {
        padding: 8px 17px 5px 12px;
        text-decoration: none;
        font-size: 16px !important;
        color: #fff;
        display: block;
        transition: 0.3s;
        
    }

    /* When you mouse over the navigation links, change their color */
    .sidenav a:hover, .offcanvas a:focus{
      background-color: rgba(236, 240, 241,0.5);
        color: #f1f1f1;
    }

    /* Position and style the close button (top right corner) */
    .closebtn{
        position: absolute;
        top: 0;
        right: -4px;
        margin-left: 50px;
    }
    .closebtn:hover{
      background-color: transparent!important;
      color: #3498db !important;
    }

    /* Style page content - use this if you want to push the page content to the right when you open the side navigation */
    #main {
        transition: margin-left .5s;
        padding: 0px;
        margin-left: 30px;
    }

    /* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
    @media screen and (max-height: 450px) {
        .sidenav {padding-top: 15px;}
        .sidenav a {font-size: 18px;}
    }

    /*#menu-button{
      
      background-color: transparent;
      border: none;
      border-radius: 5px;
      margin-left: 12px;
      margin-bottom: 10px;

      

    }

    #menu-button:hover{
      background-color: rgba(236, 240, 241,0.5);
      -webkit-transition: all 1s ease;
      -moz-transition: all 0.6s ease;
      -ms-transition: all 0.6s ease;
      -o-transition: all 0.6s ease;
      transition: all 0.6s ease;
    }
*/
    #background-btn{

      padding-top: 10px;
      padding-bottom: 10px;
      padding-left: 0;
      padding-right: 0;

    }
    .bottom-align-text {
      position: absolute;
      bottom: 0;
      width: 100%;
      font-size: 11px;
      line-height: 11px;
      display: none;
    }
    .bottom-align-text-2 {
      position: absolute;
      bottom: 0;
      width: 100%;
      font-size: 11px;
      margin-bottom: 35px;
      line-height: 11px;
      display: none;
    }
    #mySidenav .fa{
      font-size: 19px;
    }
    .popover-content{
      font-size: 12px!important;
    }
    

  </style>

 

  </head>
  <body>
  <?php 
    $active_user = $this->crud_model->get_by_condition('users',array('id' => $this->session->userdata('is_active')))->row();
    if($active_user->photo == ''){
      $active_photo = base_url()."uploads/photos/no-photo.png";
    }else{
      $active_photo = base_url().$active_user->photo; 
    }
    
    $role = $this->crud_model->get_by_condition('users',array('id' => $this->session->userdata('is_active')))->row('role');
   ?>
  
  <div id="mySidenav" class="sidenav" >
       <a id="menu-button" onclick="openNav()" style="cursor:pointer"><i id="nav-button" class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
        <div class="company_logo" style="display:none;margin-bottom: 10px; padding-left: 15px; padding-bottom:20px; border-bottom:1px solid #000">
          <img src="<?php echo base_url()?>assets/logo.png" width="100px" style="margin-left:15%;">
        </div>

        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()" style="border-bottom: none;font-size:25px!important; display:none">&times;</a>

        <a href="<?php echo base_url('main') ?>"><i class="fa fa-home" aria-hidden="true"></i><span class="menu-text pull-right" style="display:none">Home</span></a>
       
        <a href="" ><i id="submit-button" class="fa fa-hand-pointer-o" aria-hidden="true"></i><span class="menu-text pull-right" style="display:none">Submit</span></a>
        

       
        <a href="" ><i id="template-button" class="fa fa-file-text" aria-hidden="true"></i><span class="menu-text pull-right" style="display:none">Template</span></a>


        <a href="<?php echo base_url('user/settings')?>" ><i id="setting-button" class="fa fa-cogs" aria-hidden="true"></i><span class="menu-text pull-right" style="display:none">Settings</span></a>

        <a href=""><i class="fa fa-question" aria-hidden="true"></i><span class="menu-text pull-right" style="display:none">FAQ and How</span></a>

        <a href="<?php echo base_url('') ?>"><i class="fa fa-headphones" id="service-button" aria-hidden="true"></i><span class="menu-text pull-right" style="display:none">Customer Service</span></a>

        <div class="bottom-align-text-2 text-center">Hassee Stock System V1.0</div>
        <div class="bottom-align-text text-center">For help and feedback contact office@gethassee.com</div>
      </div>


    <div class="container-fluid">
      

       <div id="main" >
           
     
             
           <div class="row" style="padding: 30px 20px 20px 20px; text-align:right">
             <div class="col-md-3"></div>
              <div class="col-md-4"></div>
             <div class="col-md-5">                
                
                <a class="show-pop pull-right" data-animation="pop"  data-placement="vertical"
                    data-content="<?php if($this->session->userdata('user_logged')){

                        echo "<a href='".base_url('accounts/switch_account/'.$active_user->id)."' style='display:block'><img src='".$active_photo."' width='80'><div style='display:inline-block'><p>".$active_user->name."</p><p>".$active_user->email."</p> </div></a>";
                        $i = 0;
                        foreach ($this->session->userdata as $user)
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

                          $profile = $this->crud_model->get_by_condition('users',array('id' => $user['user_id']))->row();
                          //After 3 keys are bypassed user info are passed!
                          
                          
                          if($profile->photo == ''){
                            $photo = base_url()."uploads/photos/no-photo.png";
                          }else{
                            $photo = base_url().$profile->photo; 
                          }

                          $user_id = $user['user_id'];

                          if($user_id != $this->session->userdata('is_active')){
                            echo"<a href='".base_url('accounts/switch_account/'.$profile->id)."' style='display:block'><img src='".$photo."' width='50'><div style='display:inline-block'><p>".$profile->name."</p><p>".$profile->email."</p> </div></a>";
                          }
                                                   
                       


                            

                        
                        }

                      } ?>
                      <a href='<?php echo base_url('accounts/login') ?>'>Add Account</a>
                      <a href='<?php echo base_url('accounts/logout') ?>'>Sign Out</a>"

                    style="cursor:pointer;height: 50px; width: 50px; border-radius: 10px;background-size: cover;background-position: center; background-image: url('<?php
                      if($active_user->photo == ''){
                        echo base_url()."uploads/photos/no-photo.png";
                      }else{
                        echo base_url().$active_user->photo; 
                      }
                       

                     ?>')"></a>
                <p class="pull-right" style="margin-right: 10px; font-size: 18px">Welcome to Reporting System,<br><?php echo $active_user->name ?></p>
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
          document.getElementById("mySidenav").style.width = "200px";
          document.getElementById("main").style.marginLeft = "200px";
          
          
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