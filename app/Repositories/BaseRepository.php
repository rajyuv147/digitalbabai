<?php
/**
 * Created by PhpStorm.
 * User: Nimace
 * Date: 07-Dec-18
 * Time: 13:12
 */

namespace App\Repositories;

class BaseRepository implements InterfaceRepository
{
    public function query()
    {
        return call_user_func(static::Model . '::query');
    }

    public function all()
    {
        return $this->query()->latest()->get();
    }

    public function count()
    {
        return $this->query()->count();
    }

    public function create(array $data)
    {
        return $this->query()->create($data)->id;
    }

    public function update(array $data, $id)
    {
        $record = $this->show($id);
        return $record->update($data);
    }

    public function delete($id)
    {
        return $this->show($id)->delete();
    }

    public function show($id)
    {
        return $this->query()->findOrFail($id);
    }
}
