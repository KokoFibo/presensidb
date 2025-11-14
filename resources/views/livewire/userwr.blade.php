<div class="p-4 sm:p-6">
    <h2 class="text-xl font-semibold mb-5 text-gray-800">Daftar User</h2>

    <!-- Filter -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-5">
        <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
            <input type="text" wire:model.live="search" placeholder="Cari nama atau ID karyawan..."
                class="w-full sm:w-64 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 placeholder-gray-400 text-sm">

            <select wire:model.live="company"
                class="w-full sm:w-52 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                <option value="">Semua Perusahaan</option>
                @foreach ($companies as $comp)
                    <option value="{{ $comp }}">{{ $comp }}</option>
                @endforeach
            </select>

            <select wire:model.live="perPage"
                class="w-full sm:w-36 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                <option value="5">5 / Halaman</option>
                <option value="10">10 / Halaman</option>
                <option value="25">25 / Halaman</option>
            </select>
        </div>

        <!-- Checkbox filter data tidak lengkap -->
        <label class="flex items-center gap-2 text-sm text-gray-700 mt-1 sm:mt-0">
            <input type="checkbox" wire:model.live="incompleteOnly"
                class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span>Hanya data yang belum lengkap</span>
        </label>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto bg-white shadow-md rounded-xl border border-gray-100">
        <table class="min-w-full text-sm text-gray-700">
            <thead class="bg-gray-50 text-gray-800 border-b">
                <tr>
                    <th class="px-4 py-3 text-left font-medium">ID Karyawan</th>
                    <th class="px-4 py-3 text-left font-medium">Nama</th>
                    <th class="px-4 py-3 text-left font-medium">Email</th>
                    <th class="px-4 py-3 text-left font-medium">Perusahaan</th>
                    <th class="px-4 py-3 text-left font-medium">DB Code</th>
                    <th class="px-4 py-3 text-left font-medium">Role</th>
                    <th class="px-4 py-3 text-left font-medium">Bahasa</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr class="border-b hover:bg-gray-50 transition">
                        <td class="px-4 py-3">{{ $user->id_karyawan }}</td>
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $user->name }}</td>
                        <td class="px-4 py-3">{{ $user->email ?: '-' }}</td>
                        <td class="px-4 py-3">{{ $user->company_name ?: '-' }}</td>
                        <td class="px-4 py-3">{{ $user->db_code }}</td>
                        <td class="px-4 py-3">{{ $user->role }}</td>
                        <td class="px-4 py-3">{{ $user->language }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-500">Tidak ada data ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-5 flex justify-between items-center text-sm text-gray-600">
        <div>
            Showing <span class="font-semibold">{{ $users->firstItem() }}</span> to
            <span class="font-semibold">{{ $users->lastItem() }}</span> of
            <span class="font-semibold">{{ $users->total() }}</span> results
        </div>
        <div>
            {{ $users->links() }}
        </div>
    </div>
</div>
