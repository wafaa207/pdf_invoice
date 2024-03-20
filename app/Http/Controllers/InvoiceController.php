<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvoiceRequest;
use App\Models\Company;
use App\Models\Invoice;
use App\Models\InvoiceItems;
use App\Models\User;
use Dompdf\Dompdf;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::paginate(10);
        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $companies = Company::get();
        $users = User::get();

        return view('invoices.create', compact('companies', 'users'));
    }

    /**
     * Store a newly created resource in storage.
    */

    public function store(StoreInvoiceRequest $request)
    {
        $subtotal = 0;
        foreach ($request->price as $key => $price) {
            $subtotal += $price * $request->qty[$key];
        }

        $total = $subtotal + $request->input('tax', 0) - $request->input('discount', 0);

        $depositRequested = $total * 0.1;

        $depositDue = $depositRequested;

        $invoice = Invoice::create([
            'number' => 'INV_' . str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT),
            'company_id' => $request->company_id,
            'user_id' => $request->user_id,
            'date_issued' => $request->date_issued,
            'due_date' => $request->due_date,
            'discount' => $request->discount ?? 0,
            'tax' => $request->input('tax', 0),
            'subtotal' => $subtotal,
            'total' => $total,
            'deposit_requested' => $depositRequested,
            'deposit_due' => $depositDue,
        ]);

        foreach ($request->description as $key => $description) {
            InvoiceItems::create([
                'invoice_id' => $invoice->id,
                'description' => $description,
                'rate' => $request->price[$key],
                'quantity' => $request->qty[$key],
                'amount' => $request->price[$key] * $request->qty[$key],
            ]);
        }

        return redirect()->route('invoices.index')->with('success', 'Invoice created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function exportPDF($id)
    {
        $invoice = Invoice::findOrFail($id);

        $view = view('invoices.exportPDF', compact('invoice'))->render();

        $dompdf = new Dompdf();

        $dompdf->loadHtml($view);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return response($dompdf->output())
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="invoice_' . $invoice->number . '.pdf"');
    }
}
