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
            if(isset($_GET['setup'])){
                $church = $_GET['setup']??"";

                //if churchID aint set then the user could be church admin
                if(!$church && $userType == 'church'){
                    $church = $churchID;
                }else if(!$church){
                    header("location:index.php");
                }

                $churchData = getChurch($church);
                $churchname = $churchData['name'];

                $churchlogo = $churchData['logo'];
                $churchpic = $churchData['profile_picture'];

                $churchAdmin = churchAdmin($church);
                $churchBranches = churchbranches($church);

                ?>
                    <div id="page_content_inner">
                        <h3 class="heading_b uk-margin-bottom"><?php echo "Editing ".$churchname; ?></h3>
                        <?php
                            //handling the form submission
                            if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['subt'])){
                                $fname = $_POST['fname'];
                                $lname = $_POST['lname'];
                                $uname = $_POST['uname'];
                                $phone = $_POST['phone_input'];
                                $email = $_POST['email_input'];

                                if(!empty($_POST['password_changed'])){
                                    $pwd = $_POST['pwd_input'];
                                }                                

                                if($churchAdmin){
                                    //here we are updating the church admin
                                    die("Update is not allowed now");
                                }else{
                                    //creating the church admin
                                    $query = $conn->query("INSERT INTO users(lname, fname, loginName, loginpsw, userphone, useremail, type, church) VALUES(\"$fname\", \"$lname\", \"$uname\", \"$pwd\", \"$phone\", \"$email\", 'church', \"$church\") ") or trigger_error($conn->error);

                                    ?>
                                        <p class="uk-text-success">User added to leader</p>
                                    <?php
                                }


                            }
                        ?>
                        <div class="uk-grid" data-uk-grid-margin="">
                            <div class="uk-width-medium-1-3 .uk-width-1-4@l uk-row-first">
                                <div class="md-card">
                                    <div class="md-card-content">
                                        <h4 class="heading_c uk-margin-bottom">Church details</h4>
                                    </div>
                                    <form style="padding: 12px" method="POST" action='<?php echo $_SERVER['REQUEST_URI']; ?>'>
                                        <input type="hidden" name="subt" value="<?php echo md5(time()*rand(0,1)) ?>">
                                        <div class="uk-form-row">
                                            <div class="uk-grid" data-uk-grid-margin="">
                                                <div class="uk-width-medium-1-1">
                                                    <div class="md-input-wrapper md-input-filled">
                                                        <label>Church name</label>
                                                        <input type="text" class="md-input label-fixed" value="<?php echo $churchname ?>">
                                                        <span class="md-input-bar "></span>
                                                    </div>                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-form-row">
                                            <div class="uk-grid" data-uk-grid-margin="">
                                                <div class="uk-width-medium-1-4">
                                                    <div class="md-input-wrapper md-input-filled">
                                                        <label>Logo</label>
                                                        <img src="<?php echo $churchlogo; ?>">
                                                        <input type="text" class="md-input label-fixed" value="<?php echo $churchname ?>">
                                                        <span class="md-input-bar "></span>
                                                    </div>                                                    
                                                </div>
                                                <div class="uk-width-medium-3-4">
                                                    <div class="md-input-wrapper md-input-filled">
                                                        <label>Church name</label>
                                                        <img src="<?php echo $churchpic; ?>">
                                                        <input type="text" class="md-input label-fixed" value="<?php echo $churchname ?>">
                                                        <span class="md-input-bar "></span>
                                                    </div>                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="uk-form-row">
                                            <div class="uk-grid" data-uk-grid-margin="">
                                                <div class="uk-width-medium-1-1">
                                                    <div class="md-input-wrapper md-input-filled">
                                                        <label>SMS Name</label>
                                                        <input type="text" maxlength="12" class="md-input label-fixed" id="smsnameInput" value="<?php echo churchSMSname($church) ?>">
                                                        <span class="md-input-bar "></span>
                                                    </div>                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="uk-width-large-1-3 uk-grid-margin uk-row-first">
                                <div class="md-card md-card-uplus">
                                    <div class="md-card-toolbar">
                                        <h3 class="md-card-toolbar-heading-text">
                                            Church Branches
                                        </h3>
                                    </div>
                                    <div class="md-card-content">
                                        <table class="uk-table uk-table-hover">
                                            <tbody>
                                                <?php
                                                    foreach($churchBranches as $branch){
                                                ?>
                                                    <tr>
                                                        <td><?php echo $branch['name']; ?></td>
                                                        <td><?php echo $branch['location']; ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td><b>Total</b></td>
                                                    <td><b><?php echo count($churchBranches) ?></b></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <a class="md-btn" href="branches.php">ADD</a>
                                    <br>
                                    </div>
                                </div>
                            </div>
                            <div class="uk-width-large-1-3 uk-grid-margin uk-row-first">
                                <div class="md-card md-card-uplus">
                                    <div class="md-card-toolbar">
                                        <h3 class="md-card-toolbar-heading-text">
                                            Church Leader
                                        </h3>
                                    </div>
                                    <div class="md-card-content">
                                        <?php if($userType == 'admin'){ ?>
                                            <form style="padding: 12px" method="POST" action='<?php echo trim($_SERVER['REQUEST_URI'],'/'); ?>'>
                                                <input type="hidden" name="subt" value="djdd">
                                                <div class="uk-form-row">
                                                    <div class="uk-grid" data-uk-grid-margin="">
                                                        <div class="uk-width-medium-1-1">
                                                            <div class="md-input-wrapper md-input-filled">
                                                                <label>First Name</label>
                                                                <input type="text" class="md-input label-fixed" value="<?php echo $churchAdmin['fname']??"" ?>" name="fname">
                                                                <span class="md-input-bar "></span>
                                                            </div>                                                    
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="uk-form-row">
                                                    <div class="uk-grid" data-uk-grid-margin="">
                                                        <div class="uk-width-medium-1-1">
                                                            <div class="md-input-wrapper md-input-filled">
                                                                <label>Last Name</label>
                                                                <input type="text" class="md-input label-fixed" value="<?php echo $churchAdmin['lname']??"" ?>" name='lname'>
                                                                <span class="md-input-bar "></span>
                                                            </div>                                                    
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="uk-form-row">
                                                    <div class="uk-grid" data-uk-grid-margin="">
                                                        <div class="uk-width-medium-1-1">
                                                            <div class="md-input-wrapper md-input-filled">
                                                                <label>username</label>
                                                                <input type="text" maxlength="12" class="md-input label-fixed" value="<?php echo $churchAdmin['loginName']??"" ?>" name="uname">
                                                                <span class="md-input-bar "></span>
                                                            </div>                                                    
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="uk-form-row">
                                                    <div class="uk-grid" data-uk-grid-margin="">
                                                        <div class="uk-width-medium-1-1">
                                                            <div class="md-input-wrapper md-input-filled">
                                                                <label>Phone</label>
                                                                <input type="number" class="md-input label-fixed" name="phone_input" value="<?php echo $churchAdmin['userphone']??"" ?>">
                                                                <span class="md-input-bar " name="phone"></span>
                                                            </div>                                                    
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="uk-form-row">
                                                    <div class="uk-grid" data-uk-grid-margin="">
                                                        <div class="uk-width-medium-1-1">
                                                            <div class="md-input-wrapper md-input-filled">
                                                                <label>Email</label>
                                                                <input type="email" class="md-input label-fixed" name="email_input" value="<?php echo $churchAdmin['useremail']??"" ?>">
                                                                <span class="md-input-bar " name="email"></span>
                                                            </div>                                                    
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="uk-form-row">
                                                    <div class="uk-grid" data-uk-grid-margin="">
                                                        <div class="uk-width-medium-1-1">
                                                            <div class="md-input-wrapper md-input-filled">
                                                                <label>Change password</label>
                                                                <input type="password" class="md-input label-fixed" value="<?php echo md5(time()*rand(0, 88)) ?>" name="pwd_input" id="password_input">
                                                                <span class="md-input-bar" name="password"></span>
                                                            </div>                                                    
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="uk-form-row">
                                                    <div class="md-input-wrapper md-input-filled">
                                                        <button class="md-btn md-btn-success" type="submit">SUBMIT</button>
                                                    </div>
                                                </div>
                                            </form>
                                        <?php }else{
                                            ?>
                                                <p class="uk-text-success">You are the leader</p>
                                                <p><a class="md-btn" href="settings.php">Profile</a></p>
                                            <?php

                                        }?>
                                        <br> <br>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                $churchLink = "?setup=$church[id]";
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
                                <a href="<?php echo $churchLink; ?>"><img class="img-full branch_img" src="<?php echo $church['profile_picture']; ?>" /></a>
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
                    <form method="POST" enctype="multipart/form-data" id="church_create_form" autocomplete="off">
                        <div class="md-card1">
                            <div class="md-card-content1">
                                <div class="md-input-wrapper">
                                    <label>Church Name</label>
                                    <input type="text" id="branch-name" class="md-input" required="required">
                                    <span class="md-input-bar "></span>
                                </div>
                                <div class="md-input-wrapper">
                                    <label>Location</label>
                                    <input type="text" id="church-location" class="md-input" required="required">
                                    <span class="md-input-bar "></span>
                                </div>

                                <div class="">
                                    <h4>Logo</h4>
                                    <input type="file" id="input-church-logo" style="max-width: 200px" data-height="100" data-height="100" class="dropify" data-allowed-file-extensions="png jpg" required="required"/>
                                    <span class="md-input-bar ">
                                </div>
                                <div class="md-input-wrapper">
                                    <h4>Image</h4>
                                    <input type="file" id="input-church-pic" class="dropify" data-allowed-file-extensions="png jpg"/>
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
        $('.dropify#input-church-pic').dropify({
            messages: {
                'default': 'Drag and drop a church image here or click',
            }
        });
        $('.dropify#input-church-logo').dropify({
            messages: {
                'default': 'Drag and drop a church logo here or click',
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

            logo = document.querySelector("#input-church-logo").files[0];

            if(cname && clocation){
                //Here we can create church

                var formdata = new FormData();

                fields = {action:'create_church', name:cname, location:clocation, picture:file, logo:logo};

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
                                location = 'churches.php?setup='+ret.churchid;
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


        //admin changing password
        $("#password_input").on('change', function(data){
            //signal
            alert("changing password")
            $("#password_input").append("<input name='password_changed' value=12>")

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