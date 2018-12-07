<?php

try {
  require "config.php";
  require "common.php";

  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT * FROM instruments";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>
<?php require "templates/header.php"; ?>
        
<h2>Update Instrument</h2>

<table>
  <thead>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Invented</th>
      <th>Music Key</th>
      <th>Clef</th>
      <th>Edit</th>
    </tr>
  </thead>
    <tbody>
    <?php foreach ($result as $row) : ?>
      <tr>
        <td><?php echo escape($row["id"]); ?></td>
        <td><?php echo escape($row["name"]); ?></td>
        <td><?php echo escape($row["invented"]); ?></td>
        <td><?php echo escape($row["musickey"]); ?></td>
        <td><?php echo escape($row["clef"]); ?></td>
        <td><a href="update-single.php?id=<?php echo escape($row["id"]); ?>">Edit</a></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>
