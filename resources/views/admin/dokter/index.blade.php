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
                            Admin Dokter
                        </h2>

                        <div>
                            <a href="{{ route('admin.dokter.create') }}"
                                class="inline-block px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Tambah Dokter
                            </a>
                        </div>
                    </header>

                   

                    <div class="overflow-x-auto mt-6">
                        <table class="min-w-full divide-y divide-gray-200 border rounded-lg">
                            <thead class="bg-gray-100 text-left text-sm font-medium text-gray-700">
                                <tr>
                                    <th class="px-4 py-2">ID User </th>
                                    <th class="px-4 py-2">Nama Dokter</th>
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
                                @forelse ($dokters as $dokter)
                                    <tr>
                                        <td class="px-4 py-2">{{ $dokter->id }}</td>
                                        <td class="px-4 py-2">{{ $dokter->name }}</td>
                                        <td class="px-4 py-2">{{ $dokter->email }}</td>
                                        <td class="px-4 py-2">
                                            {{ $dokter->alamat  }}
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ $dokter->no_ktp ?? '-' }}
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ $dokter->no_hp ?? '-' }}
                                        </td>
                                        <td class="px-4 py-2">
                                            {{ $dokter->poli->nama_poli ?? '-' }}
                                        </td>
                                        <td class="px-4 py-2 flex space-x-2">
                                            <a href="{{ route('admin.dokter.edit', $dokter->id) }}"
                                                class="inline-block px-3 py-1 text-sm text-white bg-amber-600 rounded hover:bg-amber-700">
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.dokter.destroy', $dokter->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" href="{{ route('admin.dokter.destroy', $dokter->id) }}"
                                                    class="inline-block px-3 py-1 text-sm text-white bg-red-600 rounded hover:bg-red-700">
                                                    Delete
                                                </button>
                                            </form>
                                           
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center px-4 py-3 text-gray-500">Data Dokter Tidak Tersedia
                                            
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
 