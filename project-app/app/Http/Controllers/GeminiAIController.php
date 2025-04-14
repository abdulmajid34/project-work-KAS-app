<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GeminiAIService;

class GeminiAIController extends Controller
{
    protected $geminiAIService;

    public function __construct(GeminiAIService $geminiAIService)
    {
        $this->geminiAIService = $geminiAIService;
    }

    public function analyze(Request $request)
    {
        $request->validate([
            'text' => 'required|string',
        ]);

        // try {
        //     $result = $this->geminiAIService->analyzeText($request->input('text'));
        //     return view('geminiAI', ['result' => $result]);
        // } catch (\Exception $e) {
        //     return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        // }

        try {
            $result = $this->geminiAIService->analyzeText($request->input('text'));

            // Check if it's an AJAX request
            if ($request->ajax()) {
                return response()->json(['success' => true, 'result' => $result]);
            }

            return view('geminiAI', ['result' => $result]);
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
            }
            return back()->with('error', $e->getMessage());
        }
    }
}
