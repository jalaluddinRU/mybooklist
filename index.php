<?php
$json = file_get_contents('books.json');
$books = json_decode($json,true);

// search item
if (isset($_GET['query']))
{
    $query = $_GET['query'];
}
else{
    $query = "";
}

$size_search = strlen($query);
$query = strtolower($query);
$query = explode(" ", $query);

$search_item = array();
foreach ($books as $key => $book) {
    $title = strtolower($book['title']);

    for ($i = 0; $i < sizeof($query); $i += 1) {
        if ($query[$i] == "" || $query[$i] == " ") continue;
        if (strpos((string)$title, (string)($query[$i])) !== false) {
            array_push($search_item, $books[$key]);
        }
    }
}

if ($size_search != 0) {
    $books = $search_item;
}
$books_size = sizeof($books);
?>

<!DOCTYPE html>
<html lang="en">
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Bookstore</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
  <a href="<?php echo 'index.php' ?>" class="btn btn-lg">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search by title" aria-label="Search" name="query">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

<div class="container">
        <div class="row">
            <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Availablity</th>
                    <th>Pages</th>
                    <th>ISBN</th>
                    <th>Option</th>
                </tr>
                </thead> 
                
                <?php foreach ($books as $key => $book) : ?>
                <tr>
                    <td><?php echo $key + 1; ?></td>
                    <td><a href="#"><?php echo $book['title']; ?></a></td>
                    <td><?php echo $book['author']; ?></td>
                    <td><?php echo $book['available'] ? 'True' : 'False'; ?></td>
                    <td><?php echo $book['pages']; ?></td>
                    <td><?php echo $book['isbn']; ?></td>
                    <td><a href="<?php echo 'delete.php?id=' . $key  ?>"><button class="btn btn-lg" style = "background-color: #700000"
                                onclick="return confirm('Are you want to delete item?')">Delete</button></a></td>
                </tr>
                <?php endforeach; ?>
            </table>
            <?php if ($books_size == 0) : ?>

                <h4>Sorry, No item found;</h4>

                <?php endif; ?>

            <div class="create">
                <a href="<?php echo 'create.php' ?>">
                    <button class="btn btn-lg" style = "background-color: #4CAF50" >Create</button>
                </a>
            </div>
        </div>
    </div>

</body>

</html>

</body>
</html>
