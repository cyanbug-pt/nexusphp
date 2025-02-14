<?php

namespace App\Http\Controllers;

use App\Http\Resources\SearchBoxResource;
use App\Repositories\SearchBoxRepository;
use App\Repositories\UploadRepository;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    private $repository;

    private $searchBoxRepository;

    public function __construct(UploadRepository $repository, SearchBoxRepository $searchBoxRepository)
    {
        $this->repository = $repository;
        $this->searchBoxRepository = $searchBoxRepository;
    }

    public function sections(Request $request)
    {
        $sections = $this->searchBoxRepository->listSections();
        $resource = SearchBoxResource::collection($sections);
        return $this->success($resource);
    }

}
