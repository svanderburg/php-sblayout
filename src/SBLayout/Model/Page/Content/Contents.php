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
	public $sections;
	
	/** A string containing the path to the controller page that handles GET or POST parameters */
	public $controller;
	
	/** An array containing stylesheet files to include */
	public $styles;
	
	/** An array containing script files to include */
	public $scripts;
	
	/**
	 * Creates a new contents instance.
	 * 
	 * @param mixed $sections An associative array mapping division ids onto files representing HTML content or a string, which represents the contents of the contents division.
	 * @param string $controller A string containing the path to the controller page that handles GET or POST parameters
	 * @param array $styles An array containing stylesheet files to include when requesting this page 
	 * @param array $scripts An array containing script files to include when requesting this page
	 */
	public function __construct($sections, $controller = NULL, array $styles = NULL, array $scripts = NULL)
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
