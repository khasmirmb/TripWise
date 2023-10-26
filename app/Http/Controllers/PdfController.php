<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function generate()
    {
        $pdf = Pdf::loadView('components.pdf');
        return $pdf->stream();
    }
}
