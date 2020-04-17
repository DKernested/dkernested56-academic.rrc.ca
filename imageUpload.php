<?php if (isset($_FILES['image']) && $_FILES['image']['error'] > 0): ?>

    <p>Error Number: <?= $_FILES['image']['error'] ?></p>

<?php elseif (isset($_FILES['image'])): ?>

    <p>Client-Side Filename: <?= $_FILES['image']['name'] ?></p>
    <p>Apparent Mime Type:   <?= $_FILES['image']['type'] ?></p>
    <p>Size in Bytes:        <?= $_FILES['image']['size'] ?></p>
    <p>Temporary Path:       <?= $_FILES['image']['tmp_name'] ?></p>

<?php endif ?>


<!DOCTYPE html>
<html>
    <head><title>File Upload Form</title></head>
<body>
    <form method="post" enctype="multipart/form-data">
        <label for="image">Image Filename:</label>
        <input type="file" name="image" id="image">
        <input type="submit" name="submit" value="Upload Image">
    </form>
</body>
</html>