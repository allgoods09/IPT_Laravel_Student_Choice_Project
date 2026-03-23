<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sales Report - {{ \Illuminate\Support\Carbon::parse($month)->format('F Y') }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; margin: 20px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; }
        .header h1 { margin: 0; color: #1f2937; }
        .header p { margin: 5px 0; color: #6b7280; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { padding: 8px 10px; text-align: left; border: 1px solid #e5e7eb; }
        th { background-color: #f9fafb; font-weight: bold; }
        td.amount { text-align: right; font-weight: bold; }
        .summary { margin-top: 20px; padding: 12px; background: #f3f4f6; border-radius: 8px; font-weight: bold; }
        @media print { body { margin: 0; } }
    </style>
</head>
<body>
    <div class="header">
        <h1>Sales Report</h1>
        <p>{{ \Illuminate\Support\Carbon::parse($month)->format('F Y') }}</p>
        <p>Generated on {{ now()->format('M d, Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Product</th>
                <th>Quantity</th>
                <th class="amount">Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $sale)
                <tr>
                    <td>{{ optional($sale->sale_date)->format('M d, Y H:i') ?? 'N/A' }}</td>
                    <td>{{ $sale->product->name ?? 'N/A' }}</td>
                    <td>{{ $sale->quantity }}</td>
                    <td class="amount">₱{{ number_format($sale->total_amount ?? 0, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align:center;color:#6b7280;">No sales found for this month.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="summary">
        Total Transactions: {{ $data->count() }} | 
        Total Items Sold: {{ $data->sum('quantity') }} | 
        Total Revenue: ₱{{ number_format($data->sum('total_amount'), 2) }}
    </div>
</body>
</html>