<?php

namespace App\Services;

use App\Models\Domain;


class DomainService
{
    public function update(array $data)
    {
        foreach ($data as $id => $item) {
            $domain = Domain::findOrFail($id);
            foreach($item as $key => $value)
            {
                $domain->$key = $value;
            }
            $domain->save();
        }
    }

    public function create()
    {
        $domain = new Domain();
        $domain->user_id = auth()->user()->id;
        $domain->save();
    }
}