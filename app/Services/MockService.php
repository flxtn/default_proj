<?php

namespace App\Services;

class MockService
{

    public function getData()
    {
        $data = [[
            'domain' => 'localhost',
            'description' => 'description of domain',
            'requests' => 100,
            'hosting' => 'Shared',
            'status' => 'Active',
            'actions' => "Delete"
        ],];

        return $data;
    }

}

?>