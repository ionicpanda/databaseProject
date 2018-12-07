<?php
require "config.php";
require "common.php";
if (isset($_POST['submit'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $instrument =[
      "id"        => $_POST['id'],
      "name" => $_POST['name'],
      "invented"  => $_POST['invented'],
      "musickey"     => $_POST['musickey'],
      "clef"       => $_POST['clef']
    ];

    $sql = "UPDATE instruments 
            SET id = :id, 
              name = :name, 
              invented = :invented, 
              musickey = :musickey, 
              clef = :clef 
            WHERE id = :id";
  
  $statement = $connection->prepare($sql);
  $statement->execute($instrument);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
  
if (isset($_GET['id'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $id = $_GET['id'];
    $sql = "SELECT * FROM instruments WHERE id = :id";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();
    
    $instrument = $statement->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
} else {
    echo "Something went wrong!";
    exit;
}
?>

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) : ?>
	<blockquote><?php echo escape($_POST['name']); ?> successfully updated.</blockquote>
<?php endif; ?>

<h2>Edit an instrument</h2>

<form method="post">
    <?php foreach ($instrument as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
	    <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'id' ? 'readonly' : null); ?>>
    <?php endforeach; ?> 
    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>
