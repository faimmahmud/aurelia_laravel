<?php

namespace Database\Seeders;

use App\Models\Package;
use App\Models\PackageFeature;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $packages = [
            [
                'id' => 'pkg-mald',
                'title' => 'Maldives Horizon Escape',
                'country' => 'Maldives',
                'price' => '$2,890',
                'rating' => '4.9',
                'days' => '6 Days',
                'image' => 'https://picsum.photos/seed/pkg-maldives/1600/1000',
                'description' => 'Private villas, quiet beaches, and a luxury experience shaped around calm.',
                'category' => 'beach',
                'details' => ['Private villa', 'Airport lounge', 'Sea excursions', 'Spa access'],
            ],
            [
                'id' => 'pkg-swiss',
                'title' => 'Swiss Alpine Signature',
                'country' => 'Switzerland',
                'price' => '$3,740',
                'rating' => '5.0',
                'days' => '8 Days',
                'image' => 'https://picsum.photos/seed/pkg-switzerland/1600/1000',
                'description' => 'A refined mountain journey with rail routes, lakeside stays, and scenic stops.',
                'category' => 'mountain',
                'details' => ['Rail pass', 'Lake-view suites', 'Private guide', 'Fondue evenings'],
            ],
            [
                'id' => 'pkg-dubai',
                'title' => 'Dubai Future Luxe',
                'country' => 'UAE',
                'price' => '$2,150',
                'rating' => '4.8',
                'days' => '5 Days',
                'image' => 'https://picsum.photos/seed/pkg-dubai/1600/1000',
                'description' => 'High-rise views, desert highlights, and an ultra-modern city mood.',
                'category' => 'city',
                'details' => ['Sky lounge', 'Desert safari', 'VIP transfers', 'City tour'],
            ],
            [
                'id' => 'pkg-bali',
                'title' => 'Bali Calm Retreat',
                'country' => 'Indonesia',
                'price' => '$1,980',
                'rating' => '4.9',
                'days' => '7 Days',
                'image' => 'https://picsum.photos/seed/pkg-bali/1600/1000',
                'description' => 'Beach serenity, wellness experiences, and a design-led resort stay.',
                'category' => 'beach',
                'details' => ['Spa ritual', 'Jungle suite', 'Private pool', 'Beach club'],
            ],
            [
                'id' => 'pkg-paris',
                'title' => 'Paris Iconic Week',
                'country' => 'France',
                'price' => '$2,430',
                'rating' => '4.7',
                'days' => '4 Days',
                'image' => 'https://picsum.photos/seed/pkg-paris/1600/1000',
                'description' => 'A polished European escape built around culture, cuisine, and elegant stays.',
                'category' => 'city',
                'details' => ['City pass', 'Fine dining', 'Private driver', 'Boutique hotel'],
            ],
            [
                'id' => 'pkg-iceland',
                'title' => 'Iceland Aurora Journey',
                'country' => 'Iceland',
                'price' => '$3,110',
                'rating' => '5.0',
                'days' => '6 Days',
                'image' => 'https://picsum.photos/seed/pkg-iceland/1600/1000',
                'description' => 'Frozen landscapes, warm lodges, and dramatic scenery built for storytelling.',
                'category' => 'nature',
                'details' => ['Northern lights', 'Hot springs', 'Lodges', 'Scenic drive'],
            ],
        ];

        foreach ($packages as $data) {
            $details = $data['details'];
            unset($data['details']);

            $package = Package::updateOrCreate(['id' => $data['id']], $data);

            $package->features()->delete();
            foreach ($details as $i => $feature) {
                PackageFeature::create([
                    'package_id' => $package->id,
                    'feature' => $feature,
                    'sort_order' => $i,
                ]);
            }
        }
    }
}
