<?php
error_reporting(E_STRICT | E_ALL);

require(dirname(__FILE__)."/../../vendor/autoload.php");

use SBLayout\Model\Application;
use SBLayout\Model\Page\HiddenLocalizedContentPage;
use SBLayout\Model\Page\HiddenStaticContentPage;
use SBLayout\Model\Page\LocalizedContentPage;
use SBLayout\Model\Page\StaticContentPage;
use SBLayout\Model\Page\Content\Contents;
use SBLayout\Model\Section\ContentsSection;
use SBLayout\Model\Section\MenuSection;
use SBLayout\Model\Section\StaticSection;
use Examples\I18N\Model\Page\InaccessibleContentPage;

$application = new Application(
	/* Title */
	"Internationalised test website",

	/* CSS stylesheets */
	array("default.css"),
	
	/* Sections */
	array(
		"header" => new StaticSection("header.php"),
		"menu" => new MenuSection(0),
		"contents" => new ContentsSection(true)
	),

	/* Pages */
	new LocalizedContentPage(array(
		"nl" => new StaticContentPage("Nederlands", new Contents("nl.php")),
		"en-us" => new StaticContentPage("American", new Contents("en-us.php")),
		"en-gb" => new StaticContentPage("British", new Contents("en-gb.php")),
		"fr" => new StaticContentPage("Français", new Contents("fr.php")),
		"de" => new StaticContentPage("Deutsch", new Contents("de.php")),
		
		"inaccessible" => new InaccessibleContentPage("Inaccessible", new Contents("nl.php")),
		
		"404" => new HiddenLocalizedContentPage(array(
			"nl" => new HiddenStaticContentPage("Pagina niet gevonden", new Contents("error/404/nl.php")),
			"en-us" => new HiddenStaticContentPage("Page not found", new Contents("error/404/en-us.php")),
			"en-gb" => new HiddenStaticContentPage("Page not found", new Contents("error/404/en-gb.php")),
			"fr" => new HiddenStaticContentPage("Page non trouvée", new Contents("error/404/fr.php")),
			"de" => new HiddenStaticContentPage("Seite nicht gefunden", new Contents("error/404/de.php")),
		)),
		"403" => new HiddenLocalizedContentPage(array(
			"nl" => new HiddenStaticContentPage("Verboden", new Contents("error/403/nl.php")),
			"en-us" => new HiddenStaticContentPage("Forbidden", new Contents("error/403/en-us.php")),
			"en-gb" => new HiddenStaticContentPage("Forbidden", new Contents("error/403/en-gb.php")),
			"fr" => new HiddenStaticContentPage("Interdit", new Contents("error/403/fr.php")),
			"de" => new HiddenStaticContentPage("Verboten", new Contents("error/403/de.php")),
		))
	)),

	/* Favorite icon */
	"favicon.ico"
);

\SBLayout\View\HTML\displayRequestedPage($application);
?>
