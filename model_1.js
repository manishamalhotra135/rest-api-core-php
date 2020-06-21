// Get the modal
var modal = document.getElementById("myModal");
var table = $("#myModal").find("#list_table");

// Get the button that opens the modal
var btn = document.getElementById("list_btn");

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
$(document).ready(function(){
  $("#list_btn").click(function(){
    $.ajax({
		url: "http://localhost/map/api-example",
		data: "task=findAll&option=user",
		before: function(){
			console.log('inside before');
			
		},
		success: function(result){
			console.log(result);
			$.each(result.data, function( index, value ) {
				$('#list_table tr:last').after('<tr><td>'+value.learner_email+'</td><td>'+value.learner_name+'</td></tr>');
			});
			//$('#myTable > tbody:last-child').append('<tr>...</tr><tr>...</tr>');
		  //$("#div1").html(result);
		}
	});
  });
});
