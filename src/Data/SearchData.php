<?php

namespace App\Data;

use App\Entity\Level;
use App\Entity\Type;
use App\Entity\Language;

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

    /**
     * @var Language[]
     */
    public $languages = [];
}
