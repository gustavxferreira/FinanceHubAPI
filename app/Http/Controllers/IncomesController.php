<?php

// app/Http/Controllers/IncomesController.php

namespace App\Http\Controllers;

use App\Http\Requests\IncomesRequest;
use Illuminate\Http\Request;
use App\Models\Incomes;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class IncomesController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $validate = $request->validate([
            'year' => 'required|numeric|digits:4',
            'month' => 'required|numeric|between:1,12',
            'invoiceDateReference' => 'required|string',
        ]);

        $year = $validate['year'];
        $month = $validate['month'];
        $invoiceDateReference = $validate['invoiceDateReference'];

        try {
            $listIncomes = Incomes::whereYear($invoiceDateReference, $year)->whereMonth($invoiceDateReference, $month)->get();

            if ($listIncomes->isEmpty()) {
                return response()->json([], 200);
            }

            return response()->json($listIncomes);
        } catch (Exception $e) {
            return response()->json(['message' => 'Nenhum registro encontrado'], 404);
        }
    }


    public function store(IncomesRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();
            Incomes::create($validated);
            return response()->json(['Message' => 'Incomes registered successfully']);
        } catch (Exception $e) {
            return response()->json(['Error' => $e->getMessage()], 500);
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            $incomes = Incomes::findOrFail($id);
            return response()->json(['Message' => $incomes], 200);
        } catch (Exception $e) {
            return response()->json(['Error' => $e->getMessage()], 500);
        }
    }


    public function update(int $id, IncomesRequest $request)
    {
        try {
            $incomes = Incomes::findOrFail($id);
            $validated = $request->validated();
            $incomes->update($validated);
            return response()->json(['Message' => 'Incomes updated successfully']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['Message' => 'Id Not Found'], 404);
        } catch (Exception $e) {
            return response()->json(['Message' => $e->getMessage()], 500);
        }
    }

    public function destroy(int $id): jsonResponse
    {
        try {
            $incomes = Incomes::findOrFail($id);
            $incomes->delete();
            return response()->json(['Message' => 'Incomes removed successfully']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['Message' => 'Id Not Found'], 404);
        } catch (Exception $e) {
            return response()->json(['Message' => 'Failed to remove expense', 'Details' => $e->getMessage()], 500);
        }
    }
}
