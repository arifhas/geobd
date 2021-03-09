<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Division;
use App\Models\PostOffice;
use App\Models\Thana;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // if(Division::count() == 0) {
        //     $this->loadFromSQL();
        // } else if(PostOffice::count() == 0) {
        //     $this->loadFromCSV();
        // }

        $this->loadFromCSV();
    }

    public function loadFromSQL()
    {
        $file_path = __DIR__ . '/data/geobd.sql';
        $content = file_get_contents($file_path );

        DB::unprepared($content);
    }

    public function loadFromCSV()
    {
        $file_path = __DIR__ . '/data/geobd.csv';

        $row = 0;
        if (($handle = fopen($file_path, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $row++;
                if($row == 1) {
                    $division_key = array_search("Division", $data);
                    $district_key = array_search("District", $data);
                    $thana_key = array_search("Thana", $data);
                    $post_office_key = array_search("Post Office", $data);
                    $post_code_key = array_search("Post Code", $data);
                    continue;
                }
                $division_name = trim($data[$division_key]);
                $district_name = trim($data[$district_key]);
                $thana_name = trim($data[$thana_key]);
                $post_office_name = trim($data[$post_office_key]);
                $post_office_code = trim($data[$post_code_key]);

                $division = Division::updateOrCreate(['name' => $division_name]);

                $district = District::updateOrCreate(['name' => $district_name, 'division_id' => $division->id]);

                $thana = Thana::updateOrCreate(['name' => $thana_name, 'district_id' => $district->id]);

                PostOffice::create(['name' => $post_office_name, 'code' => $post_office_code, 'thana_id' => $thana->id]);

                echo "{$post_office_name} in line $row:\n";
            }
            fclose($handle);
        }

    }
}
