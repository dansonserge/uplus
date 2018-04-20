// JS FOR forums page
//Checkall enables the checking of all other members
$(".checkall").on('change', function(){
    //getting all members to be checked
    // checkbox_elem
    elems = $(this).parents("table").find(".checkbox_elem");

    log($(this).prop('checked'))

    $(elems).prop('checked', $(this).prop('checked'));
    
});

$("#invite_member_btn").on('click', function(){

	//getting the audience
	app_user = $("#app_invite_users tr td input.checkbox_elem:checked")
	email_invites = $("#app_invite_users tr td input.checkbox_elem:checked")

	// invite_emails = $("#invite_emails").val().split(',');
	invite_emails = $("#invite_emails").val().split(',');
	invite_text = $("#invite_text").html();

	if(app_user.length > 0 || invite_emails.length > 0){
		conf = window.confirm("Are you sure?\nYou will invite all the mentioned people to join the forum with the text provided?");
		if(conf){
			//getting user ids
			var userIds = []
			for (var i = app_user.length - 1; i >= 0; i--) {
				user = app_user[i]
				userIds.push($(user).data('id'))
			}

			// console.log(userIds);

			//preparing to send the invitation
			$.post('api/index.php', {action:'invite_users', users:userIds, emails:invite_emails, message:invite_text, invitedBy:current_user})
		}
	}else{
		alert("Please add some users")	
	}
})