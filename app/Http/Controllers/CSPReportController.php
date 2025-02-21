<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CSPReportController extends Controller
{
    /**
     * Handle the incoming CSP violation report.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handleReport(Request $request)
    {
        Log::error('CSP Violation Report:', $request->all());

        return response()->json([], 204);
    }
}