<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerChartController extends Controller
{

public function BarChart(){
    $users = Customer:: selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

    $labels = []; 
    $data = [];
    $colors =['#FF6384', '#36A2EB', '#FFCE56', '#8BC34A', '#ff5722', '#009688', '#795548', '#9C27B0', '#2196F3', '#FF9800', '#CDDC39', '#607D88'];

    for ($i = 1; $i < 13; $i++) {
        $month = date('F', mktime(0, 0, 0, $i, 1));
        $count = 0;
      
        foreach ($users as $user) {
          if ($user->month == $i) {
            $count = $user->count;
            break;
          }
        }
        array_push($labels, $month);
        // Format count to display only the integer part (no decimals)
        array_push($data, number_format($count, 0, '', '')); 
      }
      
      

    $datasets = [
        [
            'label' => 'Customers',
            'data' => $data,
            'backgroundColor' => $colors
        ]
        ];

        return view('Charts.barChart', compact('datasets', 'labels'));
}

    public function pieChart(){
        $users = Customer::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        ->whereYear('created_at', date('Y'))
        ->groupBy('month')
        ->orderBy('month')
        ->get();

            $labels = []; 
            $data = [];
            $colors = [
            '#FF6384', '#36A2EB', '#FFCE56', '#8BC34A', '#ff5722', 
            '#009688', '#795548', '#9C27B0', '#2196F3', '#FF9800', 
            '#CDDC39', '#607D88'
            ];

            for ($i = 1; $i < 13; $i++) {
            $month = date('F', mktime(0, 0, 0, $i, 1));
            $count = 0;

            foreach ($users as $user) {
            if ($user->month == $i) {
            $count = $user->count;
            break;
            }
            }
            array_push($labels, $month);
            // Format count to display only the integer part (no decimals)
            array_push($data, number_format($count, 0, '', '')); 
            }

            $datasets = [
            [
            'label' => 'Customers by Month',
            'data' => $data,
            'backgroundColor' => $colors
            ]
            ];

            return view('Charts.pieChart', compact('datasets', 'labels'));
            }
}