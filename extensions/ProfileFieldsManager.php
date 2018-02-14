<?php

namespace LmsPlugin;

use FishyMinds\WordPress\Plugin\Plugin;

class ProfileFieldsManager
{
    protected $plugin;
    private $fields = [];

    public function __construct(Plugin $plugin)
    {
        $this->plugin = $plugin;
        $this->fields = $plugin->getOption('profile_fields', Profile::DEFAULT_FIELDS);
    }

    public function get($id = null)
    {
        return is_null($id) ? $this->fields : array_get($this->fields, $id);
    }

    public function add($data)
    {
        $this->fields[] = $data;

        return count($this->fields) - 1;
    }

    public function update($id, $data)
    {
        $this->fields[$id] = $data;
    }

    public function delete($id)
    {
        return array_splice($this->fields, $id, 1);
    }

    public function reorder($order)
    {
        $this->fields = array_combine($order, $this->fields);
        ksort($this->fields);

        return $this;
    }

    public function save()
    {
        foreach ($this->fields as &$field) {
            $field['slug'] = kebab_case($field['name']);
        }

        $this->plugin->setOption('profile_fields', $this->fields);
    }
}