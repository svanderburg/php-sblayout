<?php
require_once(dirname(__FILE__)."/../vendor/autoload.php");

use PHPUnit\Framework\TestCase;
use SBLayout\Model\Application;
use SBLayout\Model\PageNotFoundException;
use SBLayout\Model\Route;
use SBLayout\Model\Page\HiddenLocalizedContentPage;
use SBLayout\Model\Page\HiddenStaticContentPage;
use SBLayout\Model\Page\LocalizedContentPage;
use SBLayout\Model\Page\StaticContentPage;
use SBLayout\Model\Page\Content\Contents;
use SBLayout\Model\Section\ContentsSection;
use SBLayout\Model\Section\MenuSection;
use SBLayout\Model\Section\StaticSection;
use Examples\I18N\Model\Page\InaccessibleContentPage;

class LocalizedApplicationTest extends TestCase
{
	protected StaticContentPage $nlPage;
	protected StaticContentPage $enUSPage;
	protected StaticContentPage $dePage;
	protected Application $application;

	protected function setUp(): void
	{
		$this->nlPage = new StaticContentPage("Nederlands", new Contents("nl.php"));
		$this->enUSPage = new StaticContentPage("American", new Contents("en-us.php"));
		$this->dePage = new StaticContentPage("Deutsch", new Contents("de.php"));

		$this->application = new Application(
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
				"nl" => $this->nlPage,
				"en-us" => $this->enUSPage,
				"en-gb" => new StaticContentPage("British", new Contents("en-gb.php")),
				"fr" => new StaticContentPage("Français", new Contents("fr.php")),
				"de" => $this->dePage,

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
	}

	public function testEN_US(): void
	{
		$route = new Route(array("en-us"));
		$this->application->examineRoute($route);
		$currentPage = $route->determineCurrentPage();
		$this->assertEquals($this->enUSPage, $currentPage);
	}

	public function testNL(): void
	{
		$route = new Route(array("nl"));
		$this->application->examineRoute($route);
		$currentPage = $route->determineCurrentPage();
		$this->assertEquals($this->nlPage, $currentPage);
	}

	public function testPT(): void
	{
		$this->expectException(PageNotFoundException::class);
		$this->application->examineRoute(new Route(array("pt")));
	}

	public function testRootWithDE_DE(): void
	{
		$_SERVER["HTTP_ACCEPT_LANGUAGE"] = "de-de";
		$route = new Route(array());
		$this->application->examineRoute($route);
		$currentPage = $route->determineCurrentPage();
		$this->assertEquals($this->dePage, $currentPage);
	}

	public function testRootWithEN_US(): void
	{
		$_SERVER["HTTP_ACCEPT_LANGUAGE"] = "en-us";
		$route = new Route(array());
		$this->application->examineRoute($route);
		$currentPage = $route->determineCurrentPage();
		$this->assertEquals($this->enUSPage, $currentPage);
	}

	public function testRootWithDE_CH(): void
	{
		$_SERVER["HTTP_ACCEPT_LANGUAGE"] = "de-ch";
		$route = new Route(array());
		$this->application->examineRoute($route);
		$currentPage = $route->determineCurrentPage();
		$this->assertEquals($this->dePage, $currentPage);
	}

	public function testRootWithPT_BR(): void
	{
		$_SERVER["HTTP_ACCEPT_LANGUAGE"] = "pt-br";
		$route = new Route(array());
		$this->application->examineRoute($route);
		$currentPage = $route->determineCurrentPage();
		$this->assertEquals($this->nlPage, $currentPage);
	}

	public function testRootWithMultipleOptions(): void
	{
		$_SERVER["HTTP_ACCEPT_LANGUAGE"] = "en-us,de-de";
		$route = new Route(array());
		$this->application->examineRoute($route);
		$currentPage = $route->determineCurrentPage();
		$this->assertEquals($this->enUSPage, $currentPage);
	}

	public function testRootWithMultipleOptionsAndPriorities(): void
	{
		$_SERVER["HTTP_ACCEPT_LANGUAGE"] = "en-us;q=0.8,de-de;q=1.0";
		$route = new Route(array());
		$this->application->examineRoute($route);
		$currentPage = $route->determineCurrentPage();
		$this->assertEquals($this->dePage, $currentPage);
	}
}
?>
