<?php
namespace Controllers;

use Repositories\BookRepository;
use Models\Book;

class BookController extends Controller
{

    public function home()
    {
        $books = BookRepository::instance()->findAll();

        return $this->jsonResponse($books);

        return $this->view(
            "home",
            [
                "books" => $books
            ]
        );

    }

    public function showForm()
    {
        return $this->view(
            "create"
        );
    }

    public function create(array $post)
    {

        $book = Book::fromArray($post);

        BookRepository::instance()->save($book);

        return $this->redirect("home");
    }

}