<?php


if (isset($_POST['submit'])) {
	try {	
		require "config.php";
		require "common.php";

		$connection = new PDO($dsn, $username, $password, $options);

		$sql = "SELECT * 
						FROM instruments
						WHERE name = :name";

		$name = $_POST['name'];

		$statement = $connection->prepare($sql);
		$statement->bindParam(':name', $name, PDO::PARAM_STR);
		$statement->execute();

		$result = $statement->fetchAll();
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}
}
?>
<?php require "templates/header.php"; ?>
		
<?php  
if (isset($_POST['submit'])) {
	if ($result && $statement->rowCount() > 0) { ?>
		<h2>Results</h2>

		<table>
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Invented</th>
					<th>Music Key</th>
					<th>Clef</th>
				</tr>
			</thead>
			<tbody>
	<?php foreach ($result as $row) { ?>
			<tr>
				<td><?php echo escape($row["id"]); ?></td>
				<td><?php echo escape($row["name"]); ?></td>
				<td><?php echo escape($row["invented"]); ?></td>
				<td><?php echo escape($row["musickey"]); ?></td>
				<td><?php echo escape($row["clef"]); ?></td>
			</tr>
		<?php } ?> 
			</tbody>
	</table>
	<?php } else { ?>
		<blockquote>No results found for <?php echo escape($_POST['name']); ?>.</blockquote>
	<?php } 
} ?> 

<h2>Find instrument based on name</h2>

<form method="post">
	<label for="name">Name</label>
	<input type="text" id="name" name="name">
	<input type="submit" name="submit" value="View Results">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>
