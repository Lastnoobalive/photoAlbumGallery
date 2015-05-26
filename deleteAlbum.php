<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="CSS/weblayout.css">
		<title> Pics </title>
	</head>
	<body>
	<div id="title"> Snap! </div>
	<ul id="navigation">
			<li class="navigation-element"><a href="index.php">Home</a></li>					
			<li class="navigation-element"><a href="albums.php">Albums</a></li>
			<li class="navigation-element"><a href="albumSearch.php">Album Search</a></li>
			<li class="navigation-element"><a href="pictures.php">Pictures</a></li>
			
			
			<?php 
			if(isset($_SESSION['logged_user']) )
			{
				if(($_SESSION['logged_user'])=="jit8")
				{
					print "<li class='navigation-element'><a href='albumCreate.php'>Create Album</a></li>";
					print "<li class='navigation-element'><a href='allpics.php'>See All Pictures</a></li>";
				}
			print "<li class='navigation-element'><a href='logout.php'>Logout</a></li>";
			}
			else
			{
			print "<li class='navigation-element'><a href='login.php'>Login</a></li>";
			}
			?>
	</ul>
<?php
	if((!isset($_SESSION)||($_SESSION['logged_user']!='jit8')))
	{
		print "<p class='error'> Don't be sneaky, you can't edit using hax or you aren't me, gtfo. </p>";
	}
	if(!(isset($_GET['name']) && isset($_GET['id'])))
	{
		print "<p class='error'> Please Select an <a href='albums.php'> Album </a></p>";
	}
	else
	{
?>
		<h1 class="pageTitle">Delete Album : <?php print $_GET['name'] ?></h1>
			<form action="deleteAlbum.php" method="post">
			Are You Sure? Its your last chance.. <input type="radio" value="yes" name="prompt"> Yes </input>
			<input type="radio" value="no" name="prompt"> No </input>
			<?php $maid=$_GET['id'];
			print "<input type='hidden' name='albumID' value='$maid' />"; ?>
			<input type="submit" name="submit" value="Delete" />
		</form>
<?php } ?>
    <?php
 
	if(isset($_POST['submit']))
	{
		$albumID=$_POST['albumID'];
		if(isset($_POST['prompt']))
		{
			if($_POST['prompt']=="yes")
			{			
				require_once 'config.php';
				$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASSWORD, DB_NAME );
				$mysqli->query("DELETE FROM Associations WHERE albumID=$albumID");
				$mysqli->query("DELETE FROM Albums WHERE albumID=$albumID");
				print "<p> Deleted. </p>";
			}
			else
			{
			print "<p> Okay, just asking.. Click above to go back </p>";		
			}
		}
		else
		{
			print "<p> Say yes or no next time... </p>";		
		}
	}
	?>
	
	</body>
</html>