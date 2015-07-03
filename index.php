<!DOCTYPE html>
<html>
<head>
	<title>Ajax Multiple File Uploader</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<div class="container">
	<div class="row">
		<div class="well" id="app">

			<h2 class="text-center">Ajax Multiple File Uploader</h2>

			<div class="alert alert-danger" v-if="errors.length">
				<p><b>Whoops!</b> There were some problems with your input.</p>
				<ul >
					<li v-repeat="error: errors">{{ error }} </li>
				</ul>
			</div>

			<div class="alert alert-success" v-show=" success != '' ">
				<b> All files has been uploaded successfully. </b>
				<ul>
					<li v-repeat="message: success">{{ message }} </li>
				</ul>
			</div>

			<div class="progress" v-show="progress">
				<div class="progress-bar" style="width: 0%;" v-el="progressbar"></div>
			</div>

			<form method="post" enctype="multipart/form-data" v-on="submit: upload">
				<div class="form-group">
					<label>Upload: </label>
					<input type="file"  name="files[]" multiple="multiple" data-max-upload-size="2">
				</div>
				<div class="form-group">
					<input type="submit" value="Upload" name="submit" class="btn btn-primary">
					<input type="reset" value="Clear" v-el="clear" class="btn btn-danger">
				</div>
			</form>

		</div>
	</div>
</div>




<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/0.12.4/vue.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>

</body>
</html>
