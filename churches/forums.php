<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <?php
        $title = "Forums";
        //Including common head configuration
        include_once "head.php";
    ?>
     <!-- dropify -->
    <link rel="stylesheet" href="assets/skins/dropify/css/dropify.css">
</head>
<body class="disable_transitions sidebar_main_open sidebar_main_swipe">
    <!-- main header -->
    <?php
        include_once "menu-header.php";
    ?>
    <!-- main sidebar -->
    <?php
        include_once "sidebar.php";
        $church_services = church_services($churchID);


    ?>

    <div id="page_content">
        <div id="page_content_inner">
            <div class="heading_a uk-grid uk-margin-bottom uk-grid-width-large-1-2">
                <div class="uk-row-first"><h4 class="">All forums</h4></div>
            </div>

            <div class=" uk-grid uk-margin-bottom uk-grid-medium" data-uk-grid-margin>   
                <div class="uk-width-large-4-4">
                    <!-- <div class="md-card">
                        <div class="md-card-content">
                            <div class=" uk-grid">
                                <div class="uk-width-3-4">
                                    <h4 class="heading_c uk-margin-bottom">Forums engagement</h4>
                                </div>
                                <div class="uk-width-1-4">
                                    <form class="-form">
                                        <div class="uk--select"  data-uk-form-select>
                                            <select id="selectChart" class="md-input">
                                                <option value="service">Service</option>
                                                <option value="gender">Gender</option>
                                                <option value="days">Days</option>
                                                <option value="time">Time interval</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            
                            
                            <canvas id="mem_attendance" class="attendance" width="400" height="80"></canvas>
                            <div ></div>
                        </div>
                    </div> -->
                    <div class="md-card">
                        <div id="status"></div>
                        <div class="md-card-content">
                            <div class="dt_colVis_buttons">
                            </div>
                            <table id="dt_tableExport" class="uk-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Forum title</th>
                                        <th>Created By</th>
                                        <th>Date created</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $n=0;
                                    $sqlGetMembers = $db->query("SELECT * FROM `forums` ORDER BY id DESC")or die ($db->error);
                                    while($data = mysqli_fetch_array($sqlGetMembers))
                                        {
                                            $admin  = staff_details($data['admin']);
                                            $n++;
                                            echo '<tr>
                                            <td>'.$n.'</td>
                                            <td>'.$data['forumtitle'].'</td>
                                            <td>'.$admin['name'].'</td>
                                            <td>'.$data['addedDate'].'</td>
                                            <td>'.$data['status'].'</td>
                                            <td><a href="forums.php?id='.$data['id'].'"><i class="material-icons">mode_edit</i></a></td>
                                            </tr>';
                                        }
                                    ?> 
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>              
            </div>
        </div>
        <div class="modals">            
            <div class="uk-modal" id="add_member_modal" aria-hidden="true" style="display: none; overflow-y: auto;">
                <div class="uk-modal-dialog" style="top: 339.5px;">
                    <div class="uk-modal-header uk-tile uk-tile-default">
                        <h3 class="d_inline">New Forum</h3>
                    </div>
                    <form id="create_forum_form">
                        <div class="md-input-wrapper">
                            <label>Forum title</label>
                            <input type="text" name="membername" id="forumtitle_input" class="md-input" required="required">
                            <span class="md-input-bar "></span>
                        </div>
                        <div class="md-input-wrapper md-input-filled">
                            <!-- <label>Introduction</label> -->
                            <textarea cols="30" rows="3" id="forum_intro" class="md-input autosized" placeholder="What's the forum about?" style="overflow-x: hidden; word-wrap: break-word;"></textarea>
                            <span class="md-input-bar "></span>
                        </div>
                        <div class="md-input-wrapper md-input-filled">
                            <input type="file" id="input-forum-logo" name="logo" data-height="100" data-height="100" class="dropify" data-allowed-file-extensions="png jpg" required="required"/>
                            <span class="md-input-bar "></span>
                        </div>
                    </form>
                    <div id="addStatus" class="card mt-3" style="margin-top:20px"></div>

                    <div class="uk-modal-footer uk-text-right act-dialog" data-role='init'>
                        <button class="md-btn md-btn-danger pull-left uk-modal-close">Cancel</button>
                        <button class="md-btn md-btn-success pull-right" id="create_forum_btn">CREATE</button>
                    </div>

                    <div class="uk-modal-footer uk-text-right act-dialog display-none" data-role='done'>
                        <button type="button" class="md-btn md-btn-flat uk-modal-close"><img src="assets/img/rot_loader.gif" style="max-height: 50px"> Creating a forum...</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="md-fab-wrapper">
        <button class="md-fab md-fab-primary" href="javascript:void(0)" data-uk-modal="{target:'#add_member_modal'}"><i class="material-icons">add</i></button>
    </div>

    <!-- <div class="md-fab-wrapper md-fab-speed-dial-horizontal">
        <a class="md-fab md-fab-primary" href="javascript:void(0)"><i class="material-icons">add</i><i class="material-icons md-fab-action-close" style="display:none"></i></a>
        <div class="md-fab-wrapper-small">
            <button class="md-fab md-fab-small md-fab-warning d_inline" href="javascript:void(0)" data-uk-modal="{target:'#add_member_modal'}"><i class="material-icons">person_add</i></button>
            <a class="md-fab md-fab-small md-fab-danger d_inline" href="javascript:void(0)" data-uk-modal="{target:'#modal_upload_members'}"><i class="material-icons">file_upload</i></a>
            <a class="md-fab md-fab-small md-fab-success d_inline" href="javascript:void(0)" data-uk-modal="{target:'#head_counts_modal'}"><i class="material-icons">account_circle</i></a>
        </div>
    </div> -->

    <!-- jQuery -->
    <script type="text/javascript" src="js/jquery.js"></script>

    <!-- common functions -->
    <script src="assets/js/common.min.js"></script>

    <!-- uikit functions -->
    <script src="assets/js/uikit_custom.min.js"></script>
    <!-- altair common functions/helpers -->
    <script src="assets/js/altair_admin_common.min.js"></script>

    <!-- page specific plugins -->
    <!-- datatables -->
    <script src="bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <!-- datatables buttons-->
    <script src="bower_components/datatables-buttons/js/dataTables.buttons.js"></script>
    <script src="assets/js/custom/datatables/buttons.uikit.js"></script>
    <script src="bower_components/jszip/dist/jszip.min.js"></script>
    <script src="bower_components/pdfmake/build/pdfmake.min.js"></script>
    <script src="bower_components/pdfmake/build/vfs_fonts.js"></script>
    <script src="bower_components/datatables-buttons/js/buttons.colVis.js"></script>
    <script src="bower_components/datatables-buttons/js/buttons.html5.js"></script>
    <script src="bower_components/datatables-buttons/js/buttons.print.js"></script>
    
    <!-- datatables custom integration -->
    <script src="assets/js/custom/datatables/datatables.uikit.min.js"></script>

    <!--  datatables functions -->
    <script src="assets/js/pages/plugins_datatables.min.js"></script>


    <!-- Dropify -->
    <script src="bower_components/dropify/dist/js/dropify.min.js"></script>

    <script type="text/javascript" src="js/Chart.min.js"></script>

    <script src="js/uploadFile.js"></script>
    <script type="text/javascript">
        var churchID  = <?php echo $churchID; ?>;
        $('.dropify#input-forum-logo').dropify();
        $(".selectize").selectize();

        // $("#input-forum-logo").dropify();

        function log(data){
            console.log(data)
        }

        $("#create_forum_btn").on('click', function(e){
            e.preventDefault();
            //add individual user
            title = $("#forumtitle_input").val();
            intro = $("#forum_intro").val();
            logo =  document.querySelector("#input-forum-logo").files[0];

            if(title && intro && logo){
                //Marking the progress
                //Marking the sending process
                $("#add_member_modal .act-dialog[data-role=init]").hide();
                $("#add_member_modal .act-dialog[data-role=done]").removeClass('display-none');

                var formdata = new FormData();
                fields = {action:'create_forum', title:title, intro:intro, admin:<?php echo $userId; ?>, logo:logo};

                for (var prop in fields) {
                    formdata.append(prop, fields[prop]);
                }
                var ajax = new XMLHttpRequest();

                ajax.addEventListener("load", function(){
                    response = this.responseText;
                    try{
                        ret = JSON.parse(response);
                        if(ret.status){
                            //User done
                            //create successfully(Giving notification and closing the modal);
                            $("#addStatus").html("<p class='uk-text-success'>Forum added successfully!</p>");
                            
                            setTimeout(function(){
                                UIkit.modal($("#add_member_modal")).hide();
                                location.reload();
                            }, 3000);
                        }
                    }catch(e){
                        alert("error"+e)
                    }

                }, false);

                ajax.open("POST", "api/index.php");
                ajax.send(formdata);
            }else{
                alert("Provide user details")
            }

        })

    </script>

    <script>
        $(function() {
            if(isHighDensity()) {
                $.getScript( "assets/js/custom/dense.min.js", function(data) {
                    // enable hires images
                    altair_helpers.retina_images();
                });
            }
            if(Modernizr.touch) {
                // fastClick (touch devices)
                FastClick.attach(document.body);
            }
        });
        $window.load(function() {
            // ie fixes
            altair_helpers.ie_fix();
        });
    </script>
</body>
</html>