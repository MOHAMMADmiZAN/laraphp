<?php

namespace App\Http\Controllers;




use Barryvdh\DomPDF\PDF;

class InvoiceController extends Controller
{
    // laravel Invoice
    function invoice($id)
    {
        $pdf = PDF::loadView('SendIn', ['order_id', $id]);
        return $pdf->download('SendIn.pdf');


    }
}
