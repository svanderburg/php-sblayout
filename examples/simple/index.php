<?php
require(dirname(__FILE__)."/../../vendor/autoload.php");

error_reporting(E_STRICT | E_ALL);

use SBLayout\Model\Application;
use SBLayout\Model\Page\DynamicContentPage;
use SBLayout\Model\Page\ExternalPage;
use SBLayout\Model\Page\HiddenStaticContentPage;
use SBLayout\Model\Page\PageAlias;
use SBLayout\Model\Page\StaticContentPage;
use SBLayout\Model\Page\Content\Contents;
use SBLayout\Model\Section\ContentsSection;
use SBLayout\Model\Section\MenuSection;
use SBLayout\Model\Section\StaticSection;
use SBLayout\Model\Section\CompoundSection;
use Examples\Simple\Model\Page\InaccessibleContentPage;

$application = new Application(
	/* Title */
	"Simple test website",

	/* CSS stylesheets */
	array("default.css"),

	/* Sections */
	array(
		"header" => new StaticSection("header.php"),
		"menu" => new MenuSection(0),
		"container" => new CompoundSection(array(
			"submenu" => new MenuSection(1),
			"contents" => new ContentsSection(true)
		))
	),

	/* Pages */
	new StaticContentPage("Home", new Contents("home.php"), array(
		"400" => new HiddenStaticContentPage("Bad request", new Contents("error/400.php")),
		"403" => new HiddenStaticContentPage("Forbidden", new Contents("error/403.php")),
		"404" => new HiddenStaticContentPage("Page not found", new Contents("error/404.php")),

		"home" => new PageAlias("Home", ""),

		"aliaspage1" => new PageAlias("Alias page 1", "page1"),

		"inaccessible" => new InaccessibleContentPage("Inaccessible", new Contents("page1.php")),

		"page1" => new StaticContentPage("Page 1", new Contents("page1.php"), array(
			"page11" => new StaticContentPage("Subpage 1.1", new Contents("page1/subpage11.php")),
			"page12" => new StaticContentPage("Subpage 1.2", new Contents("page1/subpage12.php")),
			"page13" => new StaticContentPage("Subpage 1.3", new Contents("page1/subpage13.php")))),
			
		"page2" => new StaticContentPage("Page 2", new Contents("page2.php"), array(
			"page21" => new StaticContentPage("Subpage 2.1", new Contents("page2/subpage21.php")),
			"page22" => new StaticContentPage("Subpage 2.2", new Contents("page2/subpage22.php")),
			"page23" => new StaticContentPage("Subpage 2.3", new Contents("page2/subpage23.php")))),

		"firstname" => new DynamicContentPage("First name", "firstname", new Contents("firstname.php"), new StaticContentPage("First name", new Contents("firstname/firstname.php"), array(
			"lastname" => new DynamicContentPage("Last name", "lastname", new Contents("firstname/lastname.php"), new StaticContentPage("Last name", new Contents("firstname/lastname/lastname.php")))
		))),

		"external" => new ExternalPage("External", "http://www.google.com"),

		"tests" => new StaticContentPage("Tests", new Contents("tests.php"), array(
			"form" => new StaticContentPage("Form", new Contents("tests/form.php", "tests/form.php")),
			"breadcrumbs" => new StaticContentPage("Bread crumbs", new Contents("tests/breadcrumbs.php")),
			"sitemap" => new StaticContentPage("Site map", new Contents("tests/sitemap.php")),
			"parent" => new StaticContentPage("Parent", new Contents("tests/parent.php"))
		))

	)),

	/* Favorite icon */
	"favicon.ico"
);

\SBLayout\View\HTML\displayRequestedPage($application);
?>
