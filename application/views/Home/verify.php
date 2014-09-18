<div class="row">
	<div class="col-sm-6 col-sm-offset-3">
		<br/><br/><br/><br/>
		<?php if (is_null($output))
			redirect('/');
			else print_r($output);
		?>

		<form class="form-signin" action="home/checkVerify" method="post">
			<h1 class="form-signin-heading text-muted">Phone Verify</h1>
			<br/>
			<p class="text text-info"> Check your SMS at: <?php echo $phone;?></p>
			<p class="text text-info">ex: 123-123</p>

			<div class="input-group input-group-lg">
				<span class="input-group-addon"><i class="fa fa-mobile-phone fa-2x"></i></span>
				<input type="hidden" name="phone" value="<?php echo $phone;?>">
				<input type="text" class="form-control " placeholder="Verify Number" name="verifyNumber">
			</div>
			<br/>
			<button class="btn btn-primary" type="submit">
				Verify
			</button>
		</form>
	</div>
</div>
