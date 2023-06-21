<?php

namespace App\Repositories\Site;

use App\Repositories\Repository;

abstract class BaseRepository extends Repository
{
    public function get($columns = ['*'])
    {
        return $this->query()->get($columns);
    }

    public function findOrFail($id)
    {
        return $this->query()->findOrFail($id);
    }

    public function find($id)
    {
        return $this->query()->find($id);
    }

    public function findBy($field, $value, $columns = ['*'])
    {
        return $this->query()->where($field, $value)->first($columns);
    }

    public function create($data)
    {
        return $this->query()->create($data);
    }

    public function update($item, $data)
    {
        return $item->update($data);
    }

    public function forceCreate($data)
    {
        $item = $this->getModel()->newInstance();

        $item->forceFill($data);

        $item->save();

        return $item;
    }

    public function forceUpdate($item, $data)
    {
        $item->forceFill($data);

        $item->save();

        return $item;
    }

    public function __call($method, $args)
    {
        return call_user_func_array(
            [$this->getModel(), $method],
            $args
        );
    }

}
