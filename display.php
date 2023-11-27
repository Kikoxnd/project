 <!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/popup.css">
</head>
<body>

<h2>Animated Modal with Header and Footer</h2>

<!-- Trigger/Open The Modal -->
<button id="myBtn">Open Modal</button>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>Modal Header</h2>
    </div>
    <div class="modal-body">
      <p>Some text in the Modal Body</p>
      <p>Some other text...</p>
    </div>
    <div class="modal-footer">
      <h3>Modal Footer</h3>
    </div>
  </div>

</div>

<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

</body>
</html>
dflkjgdsklgjsdikf
<table class="table table-bordered table-striped">
    <thead>
    	<tr class="btn-primary">
	    	<th>S.No.</th>
	    	<th>Name</th>
	    	<th>Phone Number</th>
	    	<th>Email</th>
	    	<th></th>
	    </tr>
    </thead>
    <tbody>
    	<?php 
    		$sql = 'SELECT * FROM user'; 
    		$result = mysqli_query($con,$sql);
    		$i = 1;
    		while($row = mysqli_fetch_array($result)) 
    		{
    	?>
    	<tr>
	    	<td><?php echo $i; ?></td>
	    	<td><?php echo $row['name']; ?></td>
	    	<td><?php echo $row['phone']; ?></td>
	    	<td><?php echo $row['email']; ?></td>
	    	<td>

            // here i am creating a button to open a modal popup

	    	<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal<?php echo $row['id'] ?>">View</button>



	    	</td>
    	</tr>

        //  here i am creating a modal popup code.........

    	<div id="myModal<?php echo $row['id'] ?>" class="modal fade" role="dialog">
			<div class="modal-dialog">
			    <div class="modal-content">
					<div class="modal-header">
						 <button type="button" class="close" data-dismiss="modal">&times;</button>
						    <h4 class="modal-title">Details</h4>
				    </div>
				    <div class="modal-body">
						 <h3>Name : <?php echo $row['name']; ?></h3>
						 <h3>Mobile Number : <?php echo $row['phone']; ?></h3>
						 <h3>Email : <?php echo $row['email']; ?></h3>
				    </div>
				</div>
			</div>
		</div>

        // end modal popup code........

    	<?php 
    		$i++;
    		}
    	?>
    </tbody>
</table>
