<?php

namespace App\Http\Controllers\Documents;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocumentsController extends Controller
{
    public function downloadStatut()
    {
        $filePath = public_path('/documents/statut.pdf');
        return response()->download($filePath, 'statut.pdf');
    }
}
