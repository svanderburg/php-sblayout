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
use SBLayout\Model\Section\CompoundSection;

$application = new Application(
	/* Title */
	"Advanced test website",

	/* CSS stylesheets */
	array("default.css"),

	/* Sections */
	array(
		"header" => new ContentsSection(false),
		"menu" => new MenuSection(0),
		"container" => new CompoundSection(array(
			"submenu" => new MenuSection(1),
			"contents" => new ContentsSection(true)
		)),
		"footer" => new StaticSection("footer.php"),
	),

	/* Pages */
	new StaticContentPage("Home", new Contents(array(
			"contents" => "home.php",
			"header" => "home.php"
		)), array(
		"403" => new HiddenStaticContentPage("Forbidden", new Contents(array(
			"contents" => "error/403.php",
			"header" => "home.php"
		))),
		"404" => new HiddenStaticContentPage("Page not found", new Contents(array(
			"contents" => "error/404.php",
			"header" => "home.php"
		))),
		
		"home" => new PageAlias("Home", ""),

		"styles" => new StaticContentPage("Styles", new Contents(array(
			"contents" => "styles.php",
			"header" => "home.php"
		)), array(
			"red" => new StaticContentPage("Red", new Contents(array(
				"contents" => "styles/red.php",
				"header" => "home.php"
			), null, array("styles/red.css"))),
			"blue" => new StaticContentPage("Blue", new Contents(array(
				"contents" => "styles/blue.php",
				"header" => "home.php"
			), null, array("styles/blue.css"))),
			"green" => new StaticContentPage("Green", new Contents(array(
				"contents" => "styles/green.php",
				"header" => "home.php"
			), null, array("styles/green.css")))
		)),
		
		"scripts" => new StaticContentPage("Scripts", new Contents(array(
			"contents" => "scripts.php",
			"header" => "home.php"
		)), array(
			"one" => new StaticContentPage("One", new Contents(array(
				"contents" => "scripts/one.php",
				"header" => "home.php"
			), null, null, array("scripts/one.js"))),
			"two" => new StaticContentPage("Two", new Contents(array(
				"contents" => "scripts/two.php",
				"header" => "home.php"
			), null, null, array("scripts/two.js")))
		)),
		
		"header" => new StaticContentPage("Header", new Contents(array(
			"contents" => "header.php",
			"header" => "home.php"
		)), array(
			"first" => new StaticContentPage("First", new Contents(array(
				"contents" => "header/first.php",
				"header" => "header/first.php"
			))),
			"second" => new StaticContentPage("Second", new Contents(array(
				"contents" => "header/second.php",
				"header" => "header/second.php"
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
