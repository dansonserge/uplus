<!doctype html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <?php
        $title = "Feeds";
        //Including common head configuration
        include_once "head.php";
    ?>
    <!-- dropify -->
    <link rel="stylesheet" href="assets/skins/dropify/css/dropify.css">

    <!-- Filepond -->
    <link rel="stylesheet" href="assets/css/filepond.css">
    <!-- Imag epreview filepond -->
    <!-- <link rel="stylesheet" href="assets/css/filepond-plugin-image-preview.css"> -->

    <style type="text/css">
        /**
     * FilePond Custom Styles
     */
    .filepond--drop-label {
      color: #4c4e53;
    }

    .filepond--label-action {
      -webkit-text-decoration-color: #babdc0;
              text-decoration-color: #babdc0;
    }

    .filepond--panel-root {
      border-radius: 2em;
      background-color: #edf0f4;
      height: 1em;
    }

    .filepond--item-panel {
      background-color: #595e68;
    }

    .filepond--drip-blob {
      background-color: #7f8a9a;
    }
    </style>

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
                    <h3 class="uk-margin-bottom">Feeds</h3>
                    <div class="uk-grid uk-grid-width-medium-1-1" data-uk-grid-margin="">
                        <div class="uk-margin-bottom uk-row-first">
                            <div class="md-card">
                                <div class="md-card-content">
                                	<form id="feed_create_form">
	                                    <div class="uk-form-row">
	                                       <textarea cols="30" rows="4" class="md-input feeds-textarea" id="post_content" placeholder="Something to tell the church?" required="required"></textarea>
	                                    </div>
	                                    <div class="uk-form-row">
	                                       <div class="uk-grid">
		                                       	<div class="uk-width-1-4">
		                                       		<div class="uk-form-file md-btn" style="box-shadow: 0 1px 3px rgba(0, 0, 0, 0), 0 1px 2px rgba(0, 0, 0, 0);">
		                                       			<img src="gallery/upload_feed_icon.png">
						                                <input id="form-file" type="file">
						                            </div>
		                                       	</div>
											    <div class="uk-width-3-4">
										    		<div style="position: absolute; right: 2%; bottom: 12%">
												    	<ul class="uk-list" style="list-style: none; display: inline-block; margin-right: 50px">
				                                       		<li style="list-style: none; display: inline-block;">
				                                       			<input type="radio" name="postTo" id="public_post" value="<?php echo $churchID; ?>" data-md-icheck required/>
				                                        		<label for="public_post" class="inline-label">Public</label>
				                                       		</li>
				                                       		<li style="list-style: none; display: inline-block;">
				                                       			<input type="radio" name="postTo" id="church_post" value="<?php echo $churchID ?>" data-md-icheck required/>
				                                        		<label for="church_post" class="inline-label">My church</label>
				                                       		</li>
				                                       	</ul>
                                                        <!-- <div class=""><img style="width: 72px; height: 72px" src="assets/img/rot_loader.gif"></div> -->
                                                        <span class="progress-cont display-none"><img src="assets/img/spinners/spinner_success.gif" alt="" width="32" height="32"></span>
				                                       	<button class="md-btn md-btn-primary" id="submit_feed" type="submit">Post</button>
				                                    </div>
											    </div>
	                                       </div>
	                                    </div>
	                                </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="uk-grid uk-grid-width-medium-1-3" data-uk-grid-margin="">   
                        <?php
                            //getting podcasts
                        	$podcats = church_podcasts($churchID);

                            $posts = getPosts($churchID);

                            //Getting branches
                            $branches = churchbranches($churchID);
                            for($n=0; $n<count($podcats); $n++){
                                $podcast = $podcats[$n];

                                //getting representative
                                // $rep = user_details($branch['repId']);
                        ?>
                        <div class="uk-margin-bottom uk-row-first">
                            <div class="md-card md-card">
                                <div class="md-card-toolbar">
                                    <h3 class="md-card-toolbar-heading-text">
                                        <?php echo $podcast['name']; ?>
                                    </h3>
                                    <div class="md-card-toolbar-actions">
                                        <i class="md-icon material-icons md-color-red-500 podcast_remove" title="Remove podcast" data-podcast="<?php echo $podcast['id']; ?>">delete</i>                                        
                                    </div>
                                </div>                                
                                <div class="md-card-content">
                                	<audio style="height: 30px" src="<?php echo $podcast['file']; ?>" controls></audio>
                                    <p>Intro:<span><?php echo $podcast['intro'] ?></span></p> 
                                    <p>Uploaded:<span><?php echo $podcast['date_uploaded']; ?></span></p>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <?php
            }
        ?>
                    
        <div class="uk-modal" id="branch_create" aria-hidden="true" style="display: none; overflow-y: auto;">
            <div class="uk-modal-dialog" style="max-width:800px;">
                <div class="act-dialog" data-role="init">
                    <div class="uk-modal-header uk-tile uk-tile-default">
                        <h3 class="d_inline">Add podcast</h3>
                    </div>
                    <form method="POST" enctype="multipart/form-data" id="file_add_form">
                        <div class="md-card">
                            <div class="md-card-content">
                                <div class="md-input-wrapper">
                                    <label>Title</label>
                                    <input type="text" id="podcast-name" class="md-input" required="required">
                                    <span class="md-input-bar "></span>
                                </div>
                                <div class="md-input-wrapper">
                                    <label>Description</label>
                                    <textarea id="podcast-intro" class="md-input"></textarea>
                                    <!-- <input type="text"  c> -->
                                    <span class="md-input-bar "></span>
                                </div>
                                <div class="md-input-wrapper">
                                    <label>File</label>
                                    <input type="file" id="podcast-file" class="dropify" data-allowed-file-extensions="mp3 aac mp4" data-max-file-size="<?php echo ini_get('upload_max_filesize'); ?>"/>
                                    <progress id="podcast-upload-progress" class="uk-progress display-none" value="0" max="100" style="width: 100%"></progress>
                                    <span class="md-input-bar "></span>
                                </div>
                                <!-- <div class="md-input-wrapper">
                                    <label>File</label>
                                    <input type="file" id="podcast-file" data-allowed-file-extensions="mp3 aac"/>
                                    <span class="md-input-bar "></span>
                                </div> -->
                            </div>                        
                        </div>
                        <div class="uk-modal-footer uk-text-right">
                            <button class="md-btn md-btn-danger pull-left uk-modal-close">Cancel</button>
                            <button class="md-btn md-btn-success pull-right" type="submit" id="upload-podcast-btn">UPLOAD</button>
                        </div>
                    </form>
                </div>
                <div class="act-dialog display-none" style="max-width:400px;" data-role="done">
                    <div class="uk-modal-header uk-tile uk-tile-default">
                        <h3 class="d_inline">Podcast</h3>
                        <p class="uk-text-success">Congratulations! Podcast added successfully!</p>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="md-fab-wrapper ">
            <!-- <a class="md-fab md-fab-primary" href="javascript:void(0)"><i class="material-icons">add</i></a> -->
            <button class="md-fab md-fab-primary d_inline" id="launch_branch_create" href="javascript:void(0)" data-uk-modal="{target:'#branch_create'}"><i class="material-icons">file_upload</i></button>
        </div>
    </div>
    <!-- common functions -->
    <script src="assets/js/common.min.js"></script>
    <!-- uikit functions -->
    <script src="assets/js/uikit_custom.min.js"></script>
    <!-- altair common functions/helpers -->
    <script src="assets/js/altair_admin_common.min.js"></script>

    <!-- page specific plugins -->
    <!--  forms_file_upload functions -->
    <script src="assets/js/pages/forms_file_upload.min.js"></script>

    <!--  dashbord functions -->

    <!-- Dropzone -->
    <script type="text/javascript" src="assets/js/dropzone.js"></script>

    <!-- Dropify -->
    <script src="bower_components/dropify/dist/js/dropify.min.js"></script>
    <script type="text/javascript">
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a podcast here or click',
            }
        });

        $("#feed_create_form").on('submit', function(e){
        	e.preventDefault();

        	//ask for confirmation
        	conf = confirm("Do you want to post?");


        	if(!conf)
        		return false;


        	//disabling submit button
            $("#submit_feed").addClass('display-none')
            $("#submit_feed").attr('disabled', 'disabled')
            $(".progress-cont").removeClass('display-none')

        	//we can save now
        	var formdata = new FormData();
            var ajax = new XMLHttpRequest();

            var post_content = $("#post_content").val();
            var postTo = $("input[name='postTo']").val();

            if(post_content && postTo){
            	formdata.append('action', 'create_post');
	            formdata.append('content', post_content);
	            formdata.append('user', <?php echo $userId; ?>);
	            formdata.append('church', postTo);
	            formdata.append('userType', 'admin');
	            formdata.append('platform', 'web');

	            ajax.open("POST", "api/index.php");        
	            ajax.send(formdata);

                ajax.addEventListener("load", function(){
                    setTimeout(function(){
                        location.reload()
                    }, 1500)                    
                })
            }else{
            	alert("Specify details")
            }

            
        })


        $("#file_add_form").on('submit', function(e){
            //Adding podcasts
            //Getting inputs
            e.preventDefault();

            pname = $("#podcast-name").val();
            pintro = $("#podcast-intro").val();
            // brepresentative = $("#branch-representative").val();
            file = document.querySelector("#podcast-file").files[0];

            if(pname && pintro){
                //Here we can upload

                var formdata = new FormData();

                fields = {action:'add_podcast', church:<?php echo $churchID; ?>, name:pname, intro:pintro, file:file};

                for (var prop in fields) {
                    formdata.append(prop, fields[prop]);
                }

                //Showing progress bar
                $("#podcast-upload-progress").removeClass('display-none');

                var ajax = new XMLHttpRequest();
                ajax.addEventListener("load", function(){
                    response = this.responseText;
                    try{
                        ret = JSON.parse(response);
                        if(ret.status){
                            //create successfully(Giving notification and closing the modal);
                            $("#branch_create .act-dialog[data-role=init]").hide();

                            $("#branch_create .act-dialog[data-role=done]").removeClass('display-none');

                            setTimeout(function(){
                                location.reload();
                            }, 1000)

                        }else{
                            msg = ret.msg;
                        }
                    }catch(e){
                        console.log(e);
                    }

                }, false);
                ajax.upload.addEventListener("progress", function(evt){
                    uploaded = evt.loaded;
                    total = evt.total;

                    percentage = (uploaded/total)*100;
                    
                    $("#podcast-upload-progress").attr('value', percentage);

                    console.log(percentage)
                }, false);
                ajax.open("POST", "api/index.php");
                // ajax.setRequestHeader('Content-Type', 'multipart/form-data;charset=UTF-8');
                ajax.send(formdata);
            }
        });


        //removing podcast
        $(".podcast_remove").on('click', function(){
            podcastId = $(this).data("podcast");
            parent_elem = $(this).parents('.uk-margin-bottom');

            del_prompt = window.confirm("Delete this podcast?");
            if(del_prompt){
                $.post('api/index.php', {action:'delete_podcast', podcast:podcastId}, function(data){
                    ret = JSON.parse(data)
                    if(ret.status){
                        // parent container cleanin
                        
                        parent_elem.hide(100);
                        $(this).parents('.uk-margin-bottom').remove();
                    }
                });
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