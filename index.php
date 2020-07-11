<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Untitled</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <!-- <link rel="author" href="humans.txt"> -->
    </head>
    <body>
    <div class="container">

		<!-- <form class="form-group" action="welcome.php" method="post">
			<input type="hidden" value="insert" name="action">
		Name: <input type="text" name="name"><br>
		Lastname: <input type="text" name="lastname"><br>
		<input type="submit">
		</form> -->
		<div id="loading">Loading...</div>
		<div class="content" >
		<table class="table" border="1">
			<tr>
				<th>ID</th>
				<th>Username</th>
				<th>Lastname</th>
				<th>Action</th>
			</tr>
			<tbody id="getusers">

				
			</tbody>

		</table>
		</div>
    	
    </div>

    <div class="modal" id="modalrofel" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title modaltitle"></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body modalbody ">
	        
	      </div>
	      <!-- <div class="modal-footer">
	        <button type="button" class="btn btn-primary">Save changes</button>
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      </div> -->
	    </div>
	  </div>
	</div>
    	
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>	
    </body>
</html>
<script>
	$('.content').hide();

	$(document).ready(function(){
		$('.content').show();
		$('#loading').hide();

		//Get all users
		function getUsers(){
			$.ajax({

				url: "welcome.php", 
				method: 'post',
				dataType: 'html',
				data: {'action': 'getAllusers'},
				success: function(result){
					$('#getusers').html(result)
			    	// console.log(result)
				}
			});
		}
		getUsers();
		


		//Open modal
		$(document).on('click','.deletebtn',function(){
			// alert('rofel')
			var action;

			$('#modalrofel').modal()
			var id = $(this).data('userid')
			var uri = $(this).data('type')
			action = 'delete'
			ajaxmethod(action, id, uri)

			console.log(uri)
			

		});
		//Edit user

		$(document).on('click','.editbtn',function(){
			// alert('rofel')
			var action;

			$('#modalrofel').modal()
			var id = $(this).data('userid')
			var uri = $(this).data('type')
			action = 'update'
			ajaxmethod(action, id, uri)

			console.log(uri)
			

		});

		function ajaxmethod(actions, id, uri){

			$.ajax({

			url: "welcome.php", 
			method: 'post',
			dataType: 'html',
			data: {'action': actions, 'userid': id},
				success: function(result){
					if(uri == 'delete'){
						
						$('.modaltitle').html('Delete this user');
						$('.modalbody').html(result);

					}else if('edit'){


						$('.modaltitle').html('Update this user');
						$('.modalbody').html(result);

					}
					
				}
			});
		}

		$(document).on('submit','#modalform', function(e){
		
			var user = $('input[name=user_id]').val();
			$.ajax({

			url: "welcome.php", 
			method: 'post',
			dataType: 'html',
			data: {'action': 'confirmdelete', 'userid': user},
				success: function(result){
					$('.modalbody').html(result)
					getUsers();
					
				}
			});


			return false;
		})

	});
</script>
