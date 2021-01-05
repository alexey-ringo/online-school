<?php
declare(strict_types=1);

namespace App\Users\DataTransfer;


class UserDataTransfer
{
    public $lastName;
    public $firstName;
    public $middleName;
    public $age;
    public $phone;
    public $employ;
    public $privileges;

    /**
     * UserDataTransfer constructor.
     * @param array $array
     */
    public function __construct(array $array)
    {
        $this->initialize($array);
    }

    private function initialize(array $array): void
    {
        foreach($array as $key => $val) {
            if(property_exists($this, $key)) {
                $this->{$key} = $val;
            }
        }
    }
}