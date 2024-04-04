<?php

namespace App\Http\Controllers;

use App\Models\OrderLine;
use App\Models\Stock;
use App\Models\EmployeeDocument;
use Illuminate\Http\Request;

class CustomerChartController extends Controller
{
    public function charts()
    {
        $orderLines = OrderLine::join('products', 'order_lines.product_id', '=', 'products.id')
            ->select('products.product_name', \DB::raw('COUNT(*) as count'))
            ->groupBy('products.product_name')
            ->orderBy('count', 'desc')
            ->get();

        $orderLabels = $orderLines->pluck('product_name');
        $orderData = $orderLines->pluck('count');

        $stocks = Stock::join('products', 'stocks.product_id', '=', 'products.id')
            ->select('products.product_name', 'stocks.product_stock')
            ->orderBy('stocks.created_at')
            ->get();

        $stockLabels = $stocks->pluck('product_name');
        $stockData = $stocks->pluck('product_stock');

        $employeeDocuments = EmployeeDocument::select('document_type', \DB::raw('COUNT(*) as count'))
            ->groupBy('document_type')
            ->orderBy('count', 'desc')
            ->get();

        $documentLabels = $employeeDocuments->pluck('document_type');
        $documentData = $employeeDocuments->pluck('count');

        return view('Admins.dashboard', compact('orderLabels', 'orderData', 'stockLabels', 'stockData', 'documentLabels', 'documentData'));
    }
}
