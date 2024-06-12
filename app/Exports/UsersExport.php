<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Database\Eloquent\Collection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $users;

    public function __construct($users)
    {
        $this->users = $users;
    }
    public function collection()
    {
        $data[]=[
            "نام ",
            "همراه",
        ];
        foreach( $this->users as $user){
            $data[]=[
                'name'=>$user->name,
                'mobile'=>$user->mobile,
            ];

        }

        return new Collection($data);
    }
}
