<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Products Report - {{ \Illuminate\Support\Carbon::parse($month)->format('F Y') }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; margin: 20px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; }
        .header h1 { margin: 0; color: #1f2937; }
        .header p { margin: 5px 0; color: #6b7280; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb; }
        th { background-color: #f9fafb; font-weight: bold; }
        .low-stock { background-color: #fee2e2; color: #dc2626; }
        .amount { text-align: right; }
        .summary { display: flex; justify-content: space-between; margin-top: 20px; padding: 20px; background: #f3f4f6; border-radius: 8px; }
        @media print { body { margin: 0; } }
    </style>
</head>
<body>
    <div class="header">
        <h1>Products Report (Inventory)</h1>
        <p>{{ \Illuminate\Support\Carbon::parse($month)->format('F Y') }} snapshot</p>
        <p>Generated on {{ now()->format('M d, Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Category</th>
                <th class="amount">Stock</th>
                <th class="amount">Reorder Level</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $product)
                <tr @if($product->stock_quantity <= $product->reorder_level) class="low-stock" @endif>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name ?? 'Uncategorized' }}</td>
                    <td class="amount">{{ $product->stock_quantity }}</td>
                    <td class="amount">{{ $product->reorder_level }}</td>
                    <td>{{ $product->stock_quantity <= $product->reorder_level ? 'Low Stock' : 'OK' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: #6b7280;">No products found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="summary">
        <div>Total Products: {{ $data->count() }}</div>
        <div>Low Stock: {{ $data->filter(fn($p) => $p->stock_quantity <= $p->reorder_level)->count() }}</div>
    </div>
</body>
</html>