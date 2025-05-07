<x-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-center text-error mb-2">Tempat Sampah Produk</h1>
        <p class="text-center text-gray-500 mb-6">Data produk yang terhapus dapat direstore kembali</p>

        <!-- Divider -->
        <div class="divider my-6"></div>

        <!-- Tabel Grid -->
        <div class="grid grid-cols-12 gap-4">
            <div class="col-start-2 col-span-10">
                <div class="col-start-2 col-span-2 my-2">
                    <a href="{{ route('products.index') }}" class="btn btn-primary">Kembali ke Daftar Barang</a>
                </div>

                <div class="overflow-x-auto bg-base-100 shadow-lg rounded-xl p-4 mt-4">
                    <table id="produkTable" class="table table-zebra w-full">
                        <thead>
                            <tr class="text-error">
                                <th>No</th> {{-- 1 --}}
                                <th>Nama Barang</th> {{-- 2 --}}
                                <th>Jenis Barang</th> {{-- 3 --}}
                                <th>Harga Per PCS</th> {{-- 4 --}}
                                <th>Harga Per 2 PCS</th> {{-- 5 --}}
                                <th>Foto barang</th>{{-- 6 --}}
                                <th>Tanggal dihapus</th>{{-- 7 --}}
                                <th>Aksi</th> {{-- 8 --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $index => $product)
                                <tr>
                                    <td>{{ $index + 1 }}</td> {{-- 1 --}}
                                    <td>{{ $product->nama_barang }}</td> {{-- 2 --}}
                                    <td>{{ $product->jenis_barang }}</td>{{-- 3 --}}
                                    <td>{{ 'Rp ' . number_format($product->harga_pcs, 2, ',', '.') }}</td>
                                    {{-- 4 --}}
                                    <td>{{ 'Rp ' . number_format($product->harga_2pcs, 2, ',', '.') }}</td>
                                    {{-- 5 --}}
                                    <td><img src="{{ $product->foto_barang }}" alt="Produk" style="width: 150px"
                                            class="rounded-lg"></td> {{-- 6 --}}
                                    <td>{{ $product->deleted_at->format('d M Y H:i') }}</td> {{-- 7 --}}
                                    <td class="space-x-2">
                                        <a href="{{ route('products.restore', $product->id) }}"
                                            class="btn btn-success btn-sm">Restore</a>

                                        <form id="deleteForm-{{ $product->id }}"
                                            action="{{ route('products.forceDelete', $product->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-error btn-sm"
                                                onclick="confirmDelete('{{ $product->id }}')">Hapus Permanen</button>
                                        </form>
                                    </td> {{-- 8 --}}
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada produk dalam tempat sampah.</td>
                                </tr>
                            @endforelse
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
                text: "Data tidak bisa dikembalikan!",
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
