<?php
error_reporting(E_STRICT | E_ALL);

set_include_path("../sblayout");

require_once("layout/model/Application.class.php");
require_once("layout/model/section/StaticSection.class.php");
require_once("layout/model/section/MenuSection.class.php");
require_once("layout/model/section/ContentsSection.class.php");
require_once("layout/model/page/LocalizedContentPage.class.php");
require_once("layout/model/page/HiddenLocalizedContentPage.class.php");
require_once("layout/model/page/StaticContentPage.class.php");
require_once("layout/model/page/HiddenStaticContentPage.class.php");

require_once("includes/model/page/InaccessibleContentPage.class.php");

require_once("layout/view/html/index.inc.php");

$application = new Application(
	/* Title */
	"Internationalised test website",

	/* CSS stylesheets */
	array("default.css"),
	
	/* Sections */
	array(
		"header" => new StaticSection("header.inc.php"),
		"menu" => new MenuSection(0),
		"contents" => new ContentsSection(true)
	),

	/* Pages */
	new LocalizedContentPage(array(
		"nl" => new StaticContentPage("Nederlands", new Contents("nl.inc.php")),
		"en-us" => new StaticContentPage("American", new Contents("en-us.inc.php")),
		"en-gb" => new StaticContentPage("British", new Contents("en-gb.inc.php")),
		"fr" => new StaticContentPage("Français", new Contents("fr.inc.php")),
		"de" => new StaticContentPage("Deutsch", new Contents("de.inc.php")),
		
		"inaccessible" => new InaccessibleContentPage("Inaccessible", new Contents("nl.inc.php")),
		
		"404" => new HiddenLocalizedContentPage(array(
			"nl" => new HiddenStaticContentPage("Pagina niet gevonden", new Contents("error/404/nl.inc.php")),
			"en-us" => new HiddenStaticContentPage("Page not found", new Contents("error/404/en-us.inc.php")),
			"en-gb" => new HiddenStaticContentPage("Page not found", new Contents("error/404/en-gb.inc.php")),
			"fr" => new HiddenStaticContentPage("Page non trouvée", new Contents("error/404/fr.inc.php")),
			"de" => new HiddenStaticContentPage("Seite nicht gefunden", new Contents("error/404/de.inc.php")),
		)),
		"403" => new HiddenLocalizedContentPage(array(
			"nl" => new HiddenStaticContentPage("Verboden", new Contents("error/403/nl.inc.php")),
			"en-us" => new HiddenStaticContentPage("Forbidden", new Contents("error/403/en-us.inc.php")),
			"en-gb" => new HiddenStaticContentPage("Forbidden", new Contents("error/403/en-gb.inc.php")),
			"fr" => new HiddenStaticContentPage("Interdit", new Contents("error/403/fr.inc.php")),
			"de" => new HiddenStaticContentPage("Verboten", new Contents("error/403/de.inc.php")),
		))
	))
);

displayRequestedPage($application);
?>
