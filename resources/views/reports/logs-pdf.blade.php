<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Logs Report - {{ \Illuminate\Support\Carbon::parse($month)->format('F Y') }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; margin: 20px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; }
        .header h1 { margin: 0; color: #1f2937; }
        .header p { margin: 5px 0; color: #6b7280; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { padding: 8px 10px; text-align: left; border: 1px solid #e5e7eb; }
        th { background-color: #f9fafb; font-weight: bold; }
        td { vertical-align: top; }
        .message { max-width: 300px; word-wrap: break-word; }
        .summary { margin-top: 20px; padding: 12px; background: #f3f4f6; border-radius: 8px; font-weight: bold; }
        @media print { body { margin: 0; } }
    </style>
</head>
<body>
    <div class="header">
        <h1>Logs Report</h1>
        <p>{{ \Illuminate\Support\Carbon::parse($month)->format('F Y') }}</p>
        <p>Generated on {{ now()->format('M d, Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>User</th>
                <th>Action</th>
                <th>Entity Type</th>
                <th>Entity ID</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $log)
                <tr>
                    <td>{{ $log->created_at->format('M d, Y H:i') }}</td>
                    <td>{{ $log->user?->name ?? 'System' }}</td>
                    <td>{{ $log->action ?? 'N/A' }}</td>
                    <td>{{ $log->entity_type ?? 'N/A' }}</td>
                    <td>{{ $log->entity_id ?? 'N/A' }}</td>
                    <td class="message">{{ $log->description ?? 'N/A' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: #6b7280;">No logs found for this month.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="summary">
        Total Logs: {{ $data->count() }}
    </div>
</body>
</html>