<?php

/** 
 * Define all web routes here 
 * Format: $router->get('/path', 'ControllerName@methodName', ['MiddlewareName']);
 */

// Public Routes
$router->get('/', 'HomeController@index');
$router->get('/join', 'HomeController@join');
$router->post('/join', 'HomeController@storeMember');
$router->get('/contact', 'HomeController@contact');
$router->get('/about', 'HomeController@about');
$router->get('/contact', 'HomeController@contact');
$router->post('/contact/store', 'HomeController@storeContact');
$router->get('/organizations', 'HomeController@organizations');
$router->get('/media', 'HomeController@media');
$router->get('/youthfront', 'HomeController@youthfront');
$router->get('/kitproc', 'HomeController@kitproc');
$router->get('/kitproc/about', 'HomeController@kitprocAbout');
$router->get('/kitproc/news', 'HomeController@kitprocNews');

// API Routes
$router->get('/api/districts', 'ApiController@getDistricts');
$router->get('/api/assemblies', 'ApiController@getAssemblies');
$router->get('/api/local-bodies', 'ApiController@getLocalBodies');

// Admin Auth Routes
$router->get('/admin/login', 'AuthController@adminLogin');
$router->post('/admin/login', 'AuthController@adminAuthenticate');
$router->get('/admin/logout', 'AuthController@logout');

// Admin Dashboard Routes (Protected)
$router->get('/admin/dashboard', 'AdminController@dashboard', ['AuthMiddleware']);
$router->get('/admin/users', 'AdminController@users', ['AuthMiddleware', 'RoleMiddleware:manage_users']);
$router->post('/admin/users/add', 'AdminController@addDistrictAuthority', ['AuthMiddleware', 'RoleMiddleware:manage_users']);
$router->get('/admin/users/toggle', 'AdminController@toggleAuthorityStatus', ['AuthMiddleware', 'RoleMiddleware:manage_users']);
$router->get('/admin/users/delete', 'AdminController@deleteAuthority', ['AuthMiddleware', 'RoleMiddleware:manage_users']);
$router->post('/admin/users/update', 'AdminController@updateDistrictAuthority', ['AuthMiddleware', 'RoleMiddleware:manage_users']);
$router->post('/admin/users/change-password', 'AdminController@changeAuthorityPassword', ['AuthMiddleware', 'RoleMiddleware:manage_users']);

$router->get('/admin/roles', 'AdminController@roles', ['AuthMiddleware', 'RoleMiddleware:manage_roles']);
$router->post('/admin/roles/update-permissions', 'AdminController@updateRolePermissions', ['AuthMiddleware', 'RoleMiddleware:manage_roles']);
$router->get('/admin/subdistricts', 'AdminController@subdistricts', ['AuthMiddleware']);

// Content Management Routes
$router->get('/admin/content', 'ContentController@index', ['AuthMiddleware', 'RoleMiddleware:manage_content']);
$router->get('/admin/content/create', 'ContentController@create', ['AuthMiddleware', 'RoleMiddleware:manage_content']);
$router->post('/admin/content/create', 'ContentController@create', ['AuthMiddleware', 'RoleMiddleware:manage_content']);
$router->get('/admin/content/edit', 'ContentController@edit', ['AuthMiddleware', 'RoleMiddleware:manage_content']);
$router->post('/admin/content/edit', 'ContentController@edit', ['AuthMiddleware', 'RoleMiddleware:manage_content']);
$router->get('/admin/content/delete', 'ContentController@delete', ['AuthMiddleware', 'RoleMiddleware:manage_content']);

// Gallery Management Routes
$router->get('/admin/gallery', 'ContentController@gallery', ['AuthMiddleware', 'RoleMiddleware:manage_content']);
$router->post('/admin/gallery/add', 'ContentController@addGallery', ['AuthMiddleware', 'RoleMiddleware:manage_content']);
$router->post('/admin/gallery/edit', 'ContentController@editGallery', ['AuthMiddleware', 'RoleMiddleware:manage_content']);
$router->post('/admin/gallery/bulk-delete', 'ContentController@bulkDeleteGallery', ['AuthMiddleware', 'RoleMiddleware:manage_content']);
$router->get('/admin/gallery/delete', 'ContentController@deleteGallery', ['AuthMiddleware', 'RoleMiddleware:manage_content']);

$router->get('/admin/members', 'AdminController@members', ['AuthMiddleware', 'RoleMiddleware:manage_members']);
$router->get('/admin/members/approve', 'AdminController@approveMember', ['AuthMiddleware', 'RoleMiddleware:manage_members']);
$router->get('/admin/members/id-card', 'AdminController@idCard', ['AuthMiddleware', 'RoleMiddleware:manage_members']);

// Contact Inquiries
$router->get('/admin/contacts', 'AdminController@contacts', ['AuthMiddleware', 'RoleMiddleware:manage_members']);
$router->get('/admin/contacts/view', 'AdminController@viewContactDetails', ['AuthMiddleware', 'RoleMiddleware:manage_members']);
$router->get('/admin/contacts/delete', 'AdminController@deleteContact', ['AuthMiddleware', 'RoleMiddleware:manage_members']);

$router->get('/admin/members/view', 'AdminController@viewMemberDetails', ['AuthMiddleware', 'RoleMiddleware:manage_members']);
$router->get('/admin/members/delete', 'AdminController@deleteMember', ['AuthMiddleware', 'RoleMiddleware:manage_members']);

// Fallbacks or legacy routing handling
$router->get('/index.html', 'HomeController@index');
$router->get('/registration.php', 'HomeController@join');
$router->post('/registration.php', 'HomeController@storeMember');

