<?php

interface repository_interface
{
    public function getAll();
    public function findById($id);
    public function store(array $data);
    public function update($id, array $data);
    public function destroy($id);
}