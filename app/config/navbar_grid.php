<?php
/**
 * Config-file for navigation bar.
 *
 */
return [

    // Use for styling the menu
    'class' => 'navbar',

    // Here comes the menu strcture
    'items' => [

        'Theme' => [
            'text'  =>'Theme',
            'url'   => $this->di->get('url')->create('theme.php/'),
            'title' => 'Url to relative frontcontroller, other file'
        ],

        'Typography' => [
            'text'  =>'Typography',
            'url'   => $this->di->get('url')->create('theme.php/Typography'),
            'title' => 'Url to relative frontcontroller, other file'
        ],

        'Font Awesome' => [
            'text'  =>'Font Awesome',
            'url'   => $this->di->get('url')->create('theme.php/FontAwesome'),
            'title' => 'Url to relative frontcontroller, other file'
        ],
    ],



    /**
     * Callback tracing the current selected menu item base on scriptname
     *
     */
    'callback' => function ($url) {
        if ($url == $this->di->get('request')->getCurrentUrl(false)) {
            return true;
        }
    },



    /**
     * Callback to check if current page is a decendant of the menuitem, this check applies for those
     * menuitems that has the setting 'mark-if-parent' set to true.
     *
     */
    'is_parent' => function ($parent) {
        $route = $this->di->get('request')->getRoute();
        return !substr_compare($parent, $route, 0, strlen($parent));
    },



   /**
     * Callback to create the url, if needed, else comment out.
     *
     */
   /*
    'create_url' => function ($url) {
        return $this->di->get('url')->create($url);
    },
    */
];
