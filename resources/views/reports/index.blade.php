<x-app-layout>
    <x-slot name="pageTitle">Report Generation</x-slot>
    <x-slot name="pageSubtitle">Generate business reports by type and month</x-slot>

    <div class="max-w-2xl mx-auto p-6">
        <div class="card p-8">
            <div class="text-center mb-8">
                <div class="w-20 h-20 mx-auto rounded-2xl bg-gradient-to-br from-blue-400 to-blue-500 flex items-center justify-center text-white shadow-lg mb-4">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-slate-800 mb-2">Report Generation</h2>
                <p class="text-slate-500 text-lg">Select report type and month to generate detailed report</p>
            </div>

            <form id="reportForm" class="space-y-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Report Type</label>
                    <select name="type" id="typeSelect" class="w-full text-input">
                        <option value="sales">Sales</option>
                        <option value="products">Products (Inventory)</option>
                        <option value="categories">Categories</option>
                        <option value="logs">Logs</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Month</label>
                    <input type="month" name="month" id="monthSelect" value="{{ request('month', now()->format('Y-m')) }}" class="w-full text-input">
                </div>

                <button type="button" onclick="generateReport()" class="w-full btn-primary px-8 py-4 rounded-xl text-lg font-semibold flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    Generate Report
                </button>
            </form>
        </div>
    </div>

    <script>
        function generateReport() {
            const type = document.getElementById('typeSelect').value;
            const month = document.getElementById('monthSelect').value;
            window.location.href = `/reports/${type}?month=${month}`;
        }

        // Preserve params on load
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('type')) {
            document.getElementById('typeSelect').value = urlParams.get('type');
        }
        if (urlParams.has('month')) {
            document.getElementById('monthSelect').value = urlParams.get('month');
        }
    </script>
</x-app-layout>
