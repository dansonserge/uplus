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
			if(!empty($_GET['id'])){
				$feed_id = $_GET['id'];
				$feed_data = get_feed($feed_id);
				$feed_cont = $feed_data['content'];
				$feed_title = $feed_data['title'];
				$feed_type = $feed_data['type'];
				$feed_attachments = json_decode($feed_data['attachment'], true);
				?>
					<div id="page_content_inner">
						<h3 class="heading_b uk-margin-bottom">Editing feed</h3>
						<div class="uk-margin-bottom uk-width-medium-2-3 uk-row-first">
							<div class="md-card">
								<div class="md-card-content">
									<form id="feed_create_form">
										<div class="uk-form-row">
											<input type="text" class="md-input" style="<?php if($feed_type != 'podcast') echo 'display: none' ?>" id="podcast_title" value="<?php echo $feed_title ?>" placeholder="Podcast title">
										</div>
										<div class="uk-form-row ">											
										   <textarea cols="30" rows="4" class="md-input feeds-textarea" id="post_content" placeholder="Something to tell the church?" required="required"><?php echo $feed_cont; ?></textarea>
										</div>
										<div class="uk-form-row">
										   <div class="uk-grid">
												<div class="uk-width-1-1">
													<div class="uk-grid">														
														<div class="uk-width-9-10 feed-thumbnail-tpl-cont" id="feed-thumbnail-tpl-cont" style="overflow-x: scroll;">
															<?php
																foreach($feed_attachments as $att){
																	?>
																		<div class="feed-thumbnail-upload" id="feed-thumbnail-tpl">
																		<!-- <div class='thumb-title'><?php echo $att; ?> <i class="material-icons" style="cursor: pointer; position: relative;left: 170%">close</i></div> -->
																		<div class="thumb-content">
																			<?php
																				$ext = strtolower(pathinfo($att, PATHINFO_EXTENSION)); //extensin
																				if($ext == 'png' || $ext == 'jpg'){
																					?>
																						<img src="<?php echo $att; ?>" alt="" style="max-height: 300px" class="blog_list_teaser_image">
																					<?php
																				}else if($ext == 'mp3' || $ext == 'aac'){
																					//audio
																					?>
																						<audio src="<?php echo $att ?>" controls></audio>
																					<?php 
																				}
																				else if($ext == 'mp4'){
																					//video
																					?>
																						<video src="<?php echo $att; ?>" width='100%' style="max-height:300px" controls></video>
																					<?php 
																				}

																			?>
																		</div>
																		<div class="thumb-toolbar">
																			<!-- <progress class="uk-progress feed_attachment_progress" value="100" max="100"> -->
																			<!-- <div class="uk-griad">
																				<div class="uploaded-size"> 0MB</div>
																				<div class="total-size"> 100mb</div>
																			</div> -->
																		</div>
																	</div>
																	<?php
																}

															?>												
														</div>
													</div>													
												</div>
												<div class="uk-width-1-3 uk-margin-top">
													<div class="uk-form-file md-btn" style="box-shadow: 0 1px 3px rgba(0, 0, 0, 0), 0 1px 2px rgba(0, 0, 0, 0);">
														<i class="material-icons">perm_media</i>
														<input id="feeds_attachment_input" type="file" multiple>
													</div>
												</div>
												<div class="uk-width-1-1 uk-width-medium-1-3 uk-float-left">
														<select class="md-input" id="target_select" title="Choose the target of this feed" required>
															<option <?php if($feed_type == 'public') echo "selected"; ?>>Public</option>
															<option value="church">My church dds</option>                                                     
															<option value="podcast" <?php if($feed_type == 'podcast') echo "selected"; ?>>Podcast</option>															
															<?php
																foreach ($forums as $key => $forum) {
																	?>
																		<option value="<?php echo $forum['id'] ?>" <?php if($feed_type == 'forum' && $feed_data['targetForum'] == $forum['id']) echo "selected"; ?> ><?php echo $forum['forumtitle'] ?></option>
																	<?php
																}
															?>
														</select>
												</div>
												<div class="uk-width-1-3">
													<span class="progress-cont display-none"><img src="assets/img/spinners/spinner_success.gif" alt="" width="32" height="32"></span>
														<button class="md-btn md-btn-primary" id="submit_feed" type="submit">Update</button>
												</div>
										   </div>
										</div>
									</form>
								</div>
							</div>
						</div>
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
											<input type="text" class="md-input" style="display: none" id="podcast_title" placeholder="Podcast title">
										</div>
										<div class="uk-form-row ">											
										   <textarea cols="30" rows="4" class="md-input feeds-textarea" id="post_content" placeholder="Something to tell the church?" required="required"></textarea>
										</div>
										<div class="uk-form-row">
											<div class="uk-width-1-1" id="feed-thumbnail-tpl-cont">
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
										   <div class="uk-grid">
												<div class="uk-width-1-4">
													<div class="uk-form-file md-btn" style="box-shadow: 0 1px 3px rgba(0, 0, 0, 0), 0 1px 2px rgba(0, 0, 0, 0);">
														<img src="gallery/upload_feed_icon.png">
														<input id="feeds_attachment_input" type="file" multiple>
													</div>
												</div>
												
												<div class="uk-width-1-1 uk-width-medium-1-6">
													<!-- style="position: absolute; right: 2%; bottom: 12%" -->
													<div>
														<!-- <ul class="uk-list" style="list-style: none; display: inline-block; margin-right: 50px">
															<li style="list-style: none; display: inline-block;">
																<input type="radio" name="postTo" id="public_post" value="<?php echo $churchID; ?>" data-md-icheck required/>
																<label for="public_post" class="inline-label">Public</label>
															</li>
															<li style="list-style: none; display: inline-block;">
																<input type="radio" name="postTo" id="church_post" value="<?php echo $churchID ?>" data-md-icheck required/>
																<label for="church_post" class="inline-label">My church</label>
															</li>
														</ul> -->
														<select class="md-input" id="target_select" title="Choose the target of this feed" required>
															<option>Public</option>
															<option value="church">My church</option>                                                     
															<option value="podcast">Podcast</option>															
															<?php
																foreach ($forums as $key => $forum) {
																	?>
																		<option value="<?php echo $forum['id'] ?>"><?php echo $forum['forumtitle'] ?></option>
																	<?php
																}
															?>
														</select>
														<!-- <div class=""><img style="width: 72px; height: 72px" src="assets/img/rot_loader.gif"></div> -->                                                        
													</div>
												</div>
												<div class="uk-width-1-6">
													<span class="progress-cont display-none"><img src="assets/img/spinners/spinner_success.gif" alt="" width="32" height="32"></span>
														<button class="md-btn md-btn-primary" id="submit_feed" type="submit">Post</button>
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
											<input type="radio" class="feed-filter" name="radio_demo" id="radio_demo_1" data-md-icheck />
											<label for="radio_demo_1" class="inline-label">Public</label>
										</p>
										<p>
											<input type="radio" name="radio_demo" id="radio_demo_2" data-md-icheck />
											<label for="radio_demo_2" class="inline-label feed-filter">My church</label>
										</p>
										<h3 class="heading_c uk-margin-bottom">Forums</h3>
										<?php
											foreach ($forums as $key => $forum) {
												?>
													<p>
														<input type="radio" name="radio_demo" id="radio_demo_2" class="feed-filter" data-md-icheck />
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
							$posts = church_feeds($churchID);
							foreach ($posts as $key => $post) {
								$post_title = $post['title'];
								$post_content = $post['content'];
								$post_pdate = $post['postedDate'];
								$post_likes = $post['nlikes'];
								$post_comments = $post['ncomments'];

								$post_attachments = json_decode($post['attachment'], true);
								?>
									<div class="uk-margin-bottom uk-width-medium-2-3 uk-width-1-1 feed-container" data-feed="<?php echo $post['id'] ?>">
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
																	<video src="<?php echo $attachment ?>" width='100%' style="max-height:300px" controls></video>
																<?php 
															}
														}
													?>
												</div>
												<div class="feed_timestamp">
													<span class="uk-text-muted uk-text-small"><?php echo date('d M Y', strtotime($post_pdate)); ?></span>
												</div>
												<div class="blog_list_footer">
													<div class="blog_list_footer_info">
														<span class="uk-margin-right"><i class="material-icons"></i> <small><?php echo $post_likes; ?></small></span>
														<span><i class="material-icons"></i> <small><?php echo $post_comments; ?></small></span>
													</div>
													<span class="uk-margin-left blog_list_footer_info"><i class="material-icons">public</i> <?php echo ucfirst($post['target_string']) ?>
													</span>
													<div class="uk-float-right">
														<span class="uk-margin-left">
															<a href="feeds.php?id=<?php echo $post['id']; ?>">
																<!-- <i class="md-icon material-icons md-color-green-500" style="cursor: pointer;" title="Remove podcast" data-post="<?php echo $post['id']; ?>">mode_edit</i> -->
															</a>
															<i class="md-icon material-icons md-color-red-500 post_remove" style="cursor: pointer;" title="Remove podcast" data-post="<?php echo $post['id']; ?>">delete</i>
														</span>
													</div>
													
													<!-- <a href="#" class="md-btn md-btn-small md-btn-flat md-btn-flat-primary uk-float-right">Read more</a> -->
												</div>
											</div>
										</div>
									</div>
								<?php
							}
						?>
					</div>
					
					<!-- Podcasts -->
					<!-- <div class="uk-grid" data-uk-grid-margin="">
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
					</div> -->
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
				thumbnail.css('display', 'inline');

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
			var title = $("#podcast_title").val(); //podcast title
			var postTo = $("#target_select").val().toLowerCase();
			

			post_str = {};

			post_target_forum = post_target_church = false; //handler for t fprum and church

			if(postTo == 'church'){
				feed_type = 'church'
				post_target_church = <?php echo $churchID ?>
			}else if(postTo == 'podcast'){
				feed_type = 'podcast'
			}else if(postTo == 'public'){
				feed_type = 'public'
			}else{
				feed_type = 'forum'
				post_target_forum = postTo
			}


			if(post_content && postTo){
				formdata.append('action', 'create_post');
				formdata.append('title', title); //for podcasts
				formdata.append('content', post_content);
				formdata.append('user', <?php echo $userId; ?>);
				formdata.append('type', feed_type);
				formdata.append('church', post_target_church);
				formdata.append('postForumId', post_target_forum);
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


		//when the feed target is triggered
		$("#target_select").on('change', function(e){
			selected = $(this).val();

			podcast_title_elem = $("#podcast_title");

			if(selected == 'podcast'){
				podcast_title_elem.show()
				podcast_title_elem.attr('required', 'required')
			}else{
				removeAttr("href");
				podcast_title_elem.hide()
				podcast_title_elem.removeAttr('required')		
			}
			console.log(e)
		})


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
		});

		//removing feed
		$(".post_remove").on('click', function(){
			feedId = $(this).data("post");
			parent_elem = $(this).parents('.uk-margin-bottom');

			del_prompt = window.confirm("Delete this feed?");
			if(del_prompt){
				$.post('api/index.php', {action:'delete_feed', feed:feedId, user:<?php echo $userId; ?>}, function(data){
					if(typeof(data) == 'object')
						ret = data
					else
						ret = JSON.parse(data)
					if(ret.status){
						// parent container cleanin
						location.reload();
						parent_elem.hide(100);
						$(this).parents('.uk-margin-bottom').remove();
					}
				});
			}            
		});


		document.querySelector('.feed-filter').addEventListener('click', function(){
			alert()
		})

		$(".feed-filter").on('click', function(){
			alert();
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