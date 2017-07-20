<?php
echo "<div id='menue'>";
echo "<h3>";
echo sys::getTitle();
echo "</h3>";
echo "<a href='javascript:void(0)' class='navigationClose'>&times;</a>";
if ($_SESSION['user']->isAdmin()) {
   Menu::display(Menu::getIdByName("{admin}"),
               "<ul id=\"adminmenue\">",
               "</ul>",
         " <li>",
         "</li>",
         "adminmenue");
 }
 else if ($_SESSION['user']->isUser()) {
   Menu::display(
     Menu::getIdByName("{user}"),
     "<ul id=\"usermenu\">",
     "</ul>",
     "<li>",
     "</li>",
     "usermenue");
 }
 ?>
