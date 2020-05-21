<?php

namespace Seva19\Blog;

require "function.php";

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
class BlogController implements AppInjectableInterface
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
        $title = "Blogg | oophp";
        $db = $this->app->db;
        $page = $this->app->page;

        $db->connect();

        $sql = "SELECT * FROM content WHERE type = ? AND deleted is null ORDER BY published desc;";
        $res = $db->executeFetchAll($sql, ["post"]);

        $page->add("blog/blogposts", [
            "resultset" => $res,
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }


    /**
     * This method it the handler for route:
     * ANY METHOD mountpoint/post
     *
     * @return string
     */
    public function postAction() : object
    {
        $title = "Blogg | oophp";
        $request = $this->app->request;
        $db = $this->app->db;
        $page = $this->app->page;

        $slug = $request->getGET("slug");

        $db->connect();

        $sql = "SELECT * FROM content WHERE slug = ?;";
        $res = $db->executeFetchAll($sql, [$slug]);

        if (isset($res[0]->filter)) {
            $textfilter = new \Seva19\MyTextFilter\MyTextFilter();
            $filter = explode(",", $res[0]->filter);
            $res[0]->data = $textfilter->parse($res[0]->data, $filter);
        }

        $page->add("blog/post", [
            "resultset" => $res,
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }


    /**
     * This method it the handler for route:
     * ANY METHOD mountpoint/pages
     *
     * @return string
     */
    public function pagesAction() : object
    {
        $title = "Blogg | oophp";
        $db = $this->app->db;
        $page = $this->app->page;

        $db->connect();

        $sql = "SELECT * FROM content WHERE type = ? AND deleted is null ORDER BY title asc;";
        $res = $db->executeFetchAll($sql, ["page"]);

        $page->add("blog/blogpages", [
            "resultset" => $res,
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }


    /**
     * This method it the handler for route:
     * ANY METHOD mountpoint/page
     *
     * @return string
     */
    public function pageAction() : object
    {
        $title = "Blogg | oophp";
        $request = $this->app->request;
        $db = $this->app->db;
        $page = $this->app->page;

        $path = $request->getGET("path");

        if ($path == null || $path == "") {
            $page->add("blog/404");

            return $page->render([
                "title" => $title,
            ]);
        }

        $db->connect();

        $sql = <<<EOD
SELECT
*,
DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS modified_iso8601,
DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS modified
FROM content
WHERE
path = ?
;
EOD;

        $res = $db->executeFetchAll($sql, [$path]);

        if (isset($res[0]->filter)) {
            $textfilter = new \Seva19\MyTextFilter\MyTextFilter();
            $filter = explode(",", $res[0]->filter);
            $res[0]->data = $textfilter->parse($res[0]->data, $filter);
        }

        $page->add("blog/page", [
            "resultset" => $res,
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }


    /**
     * This method it the handler for route:
     * ANY METHOD mountpoint/admin
     *
     * @return string
     */
    public function adminAction() : object
    {
        $title = "Blogg | oophp";
        $db = $this->app->db;
        $page = $this->app->page;

        $db->connect();

        $sql = "SELECT * FROM content;";
        $res = $db->executeFetchAll($sql);

        $page->add("blog/admin", [
            "resultset" => $res,
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }


    /**
     * This method it the handler for route:
     * POST mountpoint/admin
     *
     * @return string
     */
    public function adminActionPost() : object
    {
        $request = $this->app->request;
        $session = $this->app->session;
        $response = $this->app->response;

        $doEdit = $request->getPost("doEdit");

        if ($doEdit) {
            $session->set("id", $request->getPost("id"));

            return $response->redirect("blog/edit");
        }
    }


    /**
     * This method it the handler for route:
     * ANY METHOD mountpoint/edit
     *
     * @return string
     */
    public function editAction() : object
    {
        $title = "Blogg | oophp";
        $db = $this->app->db;
        $session = $this->app->session;
        $page = $this->app->page;

        $db->connect();

        $sql = "SELECT * FROM content WHERE id = ?;";
        $res = $db->executeFetchAll($sql, [$session->get("id")]);
        $session->destroy();

        $page->add("blog/edit", [
            "resultset" => $res,
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }


    /**
     * This method it the handler for route:
     * POST mountpoint/edit
     *
     * @return string
     */
    public function editActionPost() : object
    {
        $request = $this->app->request;
        $db = $this->app->db;
        $response = $this->app->response;

        $doSave = $request->getPost("doSave");
        $doCancel = $request->getPost("doCancel");
        $doDelete = $request->getPost("doDelete");
        $contentId = $request->getPost("contentId");
        $contentTitle = $request->getPost("contentTitle");
        $contentSlug = slugify($request->getPost("contentSlug"));

        $db->connect();

        if ($doSave) {
            $contentData    = $request->getPost("contentData") ?? null;
            $contentPath    = $request->getPost("contentPath") ?? null;
            $contentPublish = $request->getPost("contentPublish");
            $contentType    = $request->getPost("contentType");
            $contentFilter  = $request->getPost("contentFilter") ?? null;

            //handel path
            if ($contentPath == "") {
                $contentPath = null;
            }

            //handel slug
            if ($contentSlug == "") {
                $contentSlug = slugify($contentTitle);
            }

            $contentSlug = checkSlug($contentSlug, $contentId, $db);

            //handle filters
            if ($contentFilter) {
                $contentFilter = implode(",", $contentFilter);
            }

            $sql = "UPDATE content SET
                title = ?,
                path = ?,
                slug = ?,
                data = ?,
                type = ?,
                filter = ?,
                published = ?
            WHERE id = ?;";

            $db->execute($sql, [
                $contentTitle,
                $contentPath,
                $contentSlug,
                $contentData,
                $contentType,
                $contentFilter,
                $contentPublish,
                $contentId
            ]);
        }

        if ($doCancel) {
            if ($contentSlug == null) {
                $contentSlug = slugify($contentTitle);
                $contentSlug = checkSlug($contentSlug, $contentId, $db);

                $sql = "UPDATE content SET slug = ? WHERE id = ?;";
                $db->execute($sql, [$contentSlug, $contentId]);
            }
        }

        if ($doDelete) {
            $sql = "UPDATE content SET deleted = NOW() WHERE id = ?;";
            $db->execute($sql, [$contentId]);
        }
        return $response->redirect("blog/admin");
    }


    /**
     * This method it the handler for route:
     * ANY METHOD mountpoint/create
     *
     * @return string
     */
    public function createAction() : object
    {
        $title = "Blogg | oophp";
        $page = $this->app->page;

        $page->add("blog/create");

        return $page->render([
            "title" => $title,
        ]);
    }


    /**
     * This method it the handler for route:
     * POST mountpoint/create
     *
     * @return string
     */
    public function createActionPost() : object
    {
        $request = $this->app->request;
        $db = $this->app->db;
        $session = $this->app->session;
        $response = $this->app->response;

        $doCreate = $request->getPost("doCreate");
        $doCancel = $request->getPost("doCancel");

        if ($doCreate) {
            $contentTitle = $request->getPost("contentTitle");
            $contentType = $request->getPost("contentType");

            $db->connect();

            $sql = "INSERT INTO content (title, type) VALUES (?, ?);";
            $db->execute($sql, [$contentTitle, $contentType]);
            $id = $db->lastInsertId();
            $session->set("id", $id);

            return $response->redirect("blog/edit");
        }

        if ($doCancel) {
            return $response->redirect("blog/admin");
        }
    }


    /**
     * This method it the handler for route:
     * ANY METHOD mountpoint/deleted
     *
     * @return string
     */
    public function deletedAction() : object
    {
        $title = "Blogg | oophp";
        $db = $this->app->db;
        $page = $this->app->page;

        $db->connect();

        $sql = "SELECT * FROM content WHERE deleted IS NOT null;";
        $res = $db->executeFetchAll($sql);

        $page->add("blog/deleted", [
            "resultset" => $res,
        ]);

        return $page->render([
            "title" => $title,
        ]);
    }


    /**
     * This method it the handler for route:
     * POST mountpoint/deleted
     *
     * @return string
     */
    public function deletedActionPost() : object
    {
        $request = $this->app->request;
        $db = $this->app->db;
        $response = $this->app->response;

        $doRestore = $request->getPost("doRestore");
        $id = $request->getPost("id");

        if ($doRestore) {
            $db->connect();

            $sql = "UPDATE content SET deleted = null WHERE id = ?;";
            $db->execute($sql, [$id]);
        }
        return $response->redirect("blog/admin");
    }
}
