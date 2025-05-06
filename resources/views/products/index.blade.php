<x-layout>
    <div class="container mx-auto px-4 py-8">
        <!-- Judul -->
        <h1 class="text-3xl font-bold text-center text-primary mb-2">Daftar Barang</h1>
        <p class="text-center text-gray-500 mb-6">GRIYA ASTUTI</p>

        <!-- Divider -->
        <div class="divider my-6"></div>
        <!-- Tabel Grid -->
        <div class="grid grid-cols-12 gap-4">
            <a href="{{ route('products.create') }}"
                class="btn btn-soft btn-success btn-xs sm:btn-sm md:btn-md lg:btn-lg xl:btn-xl col-start-2 col-span-2">Tambah
                Barang</a>
            <!-- Form Bulk Delete -->
            <div class="col-start-2 col-span-10">
                <form id="bulkDeleteForm" action="{{ route('products.bulk-delete') }}" method="POST"
                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang-barang yang dipilih?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-soft btn-error col-span-2">Hapus
                        Terpilih</button>
                </form>
                <div class="overflow-x-auto bg-base-100 shadow-lg rounded-xl p-4">
                    <table id="produkTable" class="table table-zebra w-full">
                        <!-- head -->
                        <thead>
                            <tr class="text-primary">
                                <th><input type="checkbox" id="selectAll"></th> <!-- checkbox master -->
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Jenis Barang</th>
                                <th>Harga Per PCS</th>
                                <th>Harga Per 2 PCS</th>
                                <th>Foto barang</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $index => $product)
                                <tr class="hover:bg-base-300">
                                    <td>
                                        <input type="checkbox" name="ids[]" value="{{ $product->id }}"
                                            form="bulkDeleteForm">
                                    </td>
                                    <th class="text-center text-primary font-bold">
                                        {{ $index + 1 }}
                                    </th>
                                    <td>{{ $product->nama_barang }}</td>
                                    <td>{{ $product->jenis_barang }}</td>
                                    <td>{{ 'Rp ' . number_format($product->harga_pcs, 2, ',', '.') }}</td>
                                    <td>{{ $product->harga_2pcs }}</td>
                                    <td><img src="{{ $product->foto_barang }}" alt="Produk" style="width: 150px"
                                            class="rounded-lg"></td>
                                    <td>
                                        <form onsubmit="return confirm('Apakah anda yakin!');"
                                            action="{{ route('products.destroy', $product->id) }}" method="POST">
                                            <a href="{{ route('products.edit', $product->id) }}"
                                                class="btn btn-soft btn-info">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-soft btn-error">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('#produkTable').DataTable({
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ entri",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "›",
                        previous: "‹"
                    },
                    zeroRecords: "Tidak ada data yang tersedia",
                }
            });
        });
        $('#selectAll').on('click', function() {
            $('input[name="ids[]"]').prop('checked', this.checked);
        });
    </script>

</x-layout>
