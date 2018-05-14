@if (count($errors))
	<div class="form-group">
		<div class="alert alert-danger">
			<ul>
<?php 		if (gettype($errors)=="array") {   ?>
				@foreach ($errors as $error)
					<li>{{ $error }}</li>
				@endforeach
<?php 		} 
	 		if (gettype($errors)=="string") {   ?>
					<li>{{ $errors }}</li>
<?php 		} 	?>
			</ul>
		</div>
	</div>
@endif
