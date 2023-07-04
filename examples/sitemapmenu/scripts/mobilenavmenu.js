/*
 * This JavaScript module transforms an HTML representation of a site map consisting of a root link
 * and nested unordered list into a mobile navigation menu:
 *
 * - It transforms the root link into a mobile navigation menu button by replacing the text of the
 *   root link by an icon image. Clicking on the menu button makes the navigation menu visible or
 *   invisible
 * - The 1st level sub menu becomes visible by adding the CSS class: navmenu_active to the unordered
 *   list
 * - The menu button becomes active by adding the CSS class: navmenu_icon_active to the image of
 *   the root link
 * - Nested menus can be unfolded or folded. This module adds fold icons to each list item of the
 *   unordered lists that embed a nested unordered list. The nested unordered list represent 2nd
     level menus
 * - Clicking on the fold icon makes the nested unordered list visible or invisible
 * - A nested unordered list becomes visible by adding the CSS class: navsubmenu_active to the
 *   unordered list
 * - A fold button becomes active by adding the CSS class: navmenu_unfold_active to the fold icon
 *   image
 * - The mobile navigation menu gets enabled when the screen width is below 1024 pixels and disables
 *   itself when the screen becomes at least 1024 pixels wide
 */

(function() {

    var basePath = "/examples/sitemapmenu"; // Base path of the web application
    var originalText; // Stores the original root link text
    var enabled = false;

    function createLinkToMobileNavStylesheet() {
         var link = document.createElement("link");
         link.rel = "stylesheet";
         link.type = "text/css";
         link.href = basePath + "/styles/mobilenavmenu.css";
         return link;
    }

    function createMenuIcon() {
        var icon = document.createElement("img");
        icon.src = basePath + "/image/menu.png";
        icon.alt = "Menu";
        return icon;
    }

    function createFoldIcon(subMenuList) {
        var foldIcon = document.createElement("img");
        foldIcon.src = basePath + "/image/down-arrow.png";
        foldIcon.alt = "Unfold";

        foldIcon.onclick = function() {
            if(subMenuList.classList.contains("navsubmenu_active")) {
                subMenuList.classList.remove("navsubmenu_active");
                foldIcon.classList.remove("navmenu_unfold_active");
            } else {
                subMenuList.classList.add("navsubmenu_active");
                foldIcon.classList.add("navmenu_unfold_active");
            }

            return false;
        };

        return foldIcon;
    }

    function adjustRootLink(icon, rootLink) {
        originalText = rootLink.firstChild;
        rootLink.removeChild(originalText);
        rootLink.appendChild(icon);
    }

    function processFoldButtons(unorderedListOfLinks, processFun) {
        var listItems = unorderedListOfLinks.getElementsByTagName("li");

        for(var i = 0; i < listItems.length; i++) {
            var listItem = listItems[i];
            var subMenuLists = listItem.getElementsByTagName("ul");

            if(subMenuLists.length > 0) {
                var link = listItem.getElementsByTagName("a")[0];
                var subMenuList = subMenuLists[0];

                processFun(subMenuList, link);
            }
        }
    }

    function addFoldButtons(unorderedListOfLinks) {
        processFoldButtons(unorderedListOfLinks, function(subMenuList, link) {
            var foldIcon = createFoldIcon(subMenuList);
            link.appendChild(foldIcon);
        });
    }

    function enableMobileNavigationButton() {
        if(!enabled) {
            enabled = true;

            // Add a link to CSS stylesheet with mobile navigation properties
            var link = createLinkToMobileNavStylesheet();
            document.head.appendChild(link);

            // Query the menu div element
            var menuDiv = document.getElementById("menu");

            // Query the root link of the sitemap
            var rootLink = menuDiv.getElementsByTagName("a")[0];

            // Remove the text of the root link and replace it with an icon
            var icon = createMenuIcon();
            adjustRootLink(icon, rootLink);

            // Query the list of pages reachable from the root page
            var unorderedListOfLinks = menuDiv.getElementsByTagName("ul")[0];

            // Examine which list item (page) has sub pages (a nested unordered list). For these items, we will add a unfold button
            addFoldButtons(unorderedListOfLinks);

            // Configure the click handler for the root link representing the navigation menu
            // Clicking adds or removes the `navmenu_active` and `navmenu_icon_active` CSS classes

            rootLink.onclick = function() {
                if(unorderedListOfLinks.classList.contains("navmenu_active")) {
                    unorderedListOfLinks.classList.remove("navmenu_active");
                    icon.classList.remove("navmenu_icon_active");
                } else {
                    unorderedListOfLinks.classList.add("navmenu_active");
                    icon.classList.add("navmenu_icon_active");
                }

                return false; // Prevent the browser from following the link
            };
        }
    }

    function removeCSSStyleSheetLink() {
        var links = document.head.getElementsByTagName("link");
        var link = links[links.length - 1];
        document.head.removeChild(link);
    }

    function restoreRootLink(menuDiv) {
        // Query the root link of the site map
        var rootLink = menuDiv.getElementsByTagName("a")[0];

        // Remove the click handler, icon and re-add the original text again
        rootLink.onclick = null;
        rootLink.removeChild(rootLink.firstChild);
        rootLink.appendChild(originalText);
    }

    function removeFoldButtons(unorderedListOfLinks) {
        processFoldButtons(unorderedListOfLinks, function(subMenuList, link) {
            var foldIcon = link.getElementsByTagName("img")[0];
            link.removeChild(foldIcon);
        });
    }

    function disableMobileNavigationButton() {
        if(enabled) {
            enabled = false;

            // Remove the CSS stylesheet link with mobile navigation menu properties
            removeCSSStyleSheetLink();

            // Query the menu div element
            var menuDiv = document.getElementById("menu");

            // Remove the icon and restore the original text of the root link
            restoreRootLink(menuDiv);

            // Query the list of pages reachable from the root page
            var unorderedListOfLinks = menuDiv.getElementsByTagName("ul")[0];

            // Examine which list item (page) has sub pages (a nested unordered list). For these items, we will remove the unfold button
            removeFoldButtons(unorderedListOfLinks);

            // Remove the active class
            unorderedListOfLinks.classList.remove("navmenu_active");
        }
    }

    function decideWhetherToEnableNavigationButton() {
        if(window.innerWidth < 1024) {
            enableMobileNavigationButton();
        } else {
            disableMobileNavigationButton();
        }
    }

    window.onload = decideWhetherToEnableNavigationButton;
    window.onresize = decideWhetherToEnableNavigationButton;

})();
