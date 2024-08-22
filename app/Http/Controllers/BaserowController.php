<?php

namespace App\Http\Controllers;

use App\Services\BaserowService;
use Illuminate\Http\Request;

class BaserowController extends Controller
{
    protected $baserowService;

    public function __construct(BaserowService $baserowService)
    {
        $this->baserowService = $baserowService;
    }

    public function index()
    {
        $databaseId = 123451;
        $tableId = 321853;
        $tableData = $this->baserowService->getTableData($tableId);
        dd($tableData);
        return view('baserow.index', compact('tables'));
    }

    public function show($tableId)
    {
        $tableData = $this->baserowService->getTableData($tableId);
        return view('baserow.show', compact('tableData'));
    }
}
