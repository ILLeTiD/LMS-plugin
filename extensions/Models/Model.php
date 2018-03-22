<?php

namespace LmsPlugin\Models;

use FishyMinds\QueryBuilder;

abstract class Model
{
    protected $attributes;

    /**
     * @param array $conditions
     *
     * @return \FishyMinds\QueryBuilder
     */
    public static function __callStatic($name, $arguments)
    {
        $query_builder = new QueryBuilder(static::TABLE, static::class);

        return call_user_func_array([$query_builder, $name], $arguments);
    }

    public static function find($id)
    {
        $query_builder = new QueryBuilder(static::TABLE, static::class);

        return $query_builder->where(['id' => $id])->get()->first();
    }

    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    public function __get($name)
    {
        return $this->attributes[$name];
    }

    public function save()
    {
        return ! empty($this->attributes['id']) ? $this->update() : $this->insert();
    }

    public function delete()
    {
        global $wpdb;

        if (empty($this->attributes['id'])) {
            return false;
        }

        $deleted = $wpdb->delete(
            $wpdb->prefix . static::TABLE, 
            ['id' => $this->attributes['id']], 
            ['%d']
        );

        return !! $deleted;
    }    
}