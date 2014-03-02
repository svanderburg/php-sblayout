<?php
error_reporting(E_STRICT | E_ALL);

set_include_path("../sblayout");

require_once("layout/model/Application.class.php");
require_once("layout/model/section/StaticSection.class.php");
require_once("layout/model/section/MenuSection.class.php");
require_once("layout/model/section/ContentsSection.class.php");
require_once("layout/model/page/StaticContentPage.class.php");
require_once("layout/model/page/HiddenStaticContentPage.class.php");
require_once("layout/model/page/DynamicContentPage.class.php");
require_once("layout/model/page/ExternalPage.class.php");
require_once("layout/model/page/PageAlias.class.php");

require_once("includes/model/page/InaccessibleContentPage.class.php");

require_once("layout/view/html/index.inc.php");

$application = new Application(
	/* Title */
	"Simple test website",

	/* CSS stylesheets */
	array("default.css"),

	/* Sections */
	array(
		"header" => new StaticSection("header.inc.php"),
		"menu" => new MenuSection(0),
		"submenu" => new MenuSection(1),
		"contents" => new ContentsSection(true)
	),

	/* Pages */
	new StaticContentPage("Home", new Contents("home.inc.php"), array(
		"403" => new HiddenStaticContentPage("Forbidden", new Contents("error/403.inc.php")),
		"404" => new HiddenStaticContentPage("Page not found", new Contents("error/404.inc.php")),
		
		"home" => new PageAlias("Home", ""),
		
		"aliaspage1" => new PageAlias("Alias page 1", "page1"),
		
		"inaccessible" => new InaccessibleContentPage("Inaccessible", new Contents("page1.inc.php")),

		"page1" => new StaticContentPage("Page 1", new Contents("page1.inc.php"), array(
			"page11" => new StaticContentPage("Subpage 1.1", new Contents("page1/subpage11.inc.php")),
			"page12" => new StaticContentPage("Subpage 1.2", new Contents("page1/subpage12.inc.php")),
			"page13" => new StaticContentPage("Subpage 1.3", new Contents("page1/subpage13.inc.php")))),
			
    	"page2" => new StaticContentPage("Page 2", new Contents("page2.inc.php"), array(
			"page21" => new StaticContentPage("Subpage 2.1", new Contents("page2/subpage21.inc.php")),
			"page22" => new StaticContentPage("Subpage 2.2", new Contents("page2/subpage22.inc.php")),
			"page23" => new StaticContentPage("Subpage 2.3", new Contents("page2/subpage23.inc.php")))),
		
		"form" => new StaticContentPage("Form", new Contents("form.inc.php", "form.inc.php")),
		
		"firstname" => new DynamicContentPage("First name", "firstname", new Contents("firstname.inc.php"), new StaticContentPage("First name", new Contents("firstname/firstname.inc.php"), array(
			"lastname" => new DynamicContentPage("Last name", "lastname", new Contents("firstname/lastname.inc.php"), new StaticContentPage("Last name", new Contents("firstname/lastname/lastname.inc.php")))
		))),
		
		"external" => new ExternalPage("External", "http://www.google.com")
	))
);

displayRequestedPage($application);
?>
