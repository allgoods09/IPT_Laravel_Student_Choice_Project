<x-app-layout>
    <x-slot name="pageTitle">Send Report</x-slot>
    <x-slot name="pageSubtitle">Select recipients for {{ ucfirst($type) }} Report</x-slot>

    <div class="max-w-3xl mx-auto p-6 space-y-6">
        <!-- Back Button -->
        <div>
            <a href="{{ route('reports.index') }}" 
               class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-100 text-slate-700 hover:bg-slate-200 transition font-semibold">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Reports
            </a>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div id="flash-message" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-sm" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- Recipient Form -->
        <div class="bg-white shadow rounded-xl p-6">
            <form action="{{ route('reports.mail', ['type' => $type, 'month' => $month]) }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="recipients" class="block text-sm font-medium text-slate-700">Recipients</label>
                    <select name="recipients[]" id="recipients" 
                            class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            multiple>
                        @foreach ($users as $user)
                            <option value="{{ $user->email }}">{{ $user->name }} ({{ $user->email }})</option>
                        @endforeach
                    </select>
                    <p class="text-xs text-slate-500 mt-1">Hold Ctrl (Windows) or Command (Mac) to select multiple recipients.</p>
                </div>

                <div class="flex justify-end">
                    <button type="submit" 
                            class="btn-primary px-6 py-3 rounded-xl font-semibold flex items-center justify-center gap-2 shadow-lg hover:shadow-xl transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m0 0l4-4m-4 4l4 4" />
                        </svg>
                        Send Report
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        setTimeout(() => {
            const flash = document.getElementById('flash-message');
            if (flash) {
                flash.style.transition = "opacity 0.5s ease";
                flash.style.opacity = "0";
                
                setTimeout(() => flash.remove(), 500); // remove after fade
            }
        }, 1500); // 3 seconds
    </script>
</x-app-layout>