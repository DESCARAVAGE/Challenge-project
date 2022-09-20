<?php

namespace App\Data;

use App\Entity\Level;
use App\Entity\Type;

class SearchData
{
    /**
     * @var string
     */
    public $sendSearch = '';

    /**
     * @var Type[]
     */
    public $types = [];

    /**
     * @var Level[]
     */
    public $levels = [];
}
