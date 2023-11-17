<!DOCTYPE html>
<html lang="en">
   <head>
     <?php include_once('includes/header.php'); ?>
   </head>
   <body class="dashboard dashboard_1">
      <div class="full_container">
         <div class="inner_container">
            <!-- Sidebar  -->
      <?php include_once('includes/sidebar.php'); ?>  
            <!-- end sidebar -->
            <!-- right content -->
            <div id="content">
               <!-- topbar -->
      <?php include_once('includes/topbar.php'); ?>       
               <!-- end topbar -->
               <!-- dashboard inner -->
               <div class="midde_cont">
                  <div class="container-fluid">
                     <div class="row column_title">
                        <div class="col-md-12">
                           <div class="page_title">
                              <h2>Quản lý bài viết </h2>
                           </div>
                        </div>
                     </div>
                     <!-- row -->
                     <div class="row">
                        <!-- invoice section -->
                        <div class="col-md-12">
                           <div class="white_shd full margin_bottom_30">
                              <div class="full graph_head">
                                 <div class="heading1 margin_0">
                                    <h2><i class="fa fa-file-text-o"></i> Danh sách bài viết</h2>
                                 </div>
                              </div>
                              
                              <div class="full padding_infor_info">
                             <?php 
                             //trường hợp thêm mới bản ghi
                             if (isset($_GET['action']) && $_GET['action'] == 'add') {
                                 include_once ('managers/posts/add.php');
                             }

                                //trường hợp edit
                             if (isset($_GET['action']) && $_GET['action'] == 'edit') {
                                 include_once ('managers/posts/edit.php');                  
                             }

                             if (isset($_GET['action']) && $_GET['action'] == 'delete') {
                              include_once ('managers/posts/delete.php');                  
                           }

                           //trường hợp lists
                            if (!isset($_GET['action'])) { ?>
                              <a class="btn btn-primary" href="posts.php?action=add" style="color:white; margin-bottom:20px" >Thêm</a>  
                              <?php 
                                include_once('managers/posts/list.php');
                            }
                                   
                            ?>
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- row -->
                     
                  </div>
                  <!-- footer -->
                  <div class="container-fluid">
                     <div class="footer">
                        <p>Copyright © 2018 Designed by html.design. All rights reserved.</p>
                     </div>
                  </div>
               </div>
               <!-- end dashboard inner -->
            </div>
         </div>
      </div>
      <!-- jQuery -->
      <?php include_once('includes/filejs.php'); ?>
   </body>
</html>