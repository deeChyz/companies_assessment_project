<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $statuses = ['active', 'inactive', 'pending'];
        $types = ['rvm', 'type1', 'type2', 'type3'];

        $count = (int) $this->command->ask('How many companies you want to seed?', 10);
        $batchSize = 250;

        $this->command->info("Seeding $count companies in batches of $batchSize...");

        $this->seedInBatches($count, $batchSize, $statuses, $types);
    }

    /**
     * Seed data in batches.
     * Decided to use more declarative way of bringing up the inners of the seeder process and options representation
     *
     * @param int $count
     * @param int $batchSize
     * @param array $statuses
     * @param array $types
     * @return void
     */
    protected function seedInBatches(int $count, int $batchSize, array $statuses, array $types): void
    {
        $data = [];

        for ($i = 1; $i <= $count; $i++) {
            $data[] = [
                'name' => 'Campaign ' . $i,
                'order' => rand(1, $count),
                'type' => $types[array_rand($types)],
                'status' => $statuses[array_rand($statuses)],
                'start_date' => Carbon::now()->subDays(rand(1, 365)),
            ];

            if ($i % $batchSize === 0 || $i === $count) {
                DB::table('campaigns')->insert($data);
                $data = [];
                $this->command->info("Seeded $i companies...");
            }
        }

        $this->command->info("$count companies seeded successfully!");
    }
}
