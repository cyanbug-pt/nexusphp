<?php

namespace App\Http\Controllers;

use App\Http\Resources\SearchBoxResource;
use App\Repositories\SearchBoxRepository;
use Illuminate\Http\Request;

class SearchBoxController extends Controller
{
    private $repository;

    public function __construct(SearchBoxRepository $repository)
    {
        $this->repository = $repository;
    }

}
