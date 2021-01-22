<?php
$aclModuleStore = [
    'rules' => [
        'module_name' => 'required|string|max:250',
        'module_path' => 'required|unique:acl_modules',
        'module_description' => 'required',
        'acl_menus_id' => 'required'
    ],
    'messages' => [
        'module_name.required' => 'Module Name is required!',
        'module_path.required' => 'Module Path is required!',
        'acl_menus_id.required' => 'Please select menu!',
        'module_description.required' => 'Module Description is required'
    ]
];

$aclModuleUpdate = [
    'rules' => [
        'module_name' => 'required|string|max:250',
        'module_path' => 'required|unique:acl_modules,id',
        'acl_menus_id' => 'required',
        'module_description' => 'required',

    ],
    'messages' => [
        'module_name.required' => 'Module Name is required!',
        'module_path.required' => 'Module Path is required!',
        'acl_menus_id.required' => 'Please select menu!',
        'module_description.required' => 'Module Description is required'
    ],
    'extra' => 'PUT_PATCH'
];

$userRoleStore = [
    'rules' => [
        'role_name' => 'required|string|max:250|unique:acl_role'
    ],
    'messages' => [
        'role_name.required' => 'Role Name is required!'
    ]
];

$userRoleUpdate = [
    'rules' => [
        'role_name' => 'required|string|max:250|unique:acl_role,id'
    ],
    'messages' => [
        'role_name.required' => 'Role Name is required!',
        'role_name.unique' => 'Role Name is must be unique!'
    ]
];

return [
    'acl-modules_store' => $aclModuleStore,
    'acl-modules_update' => $aclModuleUpdate,
    'roles_store' => $userRoleStore,
    'roles_update' => $userRoleUpdate,
    'PAGINATION' => 5
];
