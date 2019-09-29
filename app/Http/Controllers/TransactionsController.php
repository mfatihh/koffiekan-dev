<?php

namespace App\Http\Controllers;

use PDF;
use App\Transaction;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public $items = [];

    public $customer = ['name' => null, 'phone' => null];
    public $notes;
    public $payment;

    public function index(Request $request)
    {
        $data['sidebar'] = 'transactions';
        $transactions = Transaction::orderBy('id', 'desc')->paginate(5);

        return view('transactions.index', compact('data','transactions'));
    }

    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    public function receipt(Transaction $transaction)
    {
        //return view('transactions.receipt', compact('transaction'));
        $pdf = PDF::loadView('transactions.pdfalamat', compact('transaction'));

        return $pdf->setPaper('a5')->stream($transaction->invoice_no.'.alamat.pdf');
    }

    public function pdf(Transaction $transaction)
    {
        // return view('transactions.pdf', compact('transaction'));
        $pdf = PDF::loadView('transactions.pdf', compact('transaction'));

        return $pdf->setPaper('a5')->stream($transaction->invoice_no.'.faktur.pdf');
    }
}
