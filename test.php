<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
</head>
<body>
<div class="ui-widget">
<img id="project-icon" height="200" src="images/transparent_1x1.png" class="ui-state-default" alt>
<input id="project">
<input type="hidden" id="project-id">
<p id="project-description"></p>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$( "#project" ).autocomplete({
			minLength: 0,
			source: 'search.php',
			focus: function( event, ui ) {
				$( "#project" ).val( ui.item.label );
				return false;
			},
			select: function( event, ui ) {
				$( "#project" ).val( ui.item.label );
				$( "#project-id" ).val( ui.item.value );
				$( "#project-icon" ).attr( "src", "admin/products/photos/" + ui.item.photo );

				return false;
			}
		})

			.autocomplete( "instance" )._renderItem = function( ul, item ) {
				return $( "<li>" )
				.append( `<div> 
					${item.label}
					<br>
					<img src='admin/products/photos/${item.photo}' height='50'>
					`)
				.appendTo( ul );
			};
		});
</script>

</body>
</html>