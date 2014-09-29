<?php include("includes/options.php"); ?>
<?php include("includes/db.php"); ?>
<?php include("includes/header.php"); ?>
<?php
session_start();
if($_SESSION['user']==''){
 header("Location:index.php");
}else{

 $sql=$dbh->prepare("SELECT * FROM users WHERE id=?");
 
 $sql->execute(array($_SESSION['user']));

 while($r=$sql->fetch()){

  $welcome = "<center><h2>Hello, ".$r['username']."</h2></center>";
 }

}
?>

<div class="row">
    <div class="large-12 columns">
		<?php echo $welcome; ?>
	</div>
</div>
<div class="row">
<div class="large-6 medium-6 columns">
<div class="panel">
	<h4>Your messages:</h4>
	<p>You have 0 messages.</p>
</div>
</div>
<div class="large-6 medium-6 columns">
<div class="panel">
	<h4>Send a message:</h4>
	<form>
		  <div class="row">
			<div class="large-12 columns">
			  <label>From:</label>
			  <select>
				<?php
						$sql=$dbh->prepare("SELECT * FROM userkeys WHERE userid=?");
						$sql->execute(array($_SESSION['user']));
						while($r=$sql->fetch()){
						echo "<option value=\"".$r['keyname']."\">".$r['keyname']."</option>";
						}
					?>
			  </select>
			  <label>To:</label>
			  <select>
				<option value="husker">Husker</option>
				<option value="starbuck">Starbuck</option>
				<option value="hotdog">Hot Dog</option>
				<option value="apollo">Apollo</option>
			  </select>
			  <label>Message:</label>
			  <textarea placeholder="Type your message here"></textarea>
			   <input type="submit" class="small button" value="Send Message"/>
			</div>
			
		  </div>
		  
		</form>
</div>
</div>
</div>
<div class="row">
	<div class="large-6 columns">
		<div class="panel">
			<h4>Your Addresses</h4>
			<form method="post" action="genkey.php">
		  <div class="row">
			<div class="large-8 columns">
			  <label>Create a new address</label>
			  <input type="text" name="passphrase" placeholder="Passphrase." />
			</div>
			<div class="large-4 columns">
				<br />
			  <input type="submit" class="small button" value="Create Address"/>
			</div>
			
		  </div>
		  
		</form>
		<div class="row">
			<div class="large-12 columns">
				<ul>
					<?php
						$sql=$dbh->prepare("SELECT * FROM userkeys WHERE userid=?");
						$sql->execute(array($_SESSION['user']));
						while($r=$sql->fetch()){
						echo "<li>".$r['keyname']."</li>";
						}
					?>
				</ul>
			</div>
		</div>
		</div>
	</div>
	<div class="large-6 columns">
		<div class="panel">
			<h4>Your Contacts</h4>
			<form method="post" action="handshake.php">
		  <div class="row">
			<div class="large-12 columns">
			  <label>Add a contact</label>
			  <input type="text" name="contact" placeholder="Public Address." />
			  <label>Your Address</label>
			  <select name="address">
				<?php
						$sql=$dbh->prepare("SELECT * FROM userkeys WHERE userid=?");
						$sql->execute(array($_SESSION['user']));
						while($r=$sql->fetch()){
						echo "<option value=\"".$r['keyname']."\">".$r['keyname']."</option>";
						}
					?>
			  </select>
			  <label>Associate a name? (optional)</label>
			  <input type="text" placeholder="Your Name." />
			  <input type="submit" class="small button" value="Add Contact"/>
			</div>
		
		  </div>
		  
		</form>
		</div>
	</div>
</div>

<?php include("includes/footer.php"); ?>