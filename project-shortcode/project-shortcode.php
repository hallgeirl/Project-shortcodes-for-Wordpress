<?php
/*
Plugin Name: Project Shortcodes
Plugin URI: http://www.hallgeir.org/programming
Description: Shortcodes for listing projects in a page.
Author: Hallgeir Lien
Version: 1.1
*/

/*  Copyright 2012  Hallgeir Lien

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU Lesser General Public License as published 
    by the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU Lesser General Public License for more details.

    You should have received a copy of the GNU Lesser General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function create_subheader($title, $topheaderlevel)
{
    $headerlevel = $topheaderlevel+1;
    $header = "<h" . $headerlevel . " style=\"margin-top: 0em; margin-bottom: 0.2em;\">";

    $header .=  $title;
    $header .= "</h" . $headerlevel . ">\n";

    return $header;
}

function create_header($title, $lang, $headerlevel)
{
    $header = "<h" . $headerlevel . " style=\"margin-bottom: 0.5em;\">";

    $header .=  $title;
    if (!empty($lang))
        $header .= " (" . $lang . ")";
    $header .= "</h" . $headerlevel . ">\n";

    return $header;
}

function create_screenshot($url)
{
    $result = "";
    $result .= "<span style=\"display: inline-block;\">";
    $result .= "<a href=\"" . $url . "\">";
    $result .= "<img class=\"size-thumbnail wp-image-33\" title=\"" . $url . "\" src=\"" . substr($url, 0, strlen($url) - strlen(strrchr($url, "."))) . "-150x150" . substr($url, strlen($url) - strlen(strrchr($url, "."))) . "\" alt=\"screenshot: " . $url . "\" />";
    $result .= "</a></span>";

    return $result;
}

function create_screenshots($screenshots, $topheaderlevel)
{
    $result = "";

    if (!empty($screenshots)) {
        $result .= create_subheader("Screenshots:", $topheaderlevel);
        $result .= "<p>";
        $ss = explode("|", $screenshots);
        foreach($ss as $s) 
        {
    	    $result .= create_screenshot($s);
        }
        $result .= "</p>";
    }

    return $result;
}

function create_links($url, $repository, $headerlevel)
{
    $result = "";
    if (!empty($url) || !empty($repository))
    {
        $result .= create_subheader("Links:", $headerlevel);
        $result .= "<p>";

        if (!empty($url))
            $result .= "<a href=\"" . $url . "\">Download</a>\n";
        if (!empty($repository))
            $result .= "<a href=\"" . $repository . "\">Code repository</a>\n";
        $result .= "</p>";
    }
    return $result;
}

function project_shortcode($atts, $content = null)
{
    extract(shortcode_atts(array("url" => "", "repository" => "", "title" => "Untitled project", "headerlevel" => 3, "lang" => "", "screenshots" => ""), $atts));
    
    if ($headerlevel <= 0) $headerlevel = 2;
    $result = create_header($title, $lang, $headerlevel);
    
    $result .= "<p>";
    if (!empty($content))
        $result .= $content . "\n";
    
    $result .= create_screenshots($screenshots, $headerlevel);
  
    $result .= create_links($url, $repository, $headerlevel);

    $result .= "</p>\n";
    
    return $result;
}

add_shortcode("project", "project_shortcode"); 

?>
