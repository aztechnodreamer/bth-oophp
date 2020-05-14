<?php

namespace Anax\Controller;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A controller to play the game Dice 100.
 * The controller is mounted on a particular route and can handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class MovieController implements AppInjectableInterface
{
    use AppInjectableTrait;


    /**
     * @var string $db a sample member variable that gets initialised
     */
    //private $db = "not active";


    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    // public function initialize() : void
    // {
    //     // Use to initialise member variables.
    //     $this->db = "active";
    //
    //     // Use $this->app to access the framework services.
    // }


    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function indexAction() : object
    {
        $title = "Movie database | oophp";
        $page = $this->app->page;
        $session = $this->app->session;
        $db = $this->app->db;

        $db->connect();

        if ($session->has("movieTitle")) {
            $title = $session->get("movieTitle");
            $year1 = $session->get("movieYear1");
            $year2 = $session->get("movieYear2");
            $sql = "SELECT * FROM movie WHERE title LIKE ? AND year BETWEEN ? AND ?;";
            $res = $db->executeFetchAll($sql, ["%$title%", "$year1", "$year2"]);
        } elseif ($session->has("movieYear1") && $session->has("movieYear2")) {
            $year1 = $session->get("movieYear1");
            $year2 = $session->get("movieYear2");
            $sql = "SELECT * FROM movie WHERE year BETWEEN ? AND ?;";
            $res = $db->executeFetchAll($sql, [$year1, $year2]);
        } else {
            $sql = "SELECT * FROM movie;";
            $res = $db->executeFetchAll($sql);
        }

        $session->destroy();

        $page->add("movie/index", [
            "resultset" => $res,
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }


    /**
     * This method it the handler for route:
     * POST mountpoint/movie
     *
     * @return string
     */
    public function indexActionPost() : object
    {
        $request = $this->app->request;
        $session = $this->app->session;
        $response = $this->app->response;

        $doSearch    = $request->getPost("doSearch");
        $doEdit    = $request->getPost("doEdit");
        $searchTitle = $request->getPost("searchTitle");

        if ($doSearch) {
            $session->set("movieYear1", $request->getPost("year1"));
            $session->set("movieYear2", $request->getPost("year2"));

            if ($searchTitle != "") {
                $session->set("movieTitle", $searchTitle);
            }
        }

        if ($doEdit) {
            $session->set("movieId", $request->getPost("id"));
            return $response->redirect("movie/edit");
        }

        return $response->redirect("movie");
    }


    /**
     * This is the create method action, it handles:
     * ANY METHOD mountpoint/movie/create
     *
     * @return string
     */
    public function createAction() : object
    {
        $title = "Movie database | oophp";
        $page = $this->app->page;

        $page->add("movie/create");

        return $page->render([
            "title" => $title,
        ]);
    }


    /**
     * This method it the handler for route:
     * POST mountpoint/movie/create
     *
     * @return string
     */
    public function createActionPost() : object
    {
        $request = $this->app->request;
        $response = $this->app->response;
        $db = $this->app->db;

        $doAdd  = $request->getPost("doAdd");

        if ($doAdd) {
            $movieTitle  = $request->getPost("movieTitle");
            $movieYear = $request->getPost("movieYear");
            $movieImage = $request->getPost("movieImage");

            $db->connect();
            $sql = "INSERT INTO movie (title, year, image) VALUES (?, ?, ?);";
            $db->execute($sql, [$movieTitle, $movieYear, $movieImage]);
        }

        return $response->redirect("movie");
    }


    /**
     * This is the edit method action, it handles:
     * ANY METHOD mountpoint/movie/edit
     *
     * @return string
     */
    public function editAction() : object
    {
        $title = "Movie database | oophp";
        $db = $this->app->db;
        $session = $this->app->session;
        $page = $this->app->page;

        $db->connect();
        $sql = "SELECT id, title, year, image FROM movie WHERE id = ?;";
        $resultset = $db->executeFetchAll($sql, [$session->get("movieId")]);

        $page->add("movie/edit", [
            "resultset" => $resultset,
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }


    /**
     * This method it the handler for route:
     * POST mountpoint/movie/edit
     *
     * @return string
     */
    public function editActionPost() : object
    {
        $request = $this->app->request;
        $response = $this->app->response;
        $db = $this->app->db;

        $db->connect();

        $doSave  = $request->getPost("doSave");
        $doDelete = $request->getPost("doDelete");
        $movieId  = $request->getPost("movieId");

        if ($doSave) {
            $movieTitle  = $request->getPost("movieTitle");
            $movieYear = $request->getPost("movieYear");
            $movieImage = $request->getPost("movieImage");

            $sql = "UPDATE movie SET title = ?, year = ?, image = ? WHERE id = ?;";
            $db->execute($sql, [$movieTitle, $movieYear, $movieImage, $movieId]);
        }

        if ($doDelete) {
            $sql = "DELETE FROM movie WHERE id = ?;";
            $db->execute($sql, [$movieId]);
        }
        return $response->redirect("movie");
    }
}
