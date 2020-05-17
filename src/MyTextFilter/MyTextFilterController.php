<?php

namespace Seva19\MyTextFilter;

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
class MyTextFilterController implements AppInjectableInterface
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
        $title = "My TextFilter | oophp";
        $page = $this->app->page;

        $textfilter = new MyTextFilter();

        $original = array(
            "[b]Bold text[/b] [i]Italic text[/i] [url=http://dbwebb.se]a link to dbwebb[/url].\n
            And then an image. [img]https://dbwebb.se/image/tema/trad/blad.jpg[/img]",
            "This link should for example be made clickable: http://dbwebb.se and so should this link
            http://dbwebb.se/kod-exempel/function_to_make_links_clickable/ and so should this:
            http://dbwebb.se/kod-exempel/function_to_make_links_clickable#id.",
            "Here comes a paragraph.

* Unordered list
* Unordered list again",
            "This\r\nis\n\ra\nstring\r",
            "Linebreakes handled by *nl2br* (italic by markdown). \n [b]bbcode - Bold text[/b] \r link - http://dbwebb.se"
        );

        $filter = array(
            $textfilter->parse($original[0], ["bbcode"]),
            $textfilter->parse($original[1], ["link"]),
            $textfilter->parse($original[2], ["markdown"]),
            $textfilter->parse($original[3], ["nl2br"]),
            $textfilter->parse($original[4], ["bbcode", "link", "markdown", "nl2br"])
        );

        $data = [
            "original" => $original,
            "filter" => $filter
        ];

        $page->add("mytextfilter/index", $data);

        return $page->render([
            "title" => $title,
        ]);
    }
}
