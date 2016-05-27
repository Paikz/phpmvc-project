<?php
/**
 * Config-file for navigation bar.
 *
 */

 if (isset($_SESSION['user'])) {
     $loginText  = "Log out" . "(" . $_SESSION['user']['username'] . ")";
     $loginUrl   = $this->di->get('url')->create('Logout');
     $loginTitle = "Log out";
 } else {
     $loginText  = "Login";
     $loginUrl   = $this->di->get('url')->create('Login');
     $loginTitle = "Login";
 }

return [

    // Use for styling the menu
    'class' => 'navbar',

    // Here comes the menu strcture
    'items' => [

        // This is a menu item
        'Home'  => [
            'text'  => 'Home',
            'url'   => $this->di->get('url')->create(''),
            'title' => 'Home route of current frontcontroller'
        ],

        // This is a menu item
        'Questions' => [
            'text'  =>'Questions',
            'url'   => $this->di->get('url')->create('Questions'),
            'title' => 'Url to relative frontcontroller, other file',
        ],

        // This is a menu item
        'Tags' => [
            'text'  =>'Tags',
            'url'   => $this->di->get('url')->create('Tags'),
            'title' => 'Internal route within this frontcontroller'
        ],

        'Users' => [
            'text'  =>'Users',
            'url'   => $this->di->get('url')->create('Users'),
            'title' => 'Url to relative frontcontroller, other file'
        ],

        'About' => [
            'text'  =>'About',
            'url'   => $this->di->get('url')->create('About'),
            'title' => 'Url to relative frontcontroller, other file'
        ],

        'Login' => [
          'text'  => $loginText,
          'url'   => $loginUrl,
          'title' => $loginTitle
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
