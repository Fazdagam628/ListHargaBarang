<x-layout>
    <div class="max-w-2xl mx-auto bg-base-100 p-6 shadow-lg rounded-xl">
        <h2 class="text-2xl font-bold text-primary mb-4">Form Tambah Produk</h2>

        <form action="{{ route('products.store') }}" method="POST">
            @csrf

            <!-- Nama Barang -->
            <div class="form-control mb-4">
                <label class="label">
                    <span class="label-text">Nama Barang</span>
                </label>
                <input type="text" name="nama_barang"
                    class="input input-bordered @error('nama_barang') input-error @enderror"
                    placeholder="Contoh: Indomie Ayam Bawang" value="{{ old('nama_barang') }}" required />
                @error('nama_barang')
                    <span class="text-error text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Jenis Barang -->
            <div class="form-control mb-4">
                <label class="label">
                    <span class="label-text">Jenis Barang</span>
                </label>
                <select require name="jenis_barang"
                    class="select select-bordered @error('jenis_barang') select-error @enderror" required>
                    <option disabled {{ old('jenis_barang') ? '' : 'selected' }}>Pilih jenis</option>
                    <option value="Makanan" {{ old('jenis_barang') == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                    <option value="Minuman" {{ old('jenis_barang') == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                    <option value="Bumbu" {{ old('jenis_barang') == 'Bumbu' ? 'selected' : '' }}>Bumbu</option>
                    <option value="Obat-obatan" {{ old('jenis_barang') == 'Obat-obatan' ? 'selected' : '' }}>Obat-obatan
                    </option>
                    <option value="Sabun" {{ old('jenis_barang') == 'Sabun' ? 'selected' : '' }}>Sabun</option>
                    <option value="Lainnya" {{ old('jenis_barang') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
                @error('jenis_barang')
                    <span class="text-error text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Harga per pcs -->
            <div class="form-control mb-4">
                <label class="label">
                    <span class="label-text">Harga per pcs</span>
                </label>
                <input type="number" name="harga_pcs" step="0.01"
                    class="input input-bordered @error('harga_pcs') input-error @enderror" placeholder="Contoh: 2500"
                    value="{{ old('harga_pcs') }}" />
                @error('harga_pcs')
                    <span class="text-error text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Harga 2 pcs -->
            <div class="form-control mb-4">
                <label class="label">
                    <span class="label-text">Harga 2 pcs</span>
                </label>
                <input type="number" name="harga_2pcs" step="0.01"
                    class="input input-bordered @error('harga_2pcs') input-error @enderror" placeholder="Contoh: 4500"
                    value="{{ old('harga_2pcs') }}" />
                @error('harga_2pcs')
                    <span class="text-error text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Link Foto Barang -->
            <div class="form-control mb-4">
                <label class="label">
                    <span class="label-text">Link Foto Barang</span>
                </label>
                <input type="url" name="foto_barang"
                    class="input input-bordered @error('foto_barang') input-error @enderror"
                    placeholder="https://example.com/foto.jpg" value="{{ old('foto_barang') }}" />
                @error('foto_barang')
                    <span class="text-error text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- Tombol Submit -->
            <div class="form-control mt-6 flex flex-col gap-2 sm:flex-row">
                <button type="submit" class="btn btn-primary">Simpan Produk</button>
                <button type="reset" class="btn btn-warning">Reset Produk</button>
            </div>
        </form>
    </div>
</x-layout>
