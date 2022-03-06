<?php
if (file_exists('books.json')) {
    $json = file_get_contents('books.json');
    $books = json_decode($json, true);
} else {
    $books = array();
}
$is_added = 0;
$pos = -1;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_add = array(
        "title" =>  str_replace("</", "",  $_POST['title']),
        "author" => str_replace("</", "",  $_POST['author']),
        "available" => $_POST['available'],
        "pages" => $_POST['pages'],
        "isbn" => $_POST['isbn'],
    );
    array_push($books, $new_add);
    $book_str = json_encode($books);
    file_put_contents('books.json', $book_str);
    $is_added = 1;
    $pos = sizeof($books);
}
?>

<!DOCTYPE html>
<html lang="en">
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Create</title>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
  <a href="<?php echo 'index.php' ?>" class="btn btn-lg">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    </div>
</nav>

<div class="container">
        <div class="row">
            <?php if ($is_added == 1) : ?>
            <div class="col-md-12">
                <h3 class="btn btn-success">New item added:</h3>
            </div>
            <!-- show the added item -->
            <div class="col-md-12">
                <?php foreach ($books as $key => $book) : ?>
                <?php if ($pos - 1 == $key) : ?>
                <h3> <?php echo (" title : " . $book['title'] . ", Author : " . $book['author'] . ", available : " . $book['available'] . ", Pages : " . $book['pages'] . ", ISBN : " . $book['isbn']); ?>
                </h3>
                <?php echo "<hr>"; ?>
                <?php endif;  ?>
                <?php endforeach;  ?>
            </div>
            <hr>
            <?php endif;  ?>
        </div>

        <!-- create new item -->
        <div class="row">
            <h2>Create Item:</h2>
        </div>


        <form action="./create.php" method="POST">


            <div class="form-group">
                <label for="inputAddress2" required>Title</label>
                <input type="text" class="form-control" id="inputAddress2" placeholder="Title" name="title" required>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Author</label>
                    <input type="text" class="form-control" id="inputEmail4" placeholder="Author" name="author"
                        required>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputState">Avilable State</label>
                    <select id="inputState" class="form-control" name="available" required>
                        <option value="true" Selected>True</option>
                        <option value="false">False</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Pages</label>
                    <input type="number" class="form-control" id="inputEmail4" placeholder="Pages" name="pages"
                        required>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail4">ISBN</label>
                    <input type="number" class="form-control" id="inputEmail4" placeholder="ISBN" name="isbn" required>
                </div>
            </div>


            <button type="submit" class="btn" style = "background-color: #4CAF50">Submit</button>
        </form>

    </div>



    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>