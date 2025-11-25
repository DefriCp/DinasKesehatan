<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Shield Resource (menu manajemen permission)
    |--------------------------------------------------------------------------
    */
    'shield_resource' => [
        'should_register_navigation' => true,

        // URL dasar untuk halaman Shield (misal: /admin/shield/roles)
        'slug' => 'shield/roles',

        'navigation_sort' => -1,
        'navigation_badge' => true,

        // TARUH di grup "Manajemen Akses" biar gabung dengan Users
        'navigation_group' => 'Manajemen Akses',

        'sub_navigation_position' => null,
        'is_globally_searchable' => false,
        'show_model_path' => false,

        // Tidak pakai multi-tenant
        'is_scoped_to_tenant' => false,

        'cluster' => null,
    ],

    /*
    |--------------------------------------------------------------------------
    | Tenant (tidak dipakai)
    |--------------------------------------------------------------------------
    */
    'tenant_model' => null,

    /*
    |--------------------------------------------------------------------------
    | Model user yang dipakai untuk auth
    |--------------------------------------------------------------------------
    */
    'auth_provider_model' => [
        'fqcn' => App\Models\User::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Super Admin (ROLE YANG BISA SEGALANYA)
    |--------------------------------------------------------------------------
    |
    | User yang mempunyai role ini akan bypass semua permission.
    | Jadi kalau tidak mau user tertentu bisa akses semuanya,
    | JANGAN berikan role "super_admin" ke user tersebut.
    |
    */
    'super_admin' => [
        'enabled' => true,
        'name' => 'super_admin',
        'define_via_gate' => false,
        'intercept_gate' => 'before', // biarkan "before"
    ],

    /*
    |--------------------------------------------------------------------------
    | Panel User (role dasar untuk user panel) – DIMATIKAN
    |--------------------------------------------------------------------------
    |
    | Supaya tidak ada role ekstra yang otomatis diberi izin.
    |
    */
    'panel_user' => [
        'enabled' => false,
        'name' => 'panel_user',
    ],

    /*
    |--------------------------------------------------------------------------
    | Prefix permission
    |--------------------------------------------------------------------------
    */
    'permission_prefixes' => [
        'resource' => [
            'view',
            'view_any',
            'create',
            'update',
            'restore',
            'restore_any',
            'replicate',
            'reorder',
            'delete',
            'delete_any',
            'force_delete',
            'force_delete_any',
        ],

        'page' => 'page',
        'widget' => 'widget',
    ],

    /*
    |--------------------------------------------------------------------------
    | Entity apa saja yang digenerate permission-nya
    |--------------------------------------------------------------------------
    */
    'entities' => [
        'pages' => true,
        'widgets' => true,
        'resources' => true,
        'custom_permissions' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Generator (policy & permission)
    |--------------------------------------------------------------------------
    */
    'generator' => [
        'option' => 'policies_and_permissions',
        'policy_directory' => 'Policies',
        'policy_namespace' => 'Policies',
    ],

    /*
    |--------------------------------------------------------------------------
    | Exclude (tidak dibuat permission-nya)
    |--------------------------------------------------------------------------
    */
    'exclude' => [
        'enabled' => true,

        'pages' => [
            'Dashboard',
        ],

        'widgets' => [
            'AccountWidget',
            'FilamentInfoWidget',
        ],

        'resources' => [],
    ],

    /*
    |--------------------------------------------------------------------------
    | Discovery (auto discover semua resource/page/widget)
    |--------------------------------------------------------------------------
    */
    'discovery' => [
        'discover_all_resources' => false,
        'discover_all_widgets' => false,
        'discover_all_pages' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Otomatis register policy untuk Role model
    |--------------------------------------------------------------------------
    */
    'register_role_policy' => [
        'enabled' => true,
    ],

];
