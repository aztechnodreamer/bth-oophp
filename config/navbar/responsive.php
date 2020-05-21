<?php
/**
 * Supply the basis for the navbar as an array.
 */
return [
    // Use for styling the menu
    "id" => "rm-menu",
    "wrapper" => null,
    "class" => "rm-default rm-mobile",

    // Here comes the menu items
    "items" => [
        [
            "text" => "Hem",
            "url" => "",
            "title" => "Första sidan, börja här.",
        ],
        [
            "text" => "Redovisning",
            "url" => "redovisning",
            "title" => "Redovisningstexter från kursmomenten.",
            "submenu" => [
                "items" => [
                    [
                        "text" => "Kmom01",
                        "url" => "redovisning/kmom01",
                        "title" => "Redovisning för kmom01.",
                    ],
                    [
                        "text" => "Kmom02",
                        "url" => "redovisning/kmom02",
                        "title" => "Redovisning för kmom02.",
                    ],
                    [
                        "text" => "Kmom03",
                        "url" => "redovisning/kmom03",
                        "title" => "Redovisning för kmom03.",
                    ],
                    [
                        "text" => "Kmom04",
                        "url" => "redovisning/kmom04",
                        "title" => "Redovisning för kmom04.",
                    ],
                    [
                        "text" => "Kmom05",
                        "url" => "redovisning/kmom05",
                        "title" => "Redovisning för kmom05.",
                    ],
                    [
                        "text" => "Kmom06",
                        "url" => "redovisning/kmom06",
                        "title" => "Redovisning för kmom06.",
                    ],
                ],
            ],
        ],
        [
            "text" => "Blogg",
            "url" => "blog/posts",
            "title" => "Blogg",
            "submenu" => [
                "items" => [
                    [
                        "text" => "Sidor",
                        "url" => "blog/pages",
                        "title" => "Sidor",
                    ],
                    [
                        "text" => "Admin",
                        "url" => "blog/admin",
                        "title" => "Admin",
                    ],
                ],
            ],
        ],
        [
            "text" => "Textfilter",
            "url" => "mytextfilter",
            "title" => "Textfilter",
        ],
        [
            "text" => "Spel",
            "url" => "games",
            "title" => "Spel",
            "submenu" => [
                "items" => [
                    [
                        "text" => "Gissa mitt nummer",
                        "url" => "games/guess",
                        "title" => "Gissa mitt nummer",
                    ],
                    [
                        "text" => "Tärning 100",
                        "url" => "games/dice",
                        "title" => "Tärning 100",
                    ],
                ],
            ],
        ],
        [
            "text" => "Filmer",
            "url" => "movie",
            "title" => "Filmdatabas",
        ],
        [
            "text" => "Om",
            "url" => "om",
            "title" => "Om denna webbplats.",
        ],
        [
            "text" => "Styleväljare",
            "url" => "style",
            "title" => "Välj stylesheet.",
        ],
        [
            "text" => "Docs",
            "url" => "dokumentation",
            "title" => "Dokumentation av ramverk och liknande.",
        ],
        [
            "text" => "Test &amp; Lek",
            "url" => "lek",
            "title" => "Testa och lek med test- och exempelprogram",
        ],
        [
            "text" => "Anax dev",
            "url" => "dev",
            "title" => "Anax development utilities",
        ],
    ],
];
