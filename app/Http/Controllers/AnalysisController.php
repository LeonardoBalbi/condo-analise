<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AnalysisController extends Controller
{
    /**
     * Show the upload form.
     */
    public function index()
    {
        return view('analysis.index');
    }

    /**
     * Process the uploaded file and send it to the Python API.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,csv|max:10240', // Max 10MB
        ]);

        $file = $request->file('file');
        
        // URL of the Python API (FastAPI)
        // In HostGator, this should be the URL where the Python app is accessible.
        $apiUrl = env('PYTHON_API_URL', 'http://127.0.0.1:8001/analisar');

        try {
            // Attach the file and send POST request to the Python API
            $response = Http::attach(
                'file', 
                file_get_contents($file->getRealPath()), 
                $file->getClientOriginalName()
            )->post($apiUrl);

            if ($response->successful()) {
                // Proxy the file download back to the user
                return response($response->body())
                    ->header('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
                    ->header('Content-Disposition', 'attachment; filename="analise_condominio.xlsx"');
            }

            return back()->with('error', 'A API de análise retornou um erro: ' . $response->status());
        } catch (\Exception $e) {
            return back()->with('error', 'Não foi possível conectar à API de análise: ' . $e->getMessage());
        }
    }
}
