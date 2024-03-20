<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Storage;



class ApiInvoiceController extends Controller
{
    public function pdfInvoice($id)
    {
        $invoice = Invoice::findOrFail($id);

        $view = view('invoices.exportPDF', compact('invoice'))->render();

        $dompdf = new Dompdf();

        $dompdf->loadHtml($view);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $pdfPath = 'public/invoices/invoice_' . $invoice->number . '.pdf';
        Storage::put($pdfPath, $dompdf->output());

        $pdfUrl = Storage::url($pdfPath);

        return response()->json([
            'success' => true,
            'pdf_url' => $pdfUrl,
            'filename' => 'invoice_' . $invoice->number . '.pdf'
        ]);
    }
}
