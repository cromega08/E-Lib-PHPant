<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>E-LibPHPant</title>
	<link rel="stylesheet" href="https://unpkg.com/@picocss/pico@latest/css/pico.min.css">
	<link rel="stylesheet" href="style.css">
	<script src="app.js" defer></script>
</head>

<?php
	require_once("Book.php");
	require_once("BookHandler.php");

	$bookHandler = BookHandler::getInstance();

	if (isset($_POST["title"])) {
		$book = new Book(
			$_POST["title"],
			$_POST["author"],
			intval($_POST["pages"])
		);
		$bookExist = $bookHandler->exist($book);
		if (!$bookExist) {
			$bookHandler->addBook($book);
		}
	}
?>

<body>
	<header class="container">
		<h1>
			<u>E-Lib-PHPant</u>
		</h1>
	</header>
	<main class="container">
		<section>
			<button name="open-modal" class="button outline">Add Book +</button>
		</section>
		<section>
			<?php				
				$books = $bookHandler->getBooks();

				foreach($books as $key=>$value) {
					$index = $key + 1;
					$title = $value->getTitle();
					$author = $value->getAuthor();
					$pages = $value->getPages();

					echo
					"<article data-title='$title' data-author='$author' data-pages='$pages'>
						<header>
							$index. $title	
						</header>
						<ul>
							<li>Author: $author</li>
							<li>Pages: $pages</li>
						</ul>
					</article>";
				}
			?>
		</section>
		<section>
			<dialog>
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
					<h2>New Book</h2>
					<!-- Framework forece me to include the header inside the form -->
					<label for="title">Title</label>
					<input type="text" name="title" id="title" autocomplete="off" title="Title of the book" required>
					<label for="author">Author</label>
					<input type="text" name="author" id="author" autocomplete="off"
						title="Name of the author of the book" required>
					<label for=" pages">Pages</label>
					<input type="number" name="pages" id="pages" min="1" max="100000" step="1"
						title="Number of pages of the book" required>
					<button type=" submit">Create</button>
					<button name="close-modal" class="button secondary">Back</button>
				</form>
			</dialog>
		</section>
	</main>
	<footer class="container">
		<section>
			<p>Made by <a href="https://github.com/Cromega08">Cromega</a> </p>
		</section>
	</footer>
</body>

</html>