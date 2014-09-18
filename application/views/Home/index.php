<div class="row">
	<div class="col-sm-6 col-sm-offset-3">
		<br/><br/><br/><br/>
		<?php
			if ($message) {
				var_dump($message);
			}
		?>
		<form class="form-signin" action="home/register" method="post">
			<h1 class="form-signin-heading text-muted">Register Whatsapp</h1>
			<br/>
			<p class="text text-info">ex: 85510121212</p>

			<div class="input-group input-group-lg">
				<span class="input-group-addon"><i class="fa fa-mobile-phone fa-2x"></i></span>
				<input type="text" class="form-control " placeholder="Phone number" name="phone">
			</div>
			<br/>
			<button class="btn btn-primary" type="submit">
				Submit
			</button>
		</form>
	</div>
</div>
