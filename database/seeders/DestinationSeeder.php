<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\User;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    public function run(): void
    {
        $operator1 = User::where('email', 'operator1@jelaja.test')->first();
        if (! $operator1) {
            $this->call(UserSeeder::class);
            $operator1 = User::where('email', 'operator1@jelaja.test')->first();
        }

        Destination::query()->delete();

        Destination::create([
            'operator_id' => $operator1->id,
            'name' => 'TRMS Serulingmas Zoo',
            'price' => 25_000,
            'opening_hours' => 'Senin-Minggu 08:00 - 16:00 WIB, Tutup hari libur nasional',
            'opening_time' => '08:00',
            'closing_time' => '16:00',
            'description' => 'Kebun binatang edukatif di Banjarnegara dengan koleksi satwa yang beragam, wahana keluarga yang seru, dan area wisata ramah anak. Dilengkapi dengan fasilitas lengkap seperti area bermain, restoran, dan toko souvenir.',
            'location_maps_url' => 'https://maps.google.com/?q=Jalan+Selamanik+No.+35+Kutabanjarnegara+Banjarnegara+Jawa+Tengah+53418',
            'contact_phone' => '(0286) 591933',
            'image_url' => 'https://serulingmas.com/wp-content/uploads/2022/12/gajah-serulingmas.jpg',
            'social_media' => [
                'instagram' => '@serulingmas.zoo',
                'facebook' => 'Serulingmas Zoo Official',
            ],
            'most_booked' => 25,
        ]);
    }
}

