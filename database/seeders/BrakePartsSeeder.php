<?php

namespace Database\Seeders;

use App\Models\InventoryLocation;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Facades
use Illuminate\Support\Facades\File;

class BrakePartsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = database_path('seeders/data/brake_parts.csv');

        if (!File::exists($path)) {
            $this->command->error("File not found at: $path");
            return;
        }

        $file = fopen($path, 'r');

        // Read the header
        $headers = fgetcsv($file, separator: ';');

        if (!$headers) {
            $this->command->error("CSV file is empty or invalid.");
            return;
        }

        while (($row = fgetcsv($file, separator: ';')) !== false) {
            $data = array_combine($headers, $row);

            $product                = Product::make();
            $product->internal_id   = $data['Reservedel Nummer.'];
            $product->name          = $data['Beskrivelse.'];

            $product->save();

            $inventoryLocation = InventoryLocation::where('name', $data['Lokation'])->first();

            if ($inventoryLocation) {
                $this->command->info('Attaching inventory location: ' . $inventoryLocation->name);
                $inventoryLocation->products()->attach($product->id, [
                    'quantity' => $data['Antal'],
                ]);
            } else {
                $this->command->info('Creating inventory location: ' . $data['Lokation']);
                $inventoryLocation = InventoryLocation::create([
                    'name' => $data['Lokation'],
                ]);

                $inventoryLocation->products()->attach($product->id, [
                    'quantity' => $data['Antal'],
                ]);
            }
        }

        fclose($file);

        $this->command->info('CSV data imported successfully.');
    }
}
