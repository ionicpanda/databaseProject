<?php


require "config.php";
require "common.php";

if (isset($_GET["id"])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
  
    $id = $_GET["id"];

    $sql = "DELETE FROM instruments WHERE id = :id";

    $statement = $connection->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

    $success = "User successfully deleted";
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}

try {
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
        
<h2>Delete instruments</h2>

<?php if ($success) echo $success; ?>

<table>
  <thead>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Invented</th>
      <th>Music Key</th>
      <th>Clef</th>
      <th>Delete</th>
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
      <td><a href="delete.php?id=<?php echo escape($row["id"]); ?>">Delete</a></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>
