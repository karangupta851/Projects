<!DOCTYPE html>
<html>
<head>
	<title>Screenshot using html2canvas</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
		<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
	<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script src="html2canvas.js"></script>
	<script src="jscolor.js"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<div class="row">

	

    <form>
	    <div class="col-md-4">
<div class="panel panel-default">
        <div class="form-group">
		<label for="imageUpload">Upload Image File</label>
            <input type="file" class="form-control" onchange="readURL(this);" />
        </div>
        <div class="form-group">

            <label for="fontSize">Set Font Size</label>
            <input id="slider" type ="range" min ="12" max="100" value ="0"/>
        </div>
	    <div class="form-group">
		<label for="fontColor">Set Font Color</label>
            <button class="jscolor {valueElement:'chosen-value', onFineChange:'setTextColor(this)'}" >Set Font Color</button>
        </div>
	    </div>
		    </div>
	    <div class="col-md-4">
	    <div class="panel panel-default">
	    <div class="form-group">
		<label for="fontColor">Set Font Color</label>
            <button class="jscolor {valueElement:'chosen-value1', onFineChange:'setTextColor1(this)'}">Set Font Color</button>
        </div>
	    <div class="form-group">
		<label for="backgroundColor">Set Background Color</label>
            <button class="jscolor {valueElement:'chosen-value2', onFineChange:'setTextColor2(this)'}">Set Background Color</button>
        </div>
		    <div class="form-group">
		    <button id="take_screenshoot">Take Screenshot</button>
		    </div>
	    </div>
</div>
    </form>


	<div id="capture" class="capture">
		<div class="movable_div"> <h1>Agurchand</h1> </div>
		<div class="movable_div1"> <p>abc</p> </div>
	</div>
	<div>
		
	</div>

	<script type="text/javascript">
	$(function(){	
			
			//to make a div draggable
			$('.movable_div').draggable(
				{containment: "#canvas", scroll: false}
			);
			$('.movable_div1').draggable(
				{containment: "#canvas", scroll: false}
			);
			//to capture the entered text in the textbox 
			$('#textbox').keyup(function(){
				var text = $(this).val();
				$('.movable_div').text(text);
			});	
			$('#textbox1').keyup(function(){
				var text = $(this).val();
				$('.movable_div1').text(text);
			});	
			//font size handler here. 
			$('#capture').change(function(){
				Width = $(this).val();
				$('.capture').css('width', Width+'%');
			});	
			
			//to change the background once the user select
			//$('#background').change(function(){
//				var background = $(this).val();
//				$('#canvas').css('background', 'url(bg_img/'+background+')');
//			});
			
			//font size handler here. 
			$('#slider').change(function(){
				fontSize = $(this).val();
				$('.movable_div').css('font-size', fontSize+'px');
			});		
			$('#slider').change(function(){
				fontSize = $(this).val();
				$('.movable_div1').css('font-size', fontSize+'px');
			});
	
	
		var dataURL = {};
		$('#take_screenshoot').click(function(){
			html2canvas(document.querySelector("#capture")).then(canvas => {
				document.body.appendChild(canvas);

	    //console.log(canvas.toDataURL());
	    dataURL = canvas.toDataURL();
	    post_data(dataURL);  	

	  });

		});
		});


		function post_data(imageURL){
		//console.log(imageURL);
		$.ajax({
			url: "save_data.php",
			type: "POST",
			data: {image: imageURL},
			dataType: "html",
			success: function() {
				alert('Success!!');
				<!--location.reload();-->
				window.location('screenshot.html');
			}
		});
		
	}
	
	     function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    document.getElementById('capture').style.backgroundImage = "url(" + reader.result + ")";  
                };

                reader.readAsDataURL(input.files[0]);
            }
     }

</script>

<script>
	function setTextColor(picker) {
		document.getElementsByTagName('h1')[0].style.color = '#' + picker.toString()
	}
	</script>
	<script>
	function setTextColor1(picker) {
		document.getElementsByTagName('p')[0].style.color = '#' + picker.toString()
	}
	</script>
	<script>
	function setTextColor2(picker) {
		document.getElementById('capture').style.background = '#' + picker.toString()
	}
	</script>
	</div>
	</div>
</body>
</html>
