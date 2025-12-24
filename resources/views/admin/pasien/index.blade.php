<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <section>
                    <header class="mb-6 flex items-center justify-between">
                        <h2 class="text-lg font-medium text-gray-900">
                            Admin Pasien
                        </h2>

                        <div>
                            <a href="{{ route('admin.pasien.create') }}"
                                class="inline-block px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Tambah Pasien
                            </a>
                        </div>
                    </header>

                    <div class="overflow-x-auto mt-6">
                        <table class="min-w-full divide-y divide-gray-200 border rounded-lg">
                            <thead class="bg-gray-100 text-left text-sm font-medium text-gray-700">
                                <tr>
                                    <th class="px-4 py-2">ID User </th>
                                    <th class="px-4 py-2">Nama pasien</th>
                                    <th class="px-4 py-2">Email
                                    </th>
                                    <th class="px-4 py-2">Alamat</th>
                                    <th class="px-4 py-2">No KTP</th>
                                    <th class="px-4 py-2">No HP</th>
                                    <th class="px-4 py-2">Poli</th>
                                    <th class="px-4 py-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 text-sm">
                                @forelse ($pasiens as $pasien)
                                    <tr>
                                        <td class="px-4 py-2">{{ $pasien->id }}</td>
                                        <td class="px-4 py-2">{{ $pasien->name }}</td>
                                        <td class="px-4 py-2">{{ $pasien->email }}</td>
                                        <td class="px-4 py-2">
                                            {{ $pasien->alamat  }}
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ $pasien->no_ktp ?? '-' }}
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ $pasien->no_hp ?? '-' }}
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ $pasien->no_rm ?? '-' }}
                                        </td>
                                        <td class="px-4 py-2 flex space-x-2">
                                            <a href="{{ route('admin.pasien.edit', $pasien->id) }}"
                                                class="inline-block px-3 py-1 text-sm text-white bg-amber-600 rounded hover:bg-amber-700">
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.pasien.destroy', $pasien->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" href="{{ route('admin.pasien.destroy', $pasien->id) }}"
                                                    class="inline-block px-3 py-1 text-sm text-white bg-red-600 rounded hover:bg-red-700">
                                                    Delete
                                                </button>
                                            </form>
                                           
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center px-4 py-3 text-gray-500">Data pasien Tidak Tersedia
                                            
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </section>
            </div>
        </div>
    </div>
   

   
</x-app-layout>
