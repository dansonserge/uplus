<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <?php
        $title = "Churches";
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
    ?>

    <div id="page_content">
        <?php
            if(!empty($_GET['branch'])){
                $branchid = $_GET['branch'];
                $branch_data = get_branch($branchid);
                $branch_name = $branch_data['name'];

                $branch_representative = branch_leader($branchid, 'representative');

                ?>
                    <div id="page_content_inner">
                        <h3 class="heading_b uk-margin-bottom"><?php echo $churchname." - $"; ?></h3>
                    </div>
                <?php
            }else{
                ?>
                <div id="page_content_inner">
                    <h3 class="heading_b uk-margin-bottom">Churches</h3>
                    <div class="uk-grid uk-grid-width-medium-1-3" data-uk-grid-margin="">
                        <?php
                            //Getting branches
                            $churches = getChurchList();
                            for($n=0; $n<count($churches); $n++){
                                $church = $churches[$n];
                                $churchAdmin = churchAdmin($church['id']);
                        ?>
                        <div class="uk-margin-bottom uk-row-first">
                            <div class="md-card md-card">
                                <div class="md-card-toolbar">
                                    <!-- <div class="md-card-toolbar-actions">
                                        <i class="md-icon material-icons md-color-blue-grey-500"></i>
                                        <i class="md-icon material-icons md-color-light-blue-500"></i>
                                        <i class="md-icon material-icons md-color-green-500">people</i>
                                    </div> -->
                                    <h3 class="md-card-toolbar-heading-text">
                                        <?php echo $church['name']; ?>
                                    </h3>
                                </div>
                                <a href="branch_profile.php?branch=<?php echo $church['id']; ?>"><img class="img-full branch_img" src="<?php echo $church['profile_picture']; ?>" /></a>
                                <div class="md-card-content">
                                    <p>Leader:<span><?php echo $churchAdmin['name'] ?></span></p> 
                                    <p>Phone:<span><?php echo $churchAdmin['userphone']; ?></span></p>
                                    <p>Email:<span><?php echo $churchAdmin['useremail']; ?></span></p>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <?php
            }
        ?>
                    
        <div class="uk-modal" id="church_create" aria-hidden="true" style="display: none; overflow-y: auto;">
            <div class="uk-modal-dialog" style="max-width:800px;">
                <div class="act-dialog" data-role="init">
                    <div class="uk-modal-header uk-tile uk-tile-default">
                        <h3 class="d_inline">Add church</h3>
                    </div>
                    <form method="POST" enctype="multipart/form-data" id="church_create_form">
                        <div class="md-card">
                            <div class="md-card-content">
                                <div class="md-input-wrapper">
                                    <label>Name</label>
                                    <input type="text" id="branch-name" class="md-input" required="required">
                                    <span class="md-input-bar "></span>
                                </div>
                                <div class="md-input-wrapper">
                                    <label>Location</label>
                                    <input type="text" id="church-location" class="md-input">
                                    <span class="md-input-bar "></span>
                                </div>
                                <div class="md-input-wrapper">
                                    <label>Image</label>
                                    <input type="file" id="input-church-pic" class="dropify" data-allowed-file-extensions="png jpg"/>
                                    <span class="md-input-bar "></span>
                                </div>
                            </div>                        
                        </div>
                        <div class="uk-modal-footer uk-text-right">
                            <button class="md-btn md-btn-danger pull-left uk-modal-close">Cancel</button>
                            <button class="md-btn md-btn-success pull-right" id="create-branch-btn">CREATE</button>
                        </div>
                    </form>
                </div>
                <div class="act-dialog display-none" style="max-width:400px;" data-role="done">
                    <div class="uk-modal-header uk-tile uk-tile-default">
                        <h3 class="d_inline">Church</h3>
                        <p class="uk-text-success">Congratulations! church was added successfully!</p>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="md-fab-wrapper ">
            <!-- <a class="md-fab md-fab-primary" href="javascript:void(0)"><i class="material-icons">add</i></a> -->
            <button class="md-fab md-fab-primary d_inline" id="launch_church_create" href="javascript:void(0)" data-uk-modal="{target:'#church_create'}"><i class="material-icons">home</i></button>
        </div>
    </div>
    <!-- common functions -->
    <script src="assets/js/common.min.js"></script>
    <!-- uikit functions -->
    <script src="assets/js/uikit_custom.min.js"></script>
    <!-- altair common functions/helpers -->
    <script src="assets/js/altair_admin_common.min.js"></script>

    <!-- page specific plugins -->

    <!--  dashbord functions -->

    <!-- Dropify -->
    <script src="bower_components/dropify/dist/js/dropify.min.js"></script>
    <script type="text/javascript">
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a church image here or click',
            }
        });
        $("#church_create_form").on('submit', function(e){
            //Creating branch
            //Getting inputs
            e.preventDefault();

            cname = $("#branch-name").val();
            clocation = $("#church-location").val();
            bpic = $("#church-pic").val();
            file = document.querySelector("#input-church-pic").files[0];

            if(cname && clocation){
                //Here we can create church

                var formdata = new FormData();

                fields = {action:'create_church', name:cname, location:clocation, picture:file};

                for (var prop in fields) {
                    formdata.append(prop, fields[prop]);
                }
                var ajax = new XMLHttpRequest();
                ajax.addEventListener("load", function(){
                    response = this.responseText;
                    try{
                        ret = JSON.parse(response);
                        if(ret.status){
                            //create successfully(Giving notification and closing the modal);
                            $("#church_create .act-dialog[data-role=init]").hide();

                            $("#church_create .act-dialog[data-role=done]").removeClass('display-none');

                            setTimeout(function(){
                                // location.reload();
                            }, 1000)

                        }else{
                            msg = ret.msg;
                        }
                    }catch(e){
                        console.log(e);
                    }

                }, false);
                ajax.open("POST", "api/index.php");
                ajax.send(formdata);
            }

        })
    </script>
    
    <script>
        $(function() {
            if(isHighDensity()) {
                $.getScript( "bower_components/dense/src/dense.js", function() {
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