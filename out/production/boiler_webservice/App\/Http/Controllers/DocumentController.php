<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class DocumentController extends Controller
{
    public function index(): JsonResponse
    {
        $caca = Document::paginate(10);
        return Response::json($caca);
    }
}
