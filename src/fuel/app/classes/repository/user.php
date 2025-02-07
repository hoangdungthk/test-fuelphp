<?php

class repository_user implements \repository_interface
{
    public function getAll()
    {
        return array_values(Model_User::find('all'));
    }

    public function findById($id)
    {
        return Model_User::find($id);
    }

    public function store(array $data)
    {
        $user = Model_User::forge($data);
        return $user->save() ? $user : false;
    }

    public function update($id, array $data)
    {
        $user = Model_User::find($id);
        if (!$user) return false;
        $user->set($data);
        return $user->save() ? $user : false;
    }

    public function destroy($id)
    {
        $user = Model_User::find($id);
        return $user ? $user->delete() : false;
    }
}
