<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        return response()->json(Transaction::all());
    }

    public function show($id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json($transaction);
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'amount' => 'required|numeric',
            'category' => 'required|string',
            'transaction_date' => 'required|date'
        ]);

        $transaction = Transaction::create($request->all());

        return response()->json($transaction, 201);
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $transaction->update($request->all());

        return response()->json($transaction);
    }

    public function destroy($id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $transaction->delete();

        return response()->json(['message' => 'Deleted']);
    }
}