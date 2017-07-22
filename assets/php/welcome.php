<?php
if(!empty($_GET['location'])){
	$maps_url = 'http://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($_GET['location']);

	$maps_json = file_get_contents($maps_url);
	// 1st paramter object, second parameter sets json data to an array rather than object
	$maps_arr = json_decode($maps_json, true);

	$lat = $maps_arr['results'][0]['geometry']['location']['lat'];
	$lng = $maps_arr['results'][0]['geometry']['location']['lng'];	

	$ig_url = 'https://api.instagram.com/v1/media/search?lat=' . $lat . '&lng=' . $lng . '	&client_id=0c2c0fd20f0341cab9dad6124a912e31';

	$ig_json = file_get_contents($ig_url);
	$ig_arr = json_decode($ig_json, true);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>REST case</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
	Welcome <?php echo $_POST["fname"]; echo $_POST["lname"]; ?><br>
	Your email address is: <?php echo $_POST["email"]; ?>

	<form>
		<div class="form-group">
			<label for="inputText">Input Text</label>
			<input type="text" class="form-control" id="inputText" aria-describedby="subtext" placeholder="Enter Input">
			<small id="subtext" class="form-text text-muted">Please enter a location</small>
		</div>
		<button type="submit" class="btn btn-primary">Submit</button><br>
		<?php
		if(!empty($ig_arr)){
			foreach ($ig_arr['data'] as $image) {
				echo '<img src=".$image['images']['low_resolution']['url']." alt"">'
			}
		}
		?>
	</form>
</body>
</html>
