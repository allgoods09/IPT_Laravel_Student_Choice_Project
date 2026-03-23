<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Categories Report - {{ \Illuminate\Support\Carbon::parse($month)->format('F Y') }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; margin: 20px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; }
        .header h1 { margin: 0; color: #1f2937; }
        .header p { margin: 5px 0; color: #6b7280; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb; }
        th { background-color: #f9fafb; font-weight: bold; }
        .amount { text-align: right; font-weight: bold; }
        .summary { display: flex; justify-content: space-between; margin-top: 20px; padding: 20px; background: #f3f4f6; border-radius: 8px; }
        @media print { body { margin: 0; } }
    </style>
</head>
<body>
    <div class="header">
        <h1>Categories Report</h1>
        <p>{{ \Illuminate\Support\Carbon::parse($month)->format('F Y') }} snapshot</p>
        <p>Generated on {{ now()->format('M d, Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Category</th>
                <th class="amount">Products Count</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td class="amount">{{ $category->products_count }}</td>
                    <td>{{ $category->status ?? 'N/A' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="text-align: center; color: #6b7280;">No categories found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="summary">
        <div>Total Categories: {{ $data->count() }}</div>
        <div>Active: {{ $data->where('status', 'Active')->count() }}</div>
        <div>Empty: {{ $data->where('products_count', 0)->count() }}</div>
    </div>
</body>
</html>
