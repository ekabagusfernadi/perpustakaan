<?php

use App\Anggota;
use Illuminate\Database\Seeder;

class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for( $i = 0; $i < 10; $i++ ) {

            $faker = Faker\Factory::create("id_ID");
            $anggota = new Anggota;
            $jenisKelamin = ["male", "female"];

            $anggota->nama = $faker->name($genderAnggota = $jenisKelamin[rand(0,1)]);
            $anggota->sex = $genderAnggota == "male" ? "L" : "P";
            $anggota->telp = "08" . rand(1111111111,9999999999);
            $anggota->alamat = $faker->address;
            $anggota->email = strtolower(explode(" ", $anggota->nama)[0]) . rand(1,99) . "@" . $faker->freeEmailDomain;

            $anggota->save();

        }
    }
}
