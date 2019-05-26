<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

use App\User;
use App\Today;
use App\Event;
use App\Major;
use App\Rombel;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $faker = Faker::create('id_ID');

        User::create([
            'name'=>'Haikal Fikri Luzain',
            'email'=>'haikalfikriluzain@gmail.com',
            'password'=>Hash::make('123456'),
        ]);

        $major = [['Rekayasa Perangkat Lunak','RPL'],['Otomatisasi Teknik Kerja Perkantoran','OTKP'],['Teknik Komputer dan Jaringan','TKJ'],['Bisnis Daring dan Pemasaran','BDP'],['Multimedia','MMD'],['Perhotelan','HTL'],['Tata Boga','TBG']];
        for ($i=0; $i < 7; $i++) { 
            Major::create([
                'name' => $major[$i][0],
                'alias' => $major[$i][1]
            ]);
        }

        Rombel::create([
            'major_id' => 1,
            'grade' => '12',
            'code' => 1,
            'student_total' => 39,
            'alias' => 'RPL XII-1'
        ]);

        $act = [
    		'Sholat duha bersama',
    		'Kegiatan belajar mengajar minggu genap',
    		'Rekruitmen untuk kelas 12',
    		'Kumpul rayon',
    		'Kegiatan Smartren'
    	];
    	$time = [
    		['06:50','07:30'],['07:30','13:30'],['08:30','15:00'],['13:30','14:00'],['07:30','14:30']
    	];

        for ($i=0; $i < 5; $i++) { 
        	Today::create([
        		'activity' => $act[$i],
        		'start' => $time[$i][0],
        		'end' => $time[$i][1],
        		'date' => Carbon::now(),
        		'admin_id' => 1
        	]);
        }

        Event::create([
            'title' => 'Kegiatan belajar mengajar minggu genap',
            'description' => 'Kegiatan belajar mengajar minggu genap',
            'start' => Carbon::now()->subDays(2),
            'end' => Carbon::now()->addDays(3),
            'color' => '#6777ef',
            'admin_id' => 1
        ]);
    }
}
