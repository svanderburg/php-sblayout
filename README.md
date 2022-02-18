php-sblayout
============
This package contains a PHP library that makes my life a bit easier while
developing PHP web applications. I have observed that for many web applications
that I have developed in the past, all pages all more or less look and behave in
a quite similar way.

As a consequence, I have found myself writing lots of boiler plate code that
had to be repeated for each additional page I implement. Furthermore, it also
turned maintenance of pages into quite a tedious problem.

This library allows someone to define a web application as a set of pages that
refer to other sub pages. Developers only have to capture the common aspects,
such as the sections and style of the entire web application, once and only need
to provide the individual characteristics of every additional sub page.

The library automatically composes the corresponding pages, and ensures a number
of non-functional quality attributes, such as a mechanism allowing end users to
always know where they are in the navigation structure of the application.

Moreover, it also automatically hides sub pages in the menu sections that are
not accessible.

Installation
============
This package can be embedded in any PHP project by using
[PHP composer](https://getcomposer.org). Add the following items to your
project's `composer.json` file:

```json
{
  "repositories": [
    {
      "type": "git",
      "url": "https://github.com/svanderburg/php-sblayout.git"
    }
  ],

  "require": {
    "svanderburg/php-sblayout": "@dev",
  }
}
```

and run:

```bash
$ composer install
```

Installing development dependencies
===================================
When it is desired to modify the code or run the examples inside this
repository, the development dependencies must be installed by opening
the base directory and running:

```bash
$ composer install
```

Usage
=====
The library can be used in a straight forward way. To get a web application
working we have to remember three things.

First, we must create an object instance of the `Application` class that serves
as the _model_ of the application -- it captures common properties such as the
sections, style settings, and all the sub pages of the application.

An application model can be displayed by invoking a _view_ function. This package
contains a trivial implementation named: `displayRequestedPage()`.

Finally, we always use one single PHP page (invoking the view function) that
handles all requests to every sub page. The path components that are appended to
its URL serve as selectors for the sub pages of the application. For example:

* `http://localhost/index.php` refers to the entry page of the web application
* `http://localhost/index.php/a` refers to a sub page reachable from the entry page
* `http://localhost/index.php/a/b` refers to a sub page reachable from the previous sub page

Implementing a very trivial web application
-------------------------------------------
To create a very trivial web application displaying one page, we must first
create an index page (`index.php`) composing a simple application model:

```php
use SBLayout\Model\Application;
use SBLayout\Model\Page\StaticContentPage;
use SBLayout\Model\Page\Content\Contents;
use SBLayout\Model\Section\ContentsSection;
use SBLayout\Model\Section\StaticSection;

$application = new Application(
    /* Title */
    "Trivial web application",

    /* CSS stylesheets */
    array("default.css"),

    /* Sections */
    array(
        "header" => new StaticSection("header.php"),
        "contents" => new ContentsSection(true),
        "footer" => new StaticSection("footer.php")
    ),

    /* Pages */
    new StaticContentPage("Fruit", new Contents("fruit.php"))
);
```

In the above code fragment, we compose an application model in which every sub
page consists of three sections. The `header` and `footer` always display the
same code fragment. The `contents` section is filled with variable text that
makes every page unique.

Every sub page has `Trivial web application` in the title and use the style
settings from the `default.css` stylesheet.

We can display a sub page by appending the following function invocation to
`index.php`:

```php
\SBLayout\View\HTML\displayRequestedPage($application);
```

The above code fragment composes an HTML page from the code snippets for each
section that we have defined in the model. Each section translates to `div`
elements with their `id` attribute set to their corresponding array key in the
model).

After creating the model and view, we must implement the code for the static
sections and sub pages. The above model expects to have a directory structure
that looks as follows:

    styles/
      default.css
    sections/
      header.php
      footer.php
    contents/
      fruit.php
    index.php

The files to which the `StaticSection` objects refer should reside in
`sections/`, stylesheets should reside in `styles/` and the contents of every sub
page should reside in `contents/`.

Implementing a web application with sub pages
---------------------------------------------
We can adapt the page parameter to refer to a collection of sub pages by adding
an additional parameter to the constructor. Each element in the array represents
a sub page displaying a specific kind of fruit:

```php
/* Pages */
new StaticContentPage("Fruit", new Contents("fruit.php"), array(
    "apples" => new StaticContentPage("Apples", new Contents("fruit/apples.php")),
    "pears" => new StaticContentPage("Pears", new Contents("fruit/pears.php")),
    "oranges" => new StaticContentPage("Oranges", new Contents("fruit/oranges.php"))
))
```

By adding a menu section, we can automatically show a menu section on every page
that displays links to their sub pages and marks the link that is currently
selected as such. We can change the sections parameter to include a menu
section:

```php
use SBLayout\Model\Section\MenuSection;

/* Sections */
array(
    "header" => new StaticSection("header.php"),
    "menu" => new MenuSection(0),
    "contents" => new ContentsSection(true),
    "footer" => new StaticSection("footer.php")
),
```

We must also add a couple of additional files that display the contents of each
sub page:

    contents/
      fruit/
        apples.php
        pears.php
        oranges.php

After making these modifications, each page shows a menu section that displays
the fruit kinds. Clicking on a link will redirect us to the page displaying it.

Moreover, the URL component that comes after `index.php` also allows us to
navigate to every fruit flavour. For example, the following URL redirects us to
the oranges sub page: `http://localhost/index.php/oranges`

Implementing more complex navigation structures
-----------------------------------------------
It is also possible to have multiple levels of sub pages. For example, we can
also add sub pages to sub pages and an additional menu section (`submenu`)
displaying the available sub sub pages per sub page:

```php
/* Sections */
array(
    "header" => new StaticSection("header.php"),
    "menu" => new MenuSection(0),
    "submenu" => new MenuSection(1),
    "contents" => new ContentsSection(true),
    "footer" => new StaticSection("footer.php")
),

/* Pages */
new StaticContentPage("Fruit", new Contents("fruit.php"), array(
    "apples" => new StaticContentPage("Apples", new Contents("fruit/apples.php"), array(
        "red" => new StaticContentPage("Red", new Contents("fruit/apples/red.php")),
        "green" => new StaticContentPage("Green", new Contents("fruit/apples/green.php"))
    )),
    "pears" => new StaticContentPage("Pears", new Contents("fruit/pears.php"), array(
        "yellow" => new StaticContentPage("Yellow", new Contents("fruit/pears/yellow.php")),
        "green" => new StaticContentPage("Green", new Contents("fruit/pears/green.php"))
    )),
    "oranges" => new StaticContentPage("Oranges", new Contents("fruit/oranges.php"), array(
        "orange" => new StaticContentPage("Orange", new Contents("fruit/oranges/orange.php")),
        "yellow" => new StaticContentPage("Yellow", new Contents("fruit/oranges/yellow.php"))
    ))
))
```

Similar to the previous example, a `submenu` section displays the sub pages of a
particular fruit kind.

We can also use the URL to get to a specific sub sub page. For example, the
following URL shows the red apple sub sub page:
`http://localhost/index.php/apples/red`.

You can nest sub pages as deep as you want, but for the sake of usability this is
not recommended in most cases.

Error pages
-----------
It may also happen that some error occurs while trying to display a page. For
example, trying to access a sub page that does not exists (e.g.
`http://localhost/index.php/oranges/purple`) should display a 404 error page.
Moreover, pages that are inaccessible should display a 403 error page.

These error pages can be defined by adding them as a sub page to the entry page
with keys `403` and `404`:

```php
/* Pages */
new StaticContentPage("Fruit", new Contents("fruit.php"), array(
    "403" => new HiddenStaticContentPage("Forbidden", new Contents("error/403.php")),
    "404" => new HiddenStaticContentPage("Page not found", new Contents("error/404.php"))
    ...
))
```

Security handling
-----------------
If it is desired to secure a page from unauthorized access, you can implement
your own class that inherits from `Page` which overrides the
`checkAccessibility()` method. This function should return `true` if and only if
an end user is authorized to view it.

For example, the following class implements a page displaying content that denies
access to everyone:

```php
use SBLayout\Model\Page\ContentPage;

class InaccessibleContentPage extends ContentPage
{
    public function checkAccessibility()
    {
        return false;
    }
}
```

You can do in the body of `checkAccessibility()` whatever you want. For example,
you can also change it to take some cookie values containing a username and
password that gets verified against something that is stored in a database.

By adding an object that is in instance of our custom class to a sub page of the
entry page, we can secure it.

Implementing more complex dynamic layouts
-----------------------------------------
We can also support more complex dynamic layouts. In our previous example with
fruit kinds, we only defined one content section in which details about the fruit
kind is displayed.

We can also change the application model to have two dynamic content sections
(or even more). By replacing the first parameter of the `Contents` section from 
string to an array, we can specify the contents of each content section of page.
(if only a string is given, the `contents` section is modified).

The following model makes the header as well as the contents sections dynamic for
each sub page:

```php
/* Sections */
array(
    "header" => new ContentsSection(false),
    "menu" => new MenuSection(0),
    "contents" => new ContentsSection(true),
    "footer" => new StaticSection("footer.php")
),

/* Pages */
new StaticContentPage("Fruit", new Contents(array(
    "header" => "fruit.php",
    "contents" => "fruit.php"
)), array(
    "apples" => new StaticContentPage("Apples", new Contents(array(
        "header" => "fruit/apples.php",
        "contents" => "fruit/apples.php"
    ))),
    "pears" => new StaticContentPage("Pears", new Contents(array(
        "header" => "fruit/pears.php",
        "contents" => "fruit/pears.php"
    ))),
    "oranges" => new StaticContentPage("Oranges", new Contents(array(
        "header" => "fruit/oranges.php",
        "contents" => "fruit/oranges.php"
    )))
))
```

The above model also requires a few additional files that should reside in the
`header` subdirectory:

    header/
      fruit.php
      fruit/
        apples.php
        pears.php
        oranges.php

The above files should display the header for each fruit kind.

Handling GET or POST parameters
-------------------------------
Sometimes it may also be required to process GET or POST parameters, if a sub
page (for example) contains a form.

The contents object can also take a controller parameter that invokes a PHP
snippet that is processed before any HTML output is rendered:

```php
/* Pages */

new StaticContentPage("Fruit", new Contents("fruit.php"), array(
    ...
    "question" => new StaticContentPage("Question", new Contents("question.php", "question.php")),
    ...
)
```

The above code fragment adds a sub page that displays a form asking the user a
question what his/her favorite fruit kind is. After a user submits his answer
through the form the same page is displayed. Instead of showing the form the
answer is displayed.

The PHP include provided as second parameter to the `Contents` constructor takes
care of processing the POST parameter. The file should reside in the following
location on the filesystem:

    controller/
      question.php

Using path components as parameters
-----------------------------------
Instead of using the path components in a URL to address sub pages, we may also
want to use path components as parameters instead. To use path components as
parameters, we can use objects that are instances of `DynamicContentPage`:

```php
use SBLayout\Model\Page\DynamicContentPage;
```

The following code fragments adds a sub page having a sub page that interprets
a path component:

```php
/* Pages */

new StaticContentPage("Fruit", new Contents("fruit.php"), array(
    ...
    "fruitname" => new DynamicContentPage("Display fruit name", "fruitname", new Contents("fruitname.php"))
    ...
))
```

The first parameter of the constructor contains the title, the second the name of
the variable that will be set when the sub page is processed, and the third
parameter configures the content sections that are supposed to interpret the
variable.

We can implement the `fruitname.php` to simply display the parameter:

```php
<?php
<p><?php print($GLOBALS["query"]["fruitname"]); ?></p>
?>
```

If we address the page with: `http://localhost/index.php/fruitname/apples` we
should see:

    apples

and if we address the page with: `http://localhost/index.php/fruitname/bananas`
we should see:

    bananas

The `DynamicContentPage` constructor also has an optional fourth parameter to
define additional sub pages or to interpret multiple parameters.

Implementing an internationalised web application
-------------------------------------------------
Another use case is implementing internationalised web applications. By creating
a page that is an instance of a `LocalizedContentPage` we can easily support
the same page in multiple languages:

```php
use SBLayout\Model\Page\LocalizedContentPage;

/* Pages */
new LocalizedContentPage(array(
    "nl" => new StaticContentPage("Nederlands", new Contents("nl.php")),
    "en-us" => new StaticContentPage("American", new Contents("en-us.php")),
    "en-gb" => new StaticContentPage("British", new Contents("en-gb.php")),
    "fr" => new StaticContentPage("Français", new Contents("fr.php")),
    "de" => new StaticContentPage("Deutsch", new Contents("de.php"))
))
```

The above code fragment defines a page with translations into Dutch, American,
British, French and German.

Any user can retrieve a particular translation of a page (such as German) by
using the following URL:

    http://localhost/index.php/de

If the root of this URL is used:

    http://localhost/index.php

Then the preferred language will be derived from the `Accept-Language` parameter
in the HTTP header that is sent by the user agent.

If a particular variant of language is not supported (e.g. the Belgian variant of
Dutch: `nl-be`) then the detection algorithm will automatically do a fallback to
the generic variant: `nl`.

If none of the preferred languages is supported, the first option in the array
will be taken (which is `nl` in our example).

More use cases
--------------
There are also facilities to include application wide and per-page stylesheets
and script includes. We can also make pages invisible from menu sections by
instantiating pages that are prefixed with `Hidden*`.

Moreover, there are two utility functions: the `Page::computeBaseURL()` model
function and the `setBaseURL()` view function to determine the base directory in
which the index script resides.

Consult the API documentation for more information.

Examples
========
This package includes three example web applications that can be found in the
`examples/` folder:

* The `simple` web application demonstrates simple sub pages, inaccessible sub
  pages, dynamic sub pages and a page handling POST requests
* The `i18n` web application demonstrates an internationalised web page
  displaying the same page in multiple languages
* The `advanced` web applications demonstrates more advanced sub pages with
  multiple content sections. It also demonstrates style and script variability.

API documentation
=================
This package includes API documentation that can be generated with
[phpDocumentor](https://www.phpdoc.org):

```bash
$ vendor/bin/phpdoc
```

License
=======
The contents of this package is available under the [Apache Software License](http://www.apache.org/licenses/LICENSE-2.0.html)
version 2.0
