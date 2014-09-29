<?php include("includes/options.php"); ?>
<?php include("includes/db.php"); ?>
<?php include("includes/header.php"); 

session_start();?>
    
    <div class="row">
      <div class="large-12 columns">
        <h1>Welcome to MsgSec</h1>
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
      	<div class="panel">
	        <h3>A secure messaging application.</h3>
	        <p>To get started, create an account below.</p>
      	</div>
      </div>
    </div>

    <div class="row">
      <div class="large-6 medium-6 columns">
        <form>
		  <div class="row">
			<div class="large-12 columns">
			  <label>Username</label>
			  <input type="text" placeholder="Must be longer than 8 characters." />
			</div>
		  </div>
		  <div class="row">
			<div class="large-12 columns">
			  <label>Password</label>
			  <input type="text" placeholder="Must be longer than 8 characters." />
			</div>
		  </div>
		  <input type="submit" class="small button" value="Create Account"/>
		</form>
      </div>     

      <div class="large-6 medium-6 columns">       
		<div class="panel">
        	<h5>Already have an account?</h5>
        	<p>Log in here.</p>
			<form method="POST" action="login.php">
			  <div class="row">
				<div class="large-12 columns">
				  <label>Username</label>
				  <input type="text" name="username" placeholder="Must be longer than 8 characters." />
				</div>
			  </div>
			  <div class="row">
				<div class="large-12 columns">
				  <label>Password</label>
				  <input type="text" name="password" placeholder="Must be longer than 8 characters." />
				</div>
			  </div>
			  <input type="submit" class="small button" value="Log In"/>
			</form>          
        </div>
      </div>
    </div>
    
<?php include("includes/footer.php"); ?>
