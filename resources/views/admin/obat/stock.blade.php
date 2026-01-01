<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Stok Obat') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl sm:rounded-2xl border border-gray-200">
                <div class="p-8">
                    <div class="text-center mb-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Tambah Stok untuk <strong>{{ $obat->nama_obat }}</strong></h3>
                        <p class="text-gray-600">Stok saat ini: <strong>{{ $obat->stok ?? 0 }}</strong></p>
                    </div>

                    <form method="POST" action="{{ route('admin.obat.addStock', $obat->id) }}" class="space-y-6">
                        @csrf
                        @method('PATCH')

                        <div>
                            <label for="jumlah" class="block text-sm font-semibold text-gray-700 mb-2">Jumlah yang akan ditambahkan</label>
                            <input type="number" id="jumlah" name="jumlah" min="1" required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-300 text-gray-900 placeholder-gray-400"
                                placeholder="Masukkan jumlah">
                        </div>

                        <div class="flex gap-4 pt-6 border-t border-gray-200">
                            <a href="{{ route('admin.obat.index') }}" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-6 rounded-xl transition-all duration-300 flex items-center justify-center">Batal</a>
                            <button type="submit" class="flex-1 bg-gradient-to-r from-green-600 to-green-700 text-white font-semibold py-3 px-6 rounded-xl">Tambah Stok</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>