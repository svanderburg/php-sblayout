<?php
require_once(dirname(__FILE__)."/../vendor/autoload.php");

use PHPUnit\Framework\TestCase;
use SBLayout\Model\Application;
use SBLayout\Model\PageForbiddenException;
use SBLayout\Model\PageNotFoundException;
use SBLayout\Model\Route;
use SBLayout\Model\Page\DynamicContentPage;
use SBLayout\Model\Page\ExternalPage;
use SBLayout\Model\Page\HiddenStaticContentPage;
use SBLayout\Model\Page\PageAlias;
use SBLayout\Model\Page\StaticContentPage;
use SBLayout\Model\Page\Content\Contents;
use SBLayout\Model\Section\ContentsSection;
use SBLayout\Model\Section\MenuSection;
use SBLayout\Model\Section\StaticSection;
use Examples\Simple\Model\Page\InaccessibleContentPage;

class ApplicationTest extends TestCase
{
	protected Application $application;

	protected StaticContentPage $rootPage;

	protected StaticContentPage $page1;

	protected StaticContentPage $page11;

	protected function setUp(): void
	{
		$this->page11 = new StaticContentPage("Subpage 1.1", new Contents("page1/subpage11.php"));

		$this->page1 = new StaticContentPage("Page 1", new Contents("page1.php"), array(
			"page11" => $this->page11,
			"page12" => new StaticContentPage("Subpage 1.2", new Contents("page1/subpage12.php")),
			"page13" => new StaticContentPage("Subpage 1.3", new Contents("page1/subpage13.php")))
		);

		$this->rootPage = new StaticContentPage("Home", new Contents("home.php"), array(
			"403" => new HiddenStaticContentPage("Forbidden", new Contents("error/403.php")),
			"404" => new HiddenStaticContentPage("Page not found", new Contents("error/404.php")),

			"home" => new PageAlias("Home", ""),

			"aliaspage1" => new PageAlias("Alias page 1", "page1"),

			"inaccessible" => new InaccessibleContentPage("Inaccessible", new Contents("page1.php")),

			"page1" => $this->page1,

			"page2" => new StaticContentPage("Page 2", new Contents("page2.php"), array(
				"page21" => new StaticContentPage("Subpage 2.1", new Contents("page2/subpage21.php")),
				"page22" => new StaticContentPage("Subpage 2.2", new Contents("page2/subpage22.php")),
				"page23" => new StaticContentPage("Subpage 2.3", new Contents("page2/subpage23.php")))),

			"form" => new StaticContentPage("Form", new Contents("form.php", "form.php")),

			"firstname" => new DynamicContentPage("First name", "firstname", new Contents("firstname.php"), new StaticContentPage("First name", new Contents("firstname/firstname.php"), array(
				"lastname" => new DynamicContentPage("Last name", "lastname", new Contents("firstname/lastname.php"), new StaticContentPage("Last name", new Contents("firstname/lastname/lastname.php")))
			))),

			"external" => new ExternalPage("External", "http://www.google.com")
		));
	
		$this->application = new Application(
			/* Title */
			"Simple test website",

			/* CSS stylesheets */
			array("default.css"),

			/* Sections */
			array(
				"header" => new StaticSection("header.php"),
				"menu" => new MenuSection(0),
				"submenu" => new MenuSection(1),
				"contents" => new ContentsSection(true)
			),

			/* Pages */
			$this->rootPage,

			/* Favorite icon */
			"favicon.ico"
		);
	}

	public function testLookupRoot(): void
	{
		$route = new Route(array());
		$this->application->examineRoute($route);
		$currentPage = $route->determineCurrentPage();
		$this->assertEquals($this->rootPage, $currentPage);
	}

	public function testLookupPage1(): void
	{
		$route = new Route(array("page1"));
		$this->application->examineRoute($route);
		$currentPage = $route->determineCurrentPage();
		$this->assertEquals($this->page1, $currentPage);
	}

	public function testLookupSubPage11(): void
	{
		$route = new Route(array("page1", "page11"));
		$this->application->examineRoute($route);
		$currentPage = $route->determineCurrentPage();
		$this->assertEquals($this->page11, $currentPage);
	}

	public function testLookupNonExistentPage(): void
	{
		$this->expectException(PageNotFoundException::class);
		$this->application->examineRoute(new Route(array("nonexistent")));
	}

	public function testLookupNonExistentSubPage(): void
	{
		$this->expectException(PageNotFoundException::class);
		$this->application->examineRoute(new Route(array("page1", "nonexistent")));
	}

	public function testLookupNonExistentSubSubPage(): void
	{
		$this->expectException(PageNotFoundException::class);
		$this->application->examineRoute(new Route(array("page1", "page11", "nonexistent")));
	}

	public function testLookupInNonExistentSubPage(): void
	{
		$this->expectException(PageNotFoundException::class);
		$this->application->examineRoute(new Route(array("nonexistent", "page11")));
	}

	public function testLookupHomeAlias(): void
	{
		$route = new Route(array("home"));
		$this->application->examineRoute($route);
		$currentPage = $route->determineCurrentPage();
		$this->assertEquals($this->rootPage, $currentPage);
	}

	public function testLookupInaccessiblePage(): void
	{
		$this->expectException(PageForbiddenException::class);
		$this->application->examineRoute(new Route(array("inaccessible")));
	}

	public function testLookupFirstNameAndLastName(): void
	{
		$route = new Route(array("firstname", "sander", "lastname", "vanderburg"));
		$this->application->examineRoute($route);
		$this->assertEquals($GLOBALS["query"], array(
			"firstname" => "sander",
			"lastname" => "vanderburg"
		));
	}
}
?>
