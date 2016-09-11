<?php

use Core\Router;

# Homepage
Router::get('accueil',[
    "controller" => 'pages',
    "action"     => 'index',
]);

# Contact page
Router::any('me-contacter', [
    "controller" => 'pages',
    "action"     => 'contact'
]);

# About page
Router::get('a-propos', [
    "controller" => 'pages',
    "action"     => 'about'
]);

# Works page
Router::get('realisations', [
    "controller" => 'works',
    "action"     => 'index'
]);

# Log in
Router::get('connect', [
    "controller" => 'users',
    "action"     => 'connect'
]);

/**--------------------------
 * ADMIN
--------------------------*/

# Edit a work
Router::post('edit/work/{slug}', [
    "controller" => 'works',
    "action"     => 'edit',
    "prefixe"    => 'admin',
    "params"     => [
        "slug"  => '/[a-zA-Z\-]/'
    ]
]);

# Delete a work
Router::get('delete/work/{slug}', [
    "controller" => 'works',
    "action"     => 'delete',
    "prefixe"    => 'admin',
    "params"     => [
        "slug"  => '/[a-zA-Z\-]/'
    ]
]);

# Add a work
Router::post('add/work', [
    "controller" => 'works',
    "action"     => 'add',
    "prefixe"    => 'admin',
]);

# Récupère un work
Router::get('get/work/{slug}', [
    "controller" => 'works',
    "action"     => 'getDescription',
    "prefixe"    => 'admin',
    "params"     => [
        "slug"  => '/[a-zA-Z\-]/'
    ]
]);