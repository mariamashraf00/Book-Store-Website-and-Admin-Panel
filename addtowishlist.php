<?php
session_start();
$title = "Add To List";
require_once "header.php";
require_once "classes/customer.php";
require_once "classes/author.php";
require_once "classes/wishlists.php";
$book_isbn = $_GET['bookisbn'];
 Wishlist::insert($_SESSION['username'], $book_isbn);
header("Location: book.php?bookisbn=$book_isbn");
?>