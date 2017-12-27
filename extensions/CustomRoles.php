<?php

namespace LmsPlugin;


use FishyMinds\WordPress\Plugin\HasPlugin;

class CustomRoles
{
    use HasPlugin;

    public static function roles()
    {
        return [
            'backoffice' => [
                'label' => __('Backoffice', 'lms-plugin'),
                'capabilities' => [
                    'read' => true,
                    'level_0' => true
                ]
            ],
            'technicians' => [
                'label' => __('Technicians', 'lms-plugin'),
                'capabilities' => [
                    'read' => true,
                    'level_0' => true
                ]
            ],
            'sales' => [
                'label' => __('Sales', 'lms-plugin'),
                'capabilities' => [
                    'read' => true,
                    'level_0' => true
                ]
            ]
        ];
    }

    public function add()
    {
        foreach (self::roles() as $name => $role) {
            add_role($name, $role['label'], $role['capabilities']);
        }
    }

    public function remove()
    {
        foreach (self::roles() as $name => $role) {
            if (get_role($name)) {
                remove_role($name);
            }
        }
    }
}