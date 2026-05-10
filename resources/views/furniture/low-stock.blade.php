<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Produk dengan Stok Menipis
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($furniture->count() > 0)
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr><th>Kode</th><th>Nama</th><th>Stok</th><th>Min Stok</th><th>Aksi</th></tr>
                            </thead>
                            <tbody>
                                @foreach($furniture as $item)
                                <tr>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td class="text-red-600 font-bold">{{ $item->stock }}</td>
                                    <td>{{ $item->min_stock }}</td>
                                    <td>
                                        <a href="{{ route('furniture.edit', $item) }}" class="text-blue-500">Tambah Stok</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-green-600">Semua produk memiliki stok yang cukup.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>