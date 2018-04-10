<!DOCTYPE html>
<html>
<head>
	<title>Firebase learning</title>
	<input type="text" id="messageInput" name="">	
	<button>submit</button>

	<div id="results" ></div>
</head>
<body>
	<script type="text/javascript" src="churches/js/jquery.js"></script>
	<script src="https://cdn.firebase.com/js/client/2.4.2/firebase.js"></script>
	<script type="text/javascript">



		var messagesRef = new Firebase('https://learnbase-baa6d.firebaseio.com/new_stuff');

		var messageField = document.getElementById('messageInput');

		document.querySelector('button').addEventListener('click', function(){
			savedata();
		})

		// $.post('api/index.php', {
		// 	action:'list_forums'
		// }, function(data){
		// 	for(n=0; n<data.length; n++)
		// 	{
		// 		messagesRef.push(data[n]);
		// 	}
		// })

		// Save data to firebase
		function savedata(){
		  var message = messageField.value;

		  messagesRef.push({'posts':{fieldName:'messageField', text:message}});
		  messagesRef.push({fieldName:'messageField', text:message});
		  messageField.value = '';
		}

		messageResults = document.querySelector('#results')

		messagesRef.limitToLast(10).on('child_added', function (snapshot) {
		    var data = snapshot.val();


		    console.log(snapshot.val())

		    var message = data.forumTitle;

		    if (message != undefined)
		    {
		      messageResults.innerHTML += '\n' + message+'<br />';
		    }
		});
	</script>
</body>
</html>