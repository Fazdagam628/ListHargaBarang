<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        $jenisBarangOptions = ['Makanan', 'Minuman', 'Bumbu', 'Obat-obatan', 'Sabun', 'Lainnya'];
        $seed = $this->faker->unique()->word;
        return [
            'nama_barang' => $this->faker->words(2, true),
            'harga_pcs' => $this->faker->numberBetween(1000, 10000),
            'harga_2pcs' => $this->faker->numberBetween(2000, 20000),
            'jenis_barang' => $this->faker->randomElement($jenisBarangOptions),
            'foto_barang' => "https://picsum.photos/seed/{$seed}/300/200",
        ];
    }
}
