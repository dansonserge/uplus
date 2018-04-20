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
	app_user = $("#app_invite_users tr td input.checkbox_elem:checked");

	email_invites = $("#app_invite_users tr td input.checkbox_elem:checked")

	invite_emails = $("#invite_emails").val().split(',');
	invite_text = $("#invite_text").html();

	if(app_user.length>0 || email_invites.length>0){
		conf = window.confirm("Are you sure?\nYou will invite all the mentioned people to join the forum with the text provided?")
	}else{
		alert("Please add some users")	
	}
})