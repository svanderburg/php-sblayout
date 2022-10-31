<?php
namespace SBLayout\Model\Page\Content;

/**
 * Represents the contents that ends up in the dynamic content sections of a page.
 *
 * The content is in most cases a single division containing HTML code, but it can also
 * be multiple divisions each having their own HTML fragments.
 */
class Contents
{
	/** An associative array mapping division ids onto PHP files representing HTML content */
	public array $sections;
	
	/** A string containing the path to the controller page that handles GET or POST parameters or NULL if there is no controller */
	public ?string $controller;
	
	/** An array containing stylesheet files to include */
	public ?array $styles;
	
	/** An array containing script files to include */
	public ?array $scripts;
	
	/**
	 * Creates a new contents instance.
	 *
	 * @param $sections An associative array mapping division ids onto files representing HTML content or a string, which represents the contents of the contents division.
	 * @param $controller A string containing the path to the controller page that handles GET or POST parameters
	 * @param $styles An array containing stylesheet files to include when requesting this page
	 * @param $scripts An array containing script files to include when requesting this page
	 */
	public function __construct(array|string $sections, string $controller = null, ?array $styles = array(), ?array $scripts = array())
	{
		if(is_array($sections))
			$this->sections = $sections;
		else
			$this->sections = array("contents" => $sections);
		
		$this->controller = $controller;
		$this->styles = $styles;
		$this->scripts = $scripts;
	}
}
?>
