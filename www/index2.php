<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Cat Maps</title>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
  <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.3.0/bootstrap.min.css" />
  <script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/tags/markerclusterer/1.0/src/markerclusterer.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAyw_jAHviQhSCEmHuwmoaLDBncy0f9n_w&callback=initMap"></script>
  <link rel="stylesheet" type="text/css" href="addMarker.css" />
  <link rel="stylesheet" type="text/css" href="catForm.css" />
  <script type="text/javascript" src="../mainGoogle.js"></script>
  <script type="text/javascript" src="../catForm.js"></script>
  <style>
      .ui-widget-header,.ui-state-default, ui-button{
         background:#b9cd6d;
         border: 1px solid #b9cd6d;
         color: #FFFFFF;
         font-weight: bold;
      }
   </style>
</head>
<body>
	<div id="topMenu">
		<button>Create new cat</button>
	</div>
  	
  	<div id="main">
	  	<div id="leftColumn">
		  	<div class="catForm">
				<div class="catForm-heading">Provide your information</div>
				<form action="" method="post">
				<label for="field1"><span>Name <span class="required">*</span></span><input type="text" class="input-field" name="field1" value="" /></label>
				<label for="field2"><span>Email <span class="required">*</span></span><input type="text" class="input-field" name="field2" value="" /></label>
				<label><span>Telephone</span><input type="text" class="tel-number-field" name="tel_no_1" value="" maxlength="4" />-<input type="text" class="tel-number-field" name="tel_no_2" value="" maxlength="4"  />-<input type="text" class="tel-number-field" name="tel_no_3" value="" maxlength="10"  /></label>
				<label for="field4"><span>Regarding</span><select name="field4" class="select-field">
				<option value="General Question">General</option>
				<option value="Advertise">Advertisement</option>
				<option value="Partnership">Partnership</option>
				</select></label>
				<label for="field5"><span>Message <span class="required">*</span></span><textarea name="field5" class="textarea-field"></textarea></label>
				
				<label><span>&nbsp;</span><input type="submit" value="Submit" /></label>
				</form>
			</div>
		</div>
		
		<div id="map">
	    
	    </div>
	</div>
      
        
  <div id="dialog-4" title="Dialog Title goes here...">This my first jQuery UI Dialog!</div>
  <button id="opener-4">Open Dialog</button>
      
  <script>
      $(function() {
         $( "#dialog-4" ).dialog({
            autoOpen: false, 
            modal: true,
            buttons: {
               OK: function() {$(this).dialog("close");}
            },
         });
         $( "#opener-4" ).click(function() {
            $( "#dialog-4" ).dialog( "open" );
         });
      });

      google.maps.event.addDomListener(window, "load", initialize);
   </script>
</body>
</html>
