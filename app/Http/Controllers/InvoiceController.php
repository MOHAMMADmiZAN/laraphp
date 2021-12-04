<?php

namespace App\Http\Controllers;


use App\Models\OrderBillingDetails;
use Barryvdh\DomPDF\PDF;


class InvoiceController extends Controller
{
    function invoice($id)
    {
        $data = OrderBillingDetails::whereOrderId($id)->first();
        $pdf = PDF::loadView('dashboard.invoice.invoice', $data);
        return $pdf->download($data->customer_name . '-invoice.pdf');



    }
}
