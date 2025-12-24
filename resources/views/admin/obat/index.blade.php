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
                            Admin obat
                        </h2>

                        <div>
                            <a href="{{ route('admin.obat.create') }}"
                                class="inline-block px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Tambah obat
                            </a>
                        </div>
                    </header>

                   

                    <div class="overflow-x-auto mt-6">
                        <table class="min-w-full divide-y divide-gray-200 border rounded-lg">
                            <thead class="bg-gray-100 text-left text-sm font-medium text-gray-700">
                                <tr>
                                    <th class="px-4 py-2">No obat</th>
                                    <th class="px-4 py-2">Nama obat</th>
                                    <th class="px-4 py-2">Kemasan
                                    </th>
                                    <th class="px-4 py-2">Harga
                                    </th>
                                    <th class="px-4 py-2">Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 text-sm">
                                @forelse ($obats as $obat)
                                    <tr>
                                        <td class="px-4 py-2">{{ $obat->id }}</td>
                                        <td class="px-4 py-2">{{ $obat->nama_obat }}</td>
                                        <td class="px-4 py-2">{{ $obat->kemasan }}</td>
                                        <td class="px-4 py-2">{{ $obat->harga }}</td>
                                        <td class="px-4 py-2 flex space-x-2">
                                            <a href="{{ route('admin.obat.edit', $obat->id) }}"
                                                class="inline-block px-3 py-1 text-sm text-white bg-amber-600 rounded hover:bg-amber-700">
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.obat.destroy', $obat->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                    class="inline-block px-3 py-1 text-sm text-white bg-red-600 rounded hover:bg-red-700">
                                                    Delete
                                                </button>
                                            </form>
                                           
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center px-4 py-3 text-gray-500">Data obat Tidak Tersedia
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
 