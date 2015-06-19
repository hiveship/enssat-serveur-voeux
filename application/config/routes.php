<?php
defined( 'BASEPATH' ) or exit( 'No direct script access allowed' );

/*
 * | -------------------------------------------------------------------------
 * | URI ROUTING
 * | -------------------------------------------------------------------------
 * | This file lets you re-map URI requests to specific controller functions.
 * |
 * | Typically there is a one-to-one relationship between a URL string
 * | and its corresponding controller class/method. The segments in a
 * | URL normally follow this pattern:
 * |
 * | example.com/class/method/id/
 * |
 * | In some instances, however, you may want to remap this relationship
 * | so that a different class/function is called than the one
 * | corresponding to the URL.
 * |
 * | Please see the user guide for complete details:
 * |
 * | http://codeigniter.com/user_guide/general/routing.html
 * |
 * | -------------------------------------------------------------------------
 * | RESERVED ROUTES
 * | -------------------------------------------------------------------------
 * |
 * | There are three reserved routes:
 * |
 * | $route['default_controller'] = 'welcome';
 * |
 * | This route indicates which controller class should be loaded if the
 * | URI contains no data. In the above example, the "welcome" class
 * | would be loaded.
 * |
 * | $route['404_override'] = 'errors/page_missing';
 * |
 * | This route will tell the Router which controller/method to use if those
 * | provided in the URL cannot be matched to a valid route.
 * |
 * | $route['translate_uri_dashes'] = FALSE;
 * |
 * | This is not exactly a route, but allows you to automatically route
 * | controller and method names that contain dashes. '-' isn't a valid
 * | class or method name character, so it requires translation.
 * | When you set this option to TRUE, it will replace ALL dashes in the
 * | controller and method URI segments.
 * |
 * | Examples: my-controller/index -> my_controller/index
 * | my-controller/my-method -> my_controller/my_method
 */
$route ['default_controller'] = 'Module_controller';
$route ['404_override'] = '';
$route ['translate_uri_dashes'] = FALSE;

$route ['login'] = "Site_controller/index";
$route ['auth'] = "Site_controller/login";
$route ['logout'] = "Site_controller/logout";

$route ['admin/enseignants'] = "admin/Enseignant_controller/index";
$route ['admin/enseignants/create'] = 'admin/Enseignant_controller/create';
$route ['admin/enseignants/delete/(:any)'] = 'admin/Enseignant_controller/delete/$1';
$route ['admin/enseignants/edit/(:any)'] = 'admin/Enseignant_controller/edit/$1';
$route ['admin/enseignants/get'] = 'admin/Enseignant_controller/get/';
$route ['admin/enseignants/inscrire_force/(:any)/(:any)'] = 'admin/Enseignant_controller/inscrire_force/$1/$2';

$route ['enseignants'] = "Enseignant_controller/index";
$route ['enseignants/edit'] = 'Enseignant_controller/edit';
$route ['enseignants/update'] = 'Enseignant_controller/update';
$route ['enseignants/get'] = 'Enseignant_controller/get';
$route ['enseignants/edit/password'] = 'Enseignant_controller/change_password';
$route ['enseignants/cours_de/(:any)'] = 'Enseignant_controller/cours_de/$1';

$route ['cours'] = "Module_controller/index";
$route ['admin/cours'] = "admin/Module_controller/get";
$route ['admin/cours/create/(:any)'] = "admin/Cours_controller/create/$1";
$route ['admin/cours/edit/(:any)/(:any)'] = "admin/Cours_controller/edit/$1/$2";
$route ['admin/cours/delete/(:any)/(:any)'] = "admin/Cours_controller/delete/$1/$2";

$route ['admin/module/create'] = "admin/Module_controller/create";
$route ['admin/module/edit/(:any)'] = "admin/Module_controller/edit/$1";
$route ['admin/module/update/(:any)'] = "admin/Module_controller/update/$1";
$route ['admin/module/delete/(:any)'] = "admin/Module_controller/delete/$1";

$route ['admin/decharges'] = "admin/Decharge_controller/index";
$route ['decharges'] = "Decharge_controller/index";
$route ['decharges/create'] = "Decharge_controller/create";
$route ['decharges/ajax_get_motif'] = "Decharge_controller/ajax_get_motif";
$route ['decharges/update_motif/(:any)'] = "Decharge_controller/update_motif/$1";
$route ['decharges/delete/(:any)'] = "Decharge_controller/delete/$1";

$route ['csv/download'] = "CSV_controller/create_csv";

