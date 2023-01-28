<?php
	final class Book {
		private $title;
		private $author;
		private $pages;
		
		public function __construct(string $title, string $author, int $pages) {
			$this->title = $title;
			$this->author = $author;
			$this->pages = $pages;
		}

		public function getTitle(): string {return $this->title;}
		public function getAuthor(): string {return $this->author;}
		public function getPages(): int {return $this->pages;}
	}
?>