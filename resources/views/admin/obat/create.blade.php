<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl sm:rounded-2xl border border-gray-200">
                <div class="p-8">
                    <!-- Form Header -->
                    <div class="text-center mb-8">
                        <div
                            class="w-16 h-16 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                            <i class="fas fa-user-plus text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Tambah Obat Baru</h3>
                        <p class="text-gray-600">Lengkapi informasi obat untuk menambahkan ke sistem</p>
                    </div>

                    <!-- Form -->
                    <form action="{{ route('admin.obat.store') }}" method="POST" id="formTambahobat" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama obat -->
                            <div class="md:col-span-2">
                                <label for="nama_obat" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-user text-blue-500 mr-2"></i>Nama obat
                                </label>
                                <input type="text" id="nama_obat" name="nama_obat" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-300 text-gray-900 placeholder-gray-400"
                                    placeholder="Paracetamol">
                            </div>
                            <!-- Kemasan -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:col-span-2">
                                <!-- Kemasan -->
                                <div>
                                    <label for="kemasan" class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fas fa-lock text-blue-500 mr-2"></i>Kemasan
                                    </label>
                                    <div class="relative">
                                        <input type="text" id="kemasan" name="kemasan" required
                                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-300 text-gray-900 placeholder-gray-400 pr-12"
                                            placeholder="Sachet">
                                    </div>
                                </div>

                                <!-- Harga -->
                                <div>
                                    <label for="harga" class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fas fa-lock text-blue-500 mr-2"></i>Harga
                                    </label>
                                    <div class="relative">
                                        <input type="text" id="harga" name="harga" required
                                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-300 text-gray-900 placeholder-gray-400 pr-12"
                                            placeholder="10000">
                                    </div>
                                </div>
                            </div>


                            @if ($errors->any())
                                <div class="mb-4">
                                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                                        <strong>Ups! Ada kesalahan input:</strong>
                                        <ul class="mt-2 list-disc list-inside text-sm">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif

                            <!-- Action Buttons -->
                            <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                                <a type="button" href="{{ route('admin.obat.index') }}"
                                    class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-6 rounded-xl transition-all duration-300 flex items-center justify-center">
                                    <i class="fas fa-undo mr-2"></i>Batal
                                </a>
                                <form action="{{ route('admin.obat.store') }}" method="POST" id="formSimpanobat">
                                    @csrf
                                    <button type="submit"
                                        class="flex-1 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 flex items-center justify-center">
                                        <i class="fas fa-save mr-2"></i>Simpan obat
                                    </button>
                                </form>
                            </div>
                    </form>
                </div>
            </div>

            <!-- Info Card -->
            <div class="mt-6 bg-blue-50 border-l-4 border-blue-400 p-4 rounded-r-xl">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-info-circle text-blue-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-blue-700">
                            <strong>Catatan:</strong> Pastikan semua data yang dimasukkan sudah benar.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
