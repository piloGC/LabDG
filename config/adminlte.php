<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#61-title
    |
    */

    'title' => 'Sistema de Préstamos DG',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#62-favicon
    |
    */

    'use_ico_only' => true,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#63-logo
    |
    */

    'logo' => '<b>Laboratorio</b> DG ',
    'logo_img' => 'vendor/adminlte/dist/img/DG-logo.png',
    'logo_img_class' => 'brand-image',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'LabDG',

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#64-user-menu
    |
    */

    'usermenu_enabled' => false,
    'usermenu_header' => true,
    'usermenu_header_class' => 'bg-olive',//cambia el color
    'usermenu_image' => false,
    'usermenu_desc' => true,
    'usermenu_profile_url' => true,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#71-layout
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => true,
    'layout_fixed_footer' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#721-authentication-views-classes
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#722-admin-panel-classes
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-olive ', //elevation-4
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#73-sidebar
    |
    */

    'sidebar_mini' => true,
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#74-control-sidebar-right-sidebar
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#65-urls
    |
    */

    'use_route_url' => false,

    'dashboard_url' => '/admin',

    'logout_url' => 'logout',

    'login_url' => 'login',

    'register_url' => 'register',

    'password_reset_url' => 'password/reset',

    'password_email_url' => 'password/email',

    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#92-laravel-mix
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#8-menu-configuration
    |
    */

    'menu' => [
        [
            'text' => 'search',
            'search' => false,
            'topnav' => true,
        ],
        // [
        //     'text' => ' ',
        //     'icon' => 'fas fa-fw fa-bell',
        //     'url' => '/admin',
        //     'topnav_right' => true,
        // ],
        [
            'text'        => 'Inicio',
            'url'         => '/admin',
            'active' => ['/admin','admin/buscar*', 'regex:@^content/[0-9]+$@'],
            'icon'        => 'fas fa-fw fa-home',
        ],
        //   ['header' => 'account_settings'],
        //   [
        //       'text' => 'profile',
        //       'url'  => '/perfil',
        //       'icon' => 'fas fa-fw fa-user',
        //   ],
        // [
        //     'text' => 'change_password',
        //     'url'  => 'admin/settings',
        //     'icon' => 'fas fa-fw fa-lock',
        // ],
        
          ['header' => 'SOLICITUDES'],
          [
            'text'    => 'Solicitudes entrantes',
            'url'     => '/listarSolicitud/entrantes',
            'active' => ['listarSolicitud/entrantes', 'listarSolicitud/entrantes/buscar?solicitud=*', 'regex:@^content/[0-9]+$@'],
            'icon' => 'fas fa-fw fa-angle-right'
        ],
        [
            'text' => 'Solicitudes aprobadas',
            'url'  => 'listarSolicitud/aprobadas',
            'active' => ['listarSolicitud/aprobadas', 'listarSolicitud/aprobadas/buscar?solicitud=*', 'regex:@^content/[0-9]+$@'],
            'icon' => 'fas fa-fw fa-angle-right'
        ],
        [
            'text'    => 'Solicitudes en curso',
            'url'     => 'listarSolicitud/encursos',
            'active' => ['listarSolicitud/encursos', 'listarSolicitud/encursos/buscar?solicitud=*', 'regex:@^content/[0-9]+$@'],
            'icon' => 'fas fa-fw fa-angle-right'
        ],
        [
            'text'    => 'Solicitudes rechazadas',
            'url'     => 'listarSolicitud/rechazadas',
            'active' => ['listarSolicitud/rechazadas', 'listarSolicitud/rechazadas/buscar?solicitud=*', 'regex:@^content/[0-9]+$@'],
            'icon' => 'fas fa-fw fa-angle-right'
        ],
        [
            'text'    => 'Solicitudes canceladas',
            'url'     => 'listarSolicitud/canceladas',
            'active' => ['listarSolicitud/canceladas', 'listarSolicitud/canceladas/buscar?solicitud=*', 'regex:@^content/[0-9]+$@'],
            'icon' => 'fas fa-fw fa-angle-right'
        ],
        // [
        //     'text'    => 'Solicitudes',
        //     'icon'    => 'far fa-fw fa-file-alt',
        //     'submenu' => [
        //         [
        //             'text'    => 'Solicitudes entrantes',
        //             'url'     => '/listarSolicitud/entrantes',
        //             'icon' => 'fas fa-fw fa-angle-right'
        //         ],
        //         [
        //             'text' => 'Solicitudes aprobadas',
        //             'url'  => 'listarSolicitud/aprobadas',
        //             'icon' => 'fas fa-fw fa-angle-right'
        //         ],
        //         [
        //             'text'    => 'Solicitudes rechazadas',
        //             'url'     => 'listarSolicitud/rechazadas',
        //             'icon' => 'fas fa-fw fa-angle-right'
        //         ],
        //     ],
        // ],
        //  ['header' => 'Equipos'],
         [
             'text'       => 'Generar solicitud',
             'icon'    => 'fas fa-fw fa-file-alt',
             'url'        => 'listarSolicitud/create',
         ],
         [
            'text'       => 'Control sanción',
            'icon'    => 'fas fa-fw fa-times-circle',
            'url'        => '/sanciones',
        ],
        [
            'text'    => 'Administración',
            'icon'    => 'fas fa-fw fa-cog',
            'submenu' => [
                [
                    'text' => 'Prestamos',
                    'url'  => 'prestamos',
                    'icon' => 'fas fa-fw fa-angle-right'
                ],
                [
                    'text' => 'Control equipos',
                    'icon' => 'fas fa-fw fa-angle-right',
                    'submenu'=>[
                        [
                            'text' => 'Equipos',
                            'url'  => 'equipos',
                            'icon' => 'fas fa-fw fa-genderless'
                        ],
                        [   
                            'text' => 'Existencias',
                            'url'  => 'existencias',
                            'active' => ['existencias','existencias/buscar*', 'regex:@^content/[0-9]+$@'],
                            'icon' => 'fas fa-fw fa-genderless'
                        ],
                    ],
                ],
                [
                    'text' => 'Control salas',
                    'icon' => 'fas fa-fw fa-angle-right',
                    'submenu' =>[
                        [
                            'text' => 'Salas',
                            'url'  => 'salas',
                            'icon' => 'fas fa-fw fa-genderless'
                        ],
                        [
                            'text' => 'Reservas',
                            'url'  => 'reservas',
                            'active' => ['reservas','reservas/buscar*', 'regex:@^content/[0-9]+$@'],
                            'icon' => 'fas fa-fw fa-genderless'
                        ],
                        
                    ],
                ],
                
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#83-custom-menu-filters
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#91-plugins
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For more detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/#93-livewire
    */

    'livewire' => false,
];
