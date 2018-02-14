<?php

namespace LmsPlugin;

use FishyMinds\WordPress\Plugin\HasPlugin;
use FishyMinds\WordPress\Plugin\Plugin;

class Profile
{
    use HasPlugin;

    const DEFAULT_FIELDS = [
        [
            'name' => 'Full name',
            'slug' => 'full-name',
            'type' => 'text',
            'required' => true,
            'standard' => true
        ], [
            'name' => 'Email',
            'slug' => 'email',
            'type' => 'mail',
            'required' => true,
            'standard' => true
        ], [
            'name' => 'Password',
            'slug' => 'password',
            'type' => 'password',
            'required' => true,
            'standard' => true
        ]
    ];

    protected $plugin;
    private $fields = [];

    public function __construct(Plugin $plugin)
    {
        $this->plugin = $plugin;
        $this->fields = $plugin->getOption('profile_fields', self::DEFAULT_FIELDS);
    }

    public function getFields()
    {
        return $this->fields;
    }

    public function reorderFields($order)
    {
        $this->fields = array_combine($order, $this->fields);
        ksort($this->fields);

        return $this;
    }

    public function getField($id)
    {
        return array_get($this->fields, $id);
    }

    public function addField($data)
    {
        $data['slug'] = kebab_case($data['name']);

        $this->fields[] = $data;

        return count($this->fields) - 1;
    }

    public function updateField($id, $data)
    {
        $this->fields[$id] = $data;
    }

    public function deleteField($id)
    {
        return array_splice($this->fields, $id, 1);
    }

    public function save()
    {
        $this->plugin->setOption('profile_fields', $this->fields);
    }
}