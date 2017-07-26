<?php
namespace SBLayout\Model\Page;
use SBLayout\Model\Application;

/**
 * Defines a static content page referring to sub pages that each implement the same page,
 * but in a different language. The localized page tries to detect the preferred language
 * from the Accept-Language parameter sent by the user agent and displays the page in that
 * language accordingly.
 * 
 * If the preferred languages are not supported, it will fallback to the first sub page. 
 */
class LocalizedContentPage extends StaticContentPage
{
	/**
	 * Creates a new LocalizedContentPage instance.
	 * 
	 * @param array $subPages An associative array mapping language identifiers (i.e. language-country) to sub pages
	 */
	public function __construct(array $subPages = null)
	{
		parent::__construct(reset($subPages)->title, reset($subPages)->contents, $subPages);
	}
	
	/**
	 * @see Page::lookupSubPage()
	 */
	public function lookupSubPage(Application $application, array $ids, $index = 0)
	{
		if(count($ids) == $index)
		{
			$options = array(); // Stores the preference array
			$locales = explode(",", $_SERVER["HTTP_ACCEPT_LANGUAGE"]);
				
			/* Parse the locales to separate the identifiers and weights */
			foreach($locales as $locale)
			{
				$localeComponents = explode(";", $locale);
			
				$identifier = $localeComponents[0];
			
				if(count($localeComponents) > 1)
					$weight = substr($localeComponents[1], 2);
				else
					$weight = 1.0; // if a q value is not given, assume 1.0
			
				$options[$identifier] = $weight;
			}
				
			arsort($options, SORT_NUMERIC); // Sort on priority
				
			/* Try to lookup the locale with the highest priority that is defined as sub item */
			foreach($options as $identifier => $weight)
			{
				if(array_key_exists($identifier, $this->subPages))
				{
					$result = $this->subPages[$identifier];
					return $result->lookupSubPage($application, $ids, $index);
				}
				else
				{
					$identifierComponents = explode("-", $identifier);
					
					if(count($identifierComponents) > 1)
					{
						// Try the locale's language without country as a fallback
						$language = $identifierComponents[0];
						
						if(array_key_exists($language, $this->subPages))
						{
							$result = $this->subPages[$language];
							return $result->lookupSubPage($application, $ids, $index);
						}
					}
				}
			}
			
			/* If all locales have been tried and still none has been found, return the first sub page that is considered the default */
			
			$result = reset($this->subPages);
			return $result->lookupSubPage($application, $ids, $index);
		}
		else
			return parent::lookupSubPage($application, $ids, $index);
	}
}
?>
