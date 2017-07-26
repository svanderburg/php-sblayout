<?php
error_reporting(E_STRICT | E_ALL);

require(dirname(__FILE__)."/../../vendor/autoload.php");

use SBLayout\Model\Application;
use SBLayout\Model\Page\HiddenStaticContentPage;
use SBLayout\Model\Page\PageAlias;
use SBLayout\Model\Page\StaticContentPage;
use SBLayout\Model\Page\Content\Contents;
use SBLayout\Model\Section\ContentsSection;
use SBLayout\Model\Section\MenuSection;
use SBLayout\Model\Section\StaticSection;

$application = new Application(
	/* Title */
	"Advanced test website",

	/* CSS stylesheets */
	array("default.css"),

	/* Sections */
	array(
		"header" => new ContentsSection(false), 
		"menu" => new MenuSection(0),
		"submenu" => new MenuSection(1),
		"contents" => new ContentsSection(true),
		"footer" => new StaticSection("footer.inc.php"),
	),

	/* Pages */
	new StaticContentPage("Home", new Contents(array(
			"contents" => "home.inc.php",
			"header" => "home.inc.php"
		)), array(
		"403" => new HiddenStaticContentPage("Forbidden", new Contents(array(
			"contents" => "error/403.inc.php",
			"header" => "home.inc.php"
		))),
		"404" => new HiddenStaticContentPage("Page not found", new Contents(array(
			"contents" => "error/404.inc.php",
			"header" => "home.inc.php"
		))),
		
		"home" => new PageAlias("Home", ""),

		"styles" => new StaticContentPage("Styles", new Contents(array(
			"contents" => "styles.inc.php",
			"header" => "home.inc.php"
		)), array(
			"red" => new StaticContentPage("Red", new Contents(array(
				"contents" => "styles/red.inc.php",
				"header" => "home.inc.php"
			), null, array("styles/red.css"))),
			"blue" => new StaticContentPage("Blue", new Contents(array(
				"contents" => "styles/blue.inc.php",
				"header" => "home.inc.php"
			), null, array("styles/blue.css"))),
			"green" => new StaticContentPage("Green", new Contents(array(
				"contents" => "styles/green.inc.php",
				"header" => "home.inc.php"
			), null, array("styles/green.css")))
		)),
		
		"scripts" => new StaticContentPage("Scripts", new Contents(array(
			"contents" => "scripts.inc.php",
			"header" => "home.inc.php"
		)), array(
			"one" => new StaticContentPage("One", new Contents(array(
				"contents" => "scripts/one.inc.php",
				"header" => "home.inc.php"
			), null, null, array("scripts/one.js"))),
			"two" => new StaticContentPage("Two", new Contents(array(
				"contents" => "scripts/two.inc.php",
				"header" => "home.inc.php"
			), null, null, array("scripts/two.js")))
		)),
		
		"header" => new StaticContentPage("Header", new Contents(array(
			"contents" => "header.inc.php",
			"header" => "home.inc.php"
		)), array(
			"first" => new StaticContentPage("First", new Contents(array(
				"contents" => "header/first.inc.php",
				"header" => "header/first.inc.php"
			))),
			"second" => new StaticContentPage("Second", new Contents(array(
				"contents" => "header/second.inc.php",
				"header" => "header/second.inc.php"
			)))
		))
	)),

	/* Favorite icon */
	"favicon.ico",

	/* Scripts */
	array("hello.js")
);

\SBLayout\View\HTML\displayRequestedPage($application);
?>
