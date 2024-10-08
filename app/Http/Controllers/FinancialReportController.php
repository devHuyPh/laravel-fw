<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\FinancialReport;
use App\Models\Sale;
use App\Models\Taxe;
use Illuminate\Http\Request;

class FinancialReportController extends Controller
{
    public function generateReport()
    {
        $month = 9;
        $year = 2024;

        $totalSales = Sale::selectRaw('
            SUM(total) as total_sales, 
            EXTRACT(MONTH FROM sale_date) as sale_month, 
            EXTRACT(YEAR FROM sale_date) as sale_year')
            ->groupByRaw('
                EXTRACT(MONTH FROM sale_date), 
                EXTRACT(YEAR FROM sale_date)')
            ->havingRaw('sale_month = ? AND sale_year = ?', [$month, $year])
            ->first();

        $totalExpenses = Expense::selectRaw('
            SUM(amount) as total_expenses, 
            EXTRACT(MONTH FROM expense_date) as expense_month, 
            EXTRACT(YEAR FROM expense_date) as expense_year')
            ->groupByRaw('
                EXTRACT(MONTH FROM expense_date), 
                EXTRACT(YEAR FROM expense_date)')
            ->havingRaw('expense_month = ? AND expense_year = ?', [$month, $year])
            ->first();

        if (!$totalSales || !$totalExpenses) {
            return "Không có dữ liệu cho tháng $month năm $year.";
        }

        $profitBeforeTax = $totalSales->total_sales - $totalExpenses->total_expenses;

        $taxRate = Taxe::where('tax_name', 'VAT')->value('rate');

        $taxAmount = $profitBeforeTax * ($taxRate / 100);

        $profitAfterTax = $profitBeforeTax - $taxAmount;

        FinancialReport::create([
            'month' => $month,
            'year' => $year,
            'total_sales' => $totalSales->total_sales,
            'total_expenses' => $totalExpenses->total_expenses,
            'profit_before_tax' => $profitBeforeTax,
            'tax_amount' => $taxAmount,
            'profit_after_tax' => $profitAfterTax,
        ]);

        return "Báo cáo tài chính cho tháng $month năm $year đã được tạo thành công.";
    }
}
