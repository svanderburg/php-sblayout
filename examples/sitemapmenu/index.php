<?php
require(dirname(__FILE__)."/../../vendor/autoload.php");

error_reporting(E_STRICT | E_ALL);

use SBLayout\Model\Application;
use SBLayout\Model\Section\ContentsSection;
use SBLayout\Model\Section\SiteMapSection;
use SBLayout\Model\Section\StaticSection;
use SBLayout\Model\Page\HiddenStaticContentPage;
use SBLayout\Model\Page\StaticContentPage;
use SBLayout\Model\Page\Content\Contents;

$application = new Application(
	/* Title */
	"Site map menu website",

	/* CSS stylesheets */
	array("default.css"),

	/* Sections */
	array(
		"header" => new StaticSection("header.php"),
		"menu" => new SiteMapSection(0),
		"contents" => new ContentsSection(true)
	),

	/* Pages */
	new StaticContentPage("Home", new Contents("home.php"), array(
		"403" => new HiddenStaticContentPage("Forbidden", new Contents("error/403.php")),
		"404" => new HiddenStaticContentPage("Page not found", new Contents("error/404.php")),

		"page1" => new StaticContentPage("Page 1", new Contents("page1.php"), array(
			"page11" => new StaticContentPage("Subpage 1.1", new Contents("page1/subpage11.php")),
			"page12" => new StaticContentPage("Subpage 1.2", new Contents("page1/subpage12.php"))
		)),
		"page2" => new StaticContentPage("Page 2", new Contents("page2.php"), array(
			"page21" => new StaticContentPage("Subpage 2.1", new Contents("page2/subpage21.php")),
			"page22" => new StaticContentPage("Subpage 2.2", new Contents("page2/subpage22.php"))
		)),
		"page3" => new StaticContentPage("Page 3", new Contents("page3.php"))
	)),

	/* Favorite icon */
	"favicon.ico",

	/* JavaScript includes */
	array("mobilenavmenu.js")
);

\SBLayout\View\HTML\displayRequestedPage($application);
?>
