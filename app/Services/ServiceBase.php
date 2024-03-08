<?php

namespace App\Services;

use App\Adapters\Aws\AwsSns;

class ServiceBase
{
    private AwsSns $awsSns;

    public function __construct(AwsSns $awsSns){
        $this->awsSns = $awsSns;
    }

    public function getAwsnSns()
    {
        return $this->awsSns;
    }
}
