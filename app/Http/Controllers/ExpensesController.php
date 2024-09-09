<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseRequest;
use Illuminate\Http\Request;
use App\Models\Expenses;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class ExpensesController extends Controller
{
    public function index(Request $request): jsonResponse
    {
        $validated = $request->validate([
            'year' => 'required|numeric|digits:4',
            'month' => 'required|numeric|between:1,12',
        ]);

        $year = $validated['year'];
        $month = $validated['month'];

        try {
            $listExpenses = Expenses::whereYear('due_date', $year)->whereMonth('due_date', $month)->with('category')->get();

            if ($listExpenses->isEmpty()) {
                return response()->json(null, 204);
            }
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Erro inesperado no Servidor',
                'message' => 'Detalhes do erro: ' . $e->getMessage()
            ], 500);
        }

        return response()->json($listExpenses);
    }

    public function store(ExpenseRequest $request): jsonResponse
    {
        try {
            $validated = $request->validated();
            Expenses::create($validated);
            return response()->json(['Message' => 'Expense registered successfully'], 201);
        } catch (Exception $e) {
            return response()->json(['Message' => $e->getMessage()], 500);
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            $expense = Expenses::findOrFail($id);
            return response()->json(['Message' => $expense], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['Error' => 'Id Not Found'], 404);
        } catch (Exception $e) {
            return response()->json(['Error' => 'Unexpected error in server.', 'Message' => $e->getMessage()], 500);
        }
    }

    public function update(ExpenseRequest $request, int $id): JsonResponse
    {
        try {
            $expense = Expenses::findOrFail($id);
            $validated = $request->validated();
            $expense->update($validated);
            return response()->json(['Message' => 'Expense updated successfully']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['Message' => 'Id Not Found'], 404);
        } catch (Exception $e) {
            return response()->json(['Message' => $e->getMessage()], 500);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $expenses = Expenses::findOrfail($id);
            $expenses->delete();
            return response()->json(['Message' => 'Expense removed successfully']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['Message' => 'Id Not Found'], 404);
        } catch (Exception $e) {
            return response()->json(['Message' => 'Failed to remove expense', 'Details' => $e->getMessage()], 500);
        }
    }
}
