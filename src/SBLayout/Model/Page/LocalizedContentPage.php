<?php
namespace SBLayout\Model\Page;
use SBLayout\Model\Application;
use SBLayout\Model\Route;

/**
 * Defines a static content page referring to sub pages that each implement the same page,
 * but in a different language. The localized page tries to detect the preferred language
 * from the Accept-Language parameter sent by the user agent and displays the page in that
 * language accordingly.
 *
 * If the preferred languages are not supported, it will fall back to the first sub page.
 */
class LocalizedContentPage extends StaticContentPage
{
	/**
	 * Creates a new LocalizedContentPage instance.
	 *
	 * @param $subPages An associative array mapping language identifiers (i.e. language-country) to sub pages
	 */
	public function __construct(array $subPages = array())
	{
		parent::__construct(reset($subPages)->title, reset($subPages)->contents, $subPages);
	}
	
	private function parseLocaleOptions(string $acceptLanguage): array
	{
		$options = array(); // Stores the preference array
		$locales = explode(",", $acceptLanguage);

		/* Parse the locales to separate the identifiers and weights */
		foreach($locales as $locale)
		{
			$localeComponents = explode(";", $locale);

			$identifier = strtolower($localeComponents[0]);

			if(count($localeComponents) > 1)
				$weight = substr($localeComponents[1], 2);
			else
				$weight = 1.0; // if a q value is not given, assume 1.0

			$options[$identifier] = $weight;
		}

		arsort($options, SORT_NUMERIC); // Sort on priority

		return $options;
	}
	
	private function findLocalizedSubPage(array $options): Page
	{
		foreach($options as $identifier => $weight)
		{
			// Check if there is a locale option that matches the requested locale
			if(array_key_exists($identifier, $this->subPages))
				return $this->subPages[$identifier];
			else
			{
				$identifierComponents = explode("-", $identifier);
				
				if(count($identifierComponents) > 1)
				{
					// Try the locale's language without country as a fallback
					$language = $identifierComponents[0];
					
					if(array_key_exists($language, $this->subPages))
						return $this->subPages[$language];
				}
			}

			/* If all locales have been tried and still none has been found, return the first sub page (that is considered the default) */
			return reset($this->subPages);
		}
	}
	
	/**
	 * @see Page::examineRoute()
	 */
	public function examineRoute(Application $application, Route $route, int $index = 0): void
	{
		if($route->indexIsAtRequestedPage($index))
		{
			/* Visit itself */
			$route->visitPage($this);

			/* Parse the locales to separate identifiers and weights */
			$options = $this->parseLocaleOptions($_SERVER["HTTP_ACCEPT_LANGUAGE"]);

			/* Try to lookup the locale with the highest priority that is defined as sub item */
			$subPage = $this->findLocalizedSubPage($options);

			/* Examine the localized page */
			$subPage->examineRoute($application, $route, $index);
		}
		else
			parent::examineRoute($application, $route, $index);
	}
}
?>
