<!DOCTYPE html>
<html>
<head>
<style>
		/* these are just styles added for this demo page */
		#capture{
			width: 572px;
			height: 400px;
			background-image: url(bg_img/bg.jpg);
			background-repeat:no-repeat;
			background-size:100%;
			margin: 0 auto;
		}
		.movable_div{
			color: white;
			font-family: Verdana;
			cursor: move;
			position: absolute;
		}
		.movable_div1{
			color: white;
			font-family: Verdana;
			cursor: move;
			position: absolute;
		}
		#design{
			width: 510px;
			margin: 0 auto;
			background: purple;
			border: 1px solid black;
			color : white;
			padding: 30px;
		}
		
	</style>
	<title>Screenshot using html2canvas</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
	<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
	<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<script src="html2canvas.js"></script>
		<script src="jscolor.js"></script>
</head>
<body>
<div id="design">
		<div id="controls">
		AVCC<input type="text" value="abc" id="textbox1" />
			Text: <input type="text" value="Agurchand" id="textbox" /> <input type="button" value="Capture" id="take_screenshoot" /><br /><br />				
			Font Size: <input id="slider" type ="range" min ="12" max="50" value ="0"/><br />
			<button class="jscolor {valueElement:'chosen-value', onFineChange:'setTextColor(this)'}">
		Pick text color
	</button>

	 #<input id="chosen-value" value="000000"><br />
	 
	 <button class="jscolor {valueElement:'chosen-value1', onFineChange:'setTextColor1(this)'}">
		Pick text color
	</button>

	 #<input id="chosen-value1" value="000000"><br />
			<input type="file" id="background" onchange="readURL(this);"/>
			</div>
			</div>
	<div id="capture">
		<div class="movable_div"><h1>Agurchand</h1> </div>
		<div class="movable_div1"> <p>abc</p> </div>
	</div>
	<div style="margin-top: 50px; text-align: center;">
		<button id="take_screenshoot">Take Screenshot</button>
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
			
			////to change the background once the user select
//			$('#background').change(function(){
//				var background = $(this).val();
//				$('#capture').css('background', 'url(bg_img/'+background+')');
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
				window.location('screenshot.html');
				<!--location.reload();-->
			}
		});
		
	}

</script>
    <script> function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    document.getElementById('capture').style.backgroundImage = "url(" + reader.result + ")";  
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
		</script>
</body>
</html>