<?php

use App\Buku;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for( $i = 0; $i < 20; $i++ ) {
            
            $faker = Faker\Factory::create();
            $buku = new Buku;

            $buku->isbn = rand(111111,999999);
            $buku->judul = $faker->sentence(rand(1,3));
            $buku->tahun = rand(2015,2021);
            $buku->id_penerbit = rand(1,7);
            $buku->id_pengarang = rand(1,6);
            $buku->id_katalog = rand(1,5);
            $buku->qty_stok = rand(5,20);
            $buku->harga_pinjam = rand(50,200) * 100;

            $buku->save();

        }
    }
}
