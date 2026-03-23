<x-app-layout>
    <x-slot name="pageTitle">Add Category</x-slot>
    <x-slot name="pageSubtitle">Create a new product category</x-slot>

    <div class="max-w-xl">
        <div class="card p-8">

            @if ($errors->any())
                <div class="flash-error mb-5">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('categories.store') }}" class="space-y-5">
                @csrf

                <div>
                    <label>Category Name *</label>
                    <input type="text" name="name"
                           placeholder="e.g. Electronics"
                           value="{{ old('name') }}" required>
                </div>

                <div>
                    <label>Description</label>
                    <textarea name="description" rows="3"
                              placeholder="Brief description…">{{ old('description') }}</textarea>
                </div>

                <div>
                    <label>Status</label>
                    <select name="status">
                        <option value="Active"    {{ old('status', 'Active') === 'Active'   ? 'selected' : '' }}>Active</option>
                        <option value="Inactive"  {{ old('status') === 'Inactive'           ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit"
                            class="btn-primary px-6 py-2.5 rounded-xl text-sm font-semibold">
                        Save Category
                    </button>
                    <a href="{{ route('categories.index') }}"
                       class="px-6 py-2.5 rounded-xl text-sm font-semibold bg-slate-100 text-slate-600 hover:bg-slate-200 transition">
                        Cancel
                    </a>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>