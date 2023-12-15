<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\Preorder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Warehouse;

class PreorderCountController extends Controller
{

    public function preorderCountChart(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $chartData = Warehouse::join('products', 'products.id', '=', 'warehouses.product_id')
            ->join('preorders', 'warehouses.order_id', '=', 'preorders.order_id')
            ->selectRaw('MONTH(warehouses.updated_at) as month')
            ->selectRaw('SUM(warehouses.sales_issue) as sales_issue')
            ->whereBetween('warehouses.updated_at', [$startDate, $endDate])
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $totalSalesIssue = Warehouse::join('products', 'products.id', '=', 'warehouses.product_id')
            ->join('preorders', 'warehouses.order_id', '=', 'preorders.order_id')
            ->selectRaw('SUM(warehouses.sales_issue) as total_sales_issue')
            ->whereBetween('warehouses.updated_at', [$startDate, $endDate])
            ->first();

        return response()->json(['chartData' => $chartData, 'total_sales_issue' => $totalSalesIssue->total_sales_issue]);
    }
}
