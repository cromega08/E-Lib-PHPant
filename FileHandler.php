<?php	
	require_once("Book.php");
	
	final class FileHandler {
		private static $instance = null;
		private $fileName;
		private $fileStream;
		private $books;

		private function __construct() {
			$this->fileName = "books.json";
			$this->fileStream = fopen($this->fileName, "r+") or die("Unable to open/create file");
			$this->books = array_map(
				array: json_decode(fread($this->fileStream, filesize($this->fileName))),
				callback: function($book) {
					$bookData = (array) $book;
					return new Book(
						$bookData["title"],
						$bookData["author"],
						$bookData["pages"]
					);
				}
			);
		}

		public function getBooks(): array {return $this->books;}

		public function addBook(Book $newBook): bool {
			array_push($this->books, $newBook);
			
			$booksData = array_map(
				array: $this->books,
				callback: function(Book $book) {
					return array(
						"title"=>$book->getTitle(),
						"author"=>$book->getAuthor(),
						"pages"=>$book->getPages()
					);
				}
			);
			
			ftruncate($this->fileStream, 0);
			fseek($this->fileStream, 0);
			fwrite($this->fileStream, json_encode($booksData));
			return fflush($this->fileStream);
		}

		public function exist(Book $newBook): bool {
			foreach ($this->books as $key=>$book) {
				if (
					$book->getTitle() == $newBook->getTitle()
					&& $book->getAuthor() == $newBook->getAuthor()
					&& $book->getPages() == $newBook->getPages()
				) return true;
			}
			return false;
		}

		static function getInstance(): FileHandler {
			self::$instance = self::$instance == null?
				new FileHandler(): self::$instance;
			return self::$instance;
		}

		public function __destruct() {fclose($this->fileStream);}
	}
?>