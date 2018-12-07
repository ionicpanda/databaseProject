<?php

/**
 * Use an HTML form to create a new entry in the
 * users table.
 *
 */


if (isset($_POST['submit'])) {
	require "config.php";
	require "common.php";

	try {
		$connection = new PDO($dsn, $username, $password, $options);
		
		$new_instrument = array(
			"name" => $_POST['name'],
			"invented"  => $_POST['invented'],
			"musickey"     => $_POST['musickey'],
			"clef"       => $_POST['clef'],
		);

		$sql = sprintf(
				"INSERT INTO %s (%s) values (%s)",
				"instruments",
				implode(", ", array_keys($new_instrument)),
				":" . implode(", :", array_keys($new_instrument))
		);
		
		$statement = $connection->prepare($sql);
		$statement->execute($new_instrument);
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}
	
}
?>

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
	<blockquote><?php echo $_POST['name']; ?> successfully added.</blockquote>
<?php } ?>

<h2>Add an instrument</h2>

<form method="post">
	<label for="name">Name</label>
	<input type="text" name="name" id="name">
	<label for="invented">Invented</label>
	<input type="text" name="invented" id="invented">
	<label for="musickey">Music Key</label>
	<input type="text" name="musickey" id="musickey">
	<label for="clef">Clef</label>
	<input type="text" name="clef" id="clef">
	<input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>
