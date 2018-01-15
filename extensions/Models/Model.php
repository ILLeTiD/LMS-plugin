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
    public static function where($conditions)
    {
        $query_builder = new QueryBuilder(static::TABLE, static::class);

        return $query_builder->where($conditions);
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
}