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
            //forums
            $forums = church_forums();
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

                    <!-- Feedds input -->
                    <div class="uk-grid" data-uk-grid-margin="">
                        <div class="uk-margin-bottom uk-width-medium-2-3 uk-row-first">
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
						                                <input id="feeds_attachment_input" type="file" multiple>
						                            </div>
		                                       	</div>
                                                <div class="uk-width-1-2" id="feed-thumbnail-tpl-cont">
                                                    <div class="feed-thumbnail-upload" style="display: none;" id="feed-thumbnail-tpl">
                                                        <div class='thumb-title'>Here <i class="material-icons" style="cursor: pointer; position: relative;left: 170%">close</i></div>
                                                        <div class="thumb-content"></div>
                                                        <div class="thumb-toolbar">
                                                            <progress class="uk-progress feed_attachment_progress" value="10" max="100">
                                                            <div class="uk-griad">
                                                                <div class="uploaded-size"> 0MB</div>
                                                                <div class="total-size"> 100mb</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
											    <div class="uk-width-1-4">
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
                        <div class="uk-margin-bottom uk-width-medium-1-3">
                            <div class="md-card">
                                <div class="md-card-content">
                                    <h3 class="heading_c uk-margin-medium-bottom">Filter Feeds</h3>
                                    <div class="">
                                        <p>
                                            <input type="radio" name="radio_demo" id="radio_demo_1" data-md-icheck />
                                            <label for="radio_demo_1" class="inline-label">Public</label>
                                        </p>
                                        <p>
                                            <input type="radio" name="radio_demo" id="radio_demo_2" data-md-icheck />
                                            <label for="radio_demo_2" class="inline-label">My church</label>
                                        </p>
                                        <h3 class="heading_c uk-margin-bottom">Forums</h3>
                                        <?php
                                            foreach ($forums as $key => $forum) {
                                                ?>
                                                    <p>
                                                        <input type="radio" name="radio_demo" id="radio_demo_2" data-md-icheck />
                                                        <label for="radio_demo_2" class="inline-label"><?php echo $forum['forumtitle'] ?></label>
                                                    </p>
                                                <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- POsted feeds -->
                    <div class="uk-grid" data-uk-grid-margin="">
                        <?php
                            $posts = getPosts($churchID);
                            foreach ($posts as $key => $post) {
                                $post_title = $post['title'];
                                $post_content = $post['content'];
                                $post_pdate = $post['postedDate'];
                                $post_likes = $post['nlikes'];
                                $post_comments = $post['ncomments'];

                                $post_attachments = json_decode($post['attachment'], true);
                                ?>
                                    <div class="uk-margin-bottom uk-width-medium-2-3 uk-width-1-1">
                                        <div class="md-card">
                                            <div class="md-card-content small-padding">
                                                <div class="blog_list_teaser" style="margin-bottom: 12px;">
                                                    <?php if(!empty($post_title)){
                                                        ?>
                                                        <h2 class="blog_list_teaser_title uk-text-truncate"><?php echo $post_title; ?></h2>
                                                        <?php
                                                    } ?>                                                    
                                                    <p>
                                                        <?php echo $post_content; ?>
                                                    </p>
                                                </div>
                                                <div class="media-container">
                                                    <?php
                                                        for($n=0; $n<count($post_attachments); $n++){
                                                            $attachment = $post_attachments[$n];
                                                            $ext = strtolower(pathinfo($attachment, PATHINFO_EXTENSION)); //extensin
                                                            if($ext == 'png' || $ext == 'jpg'){
                                                                ?>
                                                                    <img src="<?php echo $attachment; ?>" alt="" style="max-height: 300px" class="blog_list_teaser_image">
                                                                <?php
                                                            }else if($ext == 'mp3' || $ext == 'aac'){
                                                                //audio
                                                                ?>
                                                                    <audio src="<?php echo $attachment ?>" controls></audio>
                                                                <?php 
                                                            }
                                                            else if($ext == 'mp4'){
                                                                //video
                                                                ?>
                                                                    <video src="<?php echo $attachment ?>" width='100%' controls></video>
                                                                <?php 
                                                            }
                                                        }
                                                    ?>
                                                    <!-- <img src="assets/img/gallery/Image01.jpg" alt="" class="blog_list_teaser_image"> -->
                                                </div>
                                                <div class="feed_timestamp0">
                                                    <span class="uk-text-muted uk-text-small"><?php echo date('d M Y', strtotime($post_pdate)); ?></span>
                                                </div>
                                                <div class="blog_list_footer">
                                                    <div class="blog_list_footer_info">
                                                        <span class="uk-margin-right"><i class="material-icons"></i> <small><?php echo $post_likes; ?></small></span>
                                                        <span><i class="material-icons"></i> <small><?php echo $post_comments; ?></small></span>
                                                    </div>
                                                    <a href="#" class="md-btn md-btn-small md-btn-flat md-btn-flat-primary uk-float-right">Read more</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                            }
                        ?>
                    </div>
                    
                    <div class="uk-grid" data-uk-grid-margin="">
                        <?php
                            //getting podcasts
                        	$podcats = church_podcasts($churchID);                            

                            //Getting branches
                            $branches = churchbranches($churchID);
                            for($n=0; $n<count($podcats); $n++){
                                $podcast = $podcats[$n];

                                //getting representative
                                // $rep = user_details($branch['repId']);
                        ?>
                        <div class="uk-margin-bottom uk-width-medium-1-3 uk-width-1-1">
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


        var feeds_attachment = [];
        $("#feeds_attachment_input").on('change', function(data){
            uploaded = document.querySelector("#feeds_attachment_input").files[0];
            // log(uploaded);

            filename = uploaded.name
            file_size = uploaded.size

            //here we want to check the extension
            ext = filename.substr(-3).toLowerCase();

            allowed_extensions = ['png', 'jpg', 'mp3', 'aac', 'mp4'];
            if(allowed_extensions.indexOf(ext)>-1){
                //file is allowed
                //create an elemt thumbnail for file
                thumbnail = $("#feed-thumbnail-tpl").clone()
                thumbnail.css('display', 'inherit');

                //Adding the title
                thumbnail.find(".thumb-title").html(filename);

                $("#feed-thumbnail-tpl-cont").append(thumbnail);

                //Start to upload
                var formdata = new FormData();

                formdata.append('action', 'upload_feed_attachment');
                formdata.append('file', uploaded);

                var ajax = new XMLHttpRequest();

                ajax.upload.addEventListener("progress", function(evt){
                    uploaded = evt.loaded;
                    total = evt.total;

                    percentage = (uploaded/total)*100;
                    
                    thumbnail.find(".feed_attachment_progress").attr('value', percentage);

                    console.log(percentage)
                }, false);


                ajax.addEventListener("load", function(){
                    response = this.responseText;
                    try{
                        ret = JSON.parse(response);
                        if(ret.status){
                            //create successfully(Giving notification and closing the modal);
                            feeds_attachment.push(ret.msg)

                        }else{
                            msg = ret.msg;
                        }
                    }catch(e){
                        console.log(e);
                    }

                }, false);

                ajax.open("POST", "api/index.php");
                ajax.send(formdata);
            }else{
                alert("File of "+ext+ " type not allowed")
            }
        })

        //creating feed
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
	            formdata.append('attachments', JSON.stringify(feeds_attachment));
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

        //create podcast
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

        function log(data){
            console.log(data);
        }
    </script>
</body>
</html>