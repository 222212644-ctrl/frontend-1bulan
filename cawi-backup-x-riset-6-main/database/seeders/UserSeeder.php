<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            //tim 1
            [
                'name' => 'Arneta Diva Ramadhanti Sumantri',
                'email' => '212212518@stis.ac.id',
                'password' => Hash::make('arneta123'), // Ganti password sesuai kebutuhan
                'team_id' => 1,
                'nim' => '212212518',
                'no_hp' => '087835759491',
            ],
            [
                'name' => 'Yesha Ellisya Paulinka Lumban Gaol',
                'email' => '212212923@stis.ac.id',
                'password' => Hash::make('yesha123'), // Ganti password sesuai kebutuhan
                'team_id' => 1,
                'nim' => '212212923',
                'no_hp' => '0881010924800',
            ],
            [
                'name' => 'Adinda Safira Santoso Ayuningrum',
                'email' => '212212445@stis.ac.id',
                'password' => Hash::make('adinda123'), // Ganti password sesuai kebutuhan
                'team_id' => 1,
                'nim' => '212212445',
                'no_hp' => '081250075418',
            ],
            //tim 2
            [
                'name' => 'Yasmin Nur Alya Nabilah',
                'email' => '212212919@stis.ac.id',
                'password' => Hash::make('yasmin123'), // Ganti password sesuai kebutuhan
                'team_id' => 2,
                'nim' => '212212919',
                'no_hp' => '082142730011',
            ],
            [
                'name' => 'Titin Julianti br Tinambunan',
                'email' => '212212899@stis.ac.id',
                'password' => Hash::make('titin123'), // Ganti password sesuai kebutuhan
                'team_id' => 2,
                'nim' => '212212899',
                'no_hp' => '082179032491',
            ],
            [
                'name' => 'Karina Retno Yanwari',
                'email' => '212212689@stis.ac.id',
                'password' => Hash::make('karina123'), // Ganti password sesuai kebutuhan
                'team_id' => 2,
                'nim' => '212212689',
                'no_hp' => '081946991169',
            ],
            //tim 3
            [
                'name' => 'Mayza Hanif Abbad Mahardika',
                'email' => '212212711@stis.ac.id',
                'password' => Hash::make('mayza123'), // Ganti password sesuai kebutuhan
                'team_id' => 3,
                'nim' => '212212711',
                'no_hp' => '085878698669',
            ],
            [
                'name' => 'M. Taufiqur Rahman',
                'email' => '212212716@stis.ac.id',
                'password' => Hash::make('taufiqur123'), // Ganti password sesuai kebutuhan
                'team_id' => 3,
                'nim' => '212212716',
                'no_hp' => '082269723294',
            ],
            [
                'name' => 'Dara Sakina',
                'email' => '212212556@stis.ac.id',
                'password' => Hash::make('dara123'), // Ganti password sesuai kebutuhan
                'team_id' => 3,
                'nim' => '212212556',
                'no_hp' => '085161411522',
            ],
            //tim 4
            [
                'name' => 'Nadita Khairani',
                'email' => '212212780@stis.ac.id',
                'password' => Hash::make('yasmin123'), // Ganti password sesuai kebutuhan
                'team_id' => 4,
                'nim' => '212212780',
                'no_hp' => '082381480348',
            ],
            [
                'name' => 'Jauzie Falson',
                'email' => '212212679@stis.ac.id',
                'password' => Hash::make('jauzie123'), // Ganti password sesuai kebutuhan
                'team_id' => 4,
                'nim' => '212212679',
                'no_hp' => '081211950359',
            ],
            [
                'name' => 'Miranda Aulia',
                'email' => '212212733@stis.ac.id',
                'password' => Hash::make('miranda123'), // Ganti password sesuai kebutuhan
                'team_id' => 4,
                'nim' => '212212733',
                'no_hp' => '08999068048',
            ],
            //tim 5
            [
                'name' => 'Fransisca Anggiana Saputri',
                'email' => '212212616@stis.ac.id',
                'password' => Hash::make('fransisca123'), // Ganti password sesuai kebutuhan
                'team_id' => 5,
                'nim' => '212212616',
                'no_hp' => '0859159731398',
            ],
            [
                'name' => 'Umniyah Zhafirah',
                'email' => '212212901@stis.ac.id',
                'password' => Hash::make('umniyah123'), // Ganti password sesuai kebutuhan
                'team_id' => 5,
                'nim' => '212212901',
                'no_hp' => '082370527119',
            ],
            [
                'name' => 'Rafi Ariq Hakim',
                'email' => '212212826@stis.ac.id',
                'password' => Hash::make('rafi123'), // Ganti password sesuai kebutuhan
                'team_id' => 5,
                'nim' => '212212826',
                'no_hp' => '085817484808',
            ],
            // tim 6
            [
                'name' => 'Cahya Sabila',
                'email' => '212212542@stis.ac.id',
                'password' => Hash::make('cahya123'), // Ganti password sesuai kebutuhan
                'team_id' => 6,
                'nim' => '212212542',
                'no_hp' => '082210966712',
            ],
            [
                'name' => 'Muchammad Luthfi Affandy',
                'email' => '212212735@stis.ac.id',
                'password' => Hash::make('lutfhi123'), // Ganti password sesuai kebutuhan
                'team_id' => 6,
                'nim' => '212212735',
                'no_hp' => '089646396226',
            ],
            [
                'name' => 'Afina Zahrah Ananda Wibowo',
                'email' => '212212453@stis.ac.id',
                'password' => Hash::make('afina123'), // Ganti password sesuai kebutuhan
                'team_id' => 6,
                'nim' => '212212453',
                'no_hp' => '0895322263758',
            ],
            // tim 7
            [
                'name' => 'Az Zikri Reza Pahlevi',
                'email' => '212212529@stis.ac.id',
                'password' => Hash::make('zikri123'), // Ganti password sesuai kebutuhan
                'team_id' => 7,
                'nim' => '212212529',
                'no_hp' => '08995741634',
            ],
            [
                'name' => 'Ni Kadek Dwi Utami',
                'email' => '212212789@stis.ac.id',
                'password' => Hash::make('kadek123'), // Ganti password sesuai kebutuhan
                'team_id' => 7,
                'nim' => '212212789',
                'no_hp' => '083114011511',
            ],
            [
                'name' => 'Alfi Hidayatullah',
                'email' => '212212474@stis.ac.id',
                'password' => Hash::make('alfi123'), // Ganti password sesuai kebutuhan
                'team_id' => 7,
                'nim' => '212212474',
                'no_hp' => '083192968902',
            ],
            // tim 8
            [
                'name' => 'Hafidh Rean Putra',
                'email' => '212212631@stis.ac.id',
                'password' => Hash::make('hafidh123'), // Ganti password sesuai kebutuhan
                'team_id' => 8,
                'nim' => '212212631',
                'no_hp' => '083184628432',
            ],
            [
                'name' => 'M Fazlan Johan',
                'email' => '212212751@stis.ac.id',
                'password' => Hash::make('fazlan123'), // Ganti password sesuai kebutuhan
                'team_id' => 8,
                'nim' => '212212751',
                'no_hp' => '087743067289',
            ],
            [
                'name' => 'Adinda Batrisyibazla',
                'email' => '212212444@stis.ac.id',
                'password' => Hash::make('adinda123'), // Ganti password sesuai kebutuhan
                'team_id' => 8,
                'nim' => '212212444',
                'no_hp' => '081249222437',
            ],
            // tim 9
            [
                'name' => 'Nisrina Luthfia',
                'email' => '212212800@stis.ac.id',
                'password' => Hash::make('nisrina123'), // Ganti password sesuai kebutuhan
                'team_id' => 9,
                'nim' => '212212800',
                'no_hp' => '085173370501',
            ],
            [
                'name' => 'Afifah Dayan Syaharani',
                'email' => '212212451@stis.ac.id',
                'password' => Hash::make('afifah123'), // Ganti password sesuai kebutuhan
                'team_id' => 9,
                'nim' => '212212451',
                'no_hp' => '085702337463',
            ],
            [
                'name' => 'Yuliana Kartika Permadani',
                'email' => '212212927@stis.ac.id',
                'password' => Hash::make('yuliana123'), // Ganti password sesuai kebutuhan
                'team_id' => 9,
                'nim' => '212212927',
                'no_hp' => '082325414154',
            ],

        ];

        DB::table('users')->insert($users);
    }
}
