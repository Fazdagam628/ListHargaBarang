<x-layout>
    <div class="container mx-auto px-4 py-8">
        <!-- Judul -->
        <h1 class="text-3xl font-bold text-center text-primary mb-2">Daftar Barang</h1>
        <p class="text-center text-gray-500 mb-6">List Harga Barang</p>

        <!-- Divider -->
        <div class="divider my-6"></div>

        <!-- Tabel Grid -->
        <div class="grid grid-cols-12 gap-4">

            <!-- Form Bulk Delete -->
            <div class="col-start-2 col-span-10">
                <a href="{{ route('products.create') }}" class="btn dark:btn-soft btn-success col-span-2 my-2">Tambah
                    Barang</a>
                <form id="bulkDeleteForm" action="{{ route('products.bulk-delete') }}" method="POST"
                    onsubmit="return false;">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn dark:btn-soft btn-error col-span-2 my-2"
                        onclick="confirmBulkDelete()">Hapus
                        Terpilih</button>
                </form>

                <div class="col-start-2 col-span-10">
                    <a href="{{ route('products.trash') }}" class="btn btn-primary my-2">Restore Data</a>
                </div>
                <div class="overflow-x-auto bg-base-100 shadow-lg rounded-xl p-4 mt-4">
                    <table id="produkTable" class="table table-zebra w-full">
                        <thead>
                            <tr class="text-primary">
                                <th><input type="checkbox" id="selectAll"></th>
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
                                    <th class="text-center text-primary font-bold">{{ $index + 1 }}</th>
                                    <td>{{ $product->nama_barang }}</td>
                                    <td>{{ $product->jenis_barang }}</td>
                                    <td>{{ 'Rp ' . number_format($product->harga_pcs, 2, ',', '.') }}</td>
                                    <td>{{ 'Rp ' . number_format($product->harga_2pcs, 2, ',', '.') }}</td>
                                    <td><img src="{{ $product->foto_barang }}" alt="Produk" style="width: 150px"
                                            class="rounded-lg"></td>
                                    <td>
                                        <form id="deleteForm-{{ $product->id }}"
                                            action="{{ route('products.destroy', $product->id) }}" method="POST">
                                            <a href="{{ route('products.edit', $product->id) }}"
                                                class="btn dark:btn-soft btn-info">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn dark:btn-soft btn-error"
                                                onclick="confirmDelete('{{ $product->id }}')">Hapus</button>
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

    <!-- SweetAlert2 CDN -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- DataTable -->
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

            $('#selectAll').on('click', function() {
                $('input[name="ids[]"]').prop('checked', this.checked);
            });
        });

        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data yang terhapus dapat direstore!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm-' + id).submit();
                }
            });
        }

        function confirmBulkDelete() {
            if ($('input[name="ids[]"]:checked').length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Tidak ada item',
                    text: 'Silakan pilih data yang ingin dihapus.'
                });
                return;
            }

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Beberapa barang akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('bulkDeleteForm').submit();
                }
            });
        }

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                confirmButtonColor: '#22c55e'
            });
        @elseif (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
                confirmButtonColor: '#ef4444'
            });
        @endif
    </script>
</x-layout>
