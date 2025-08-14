<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamAndSLSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = [
            'Tim 1',
            'Tim 2',
            'Tim 3',
            'Tim 4',
            'Tim 5',
            'Tim 6',
            'Tim 7',
            'Tim 8',
            'Tim 9'
        ];

        foreach ($teams as $team) {
            DB::table('teams')->insert([
                'name' => $team
            ]);
        }

        // Menambahkan data sls dan menghubungkannya dengan team_id
        $teamsData = [
            'Tim 1' => ['RT 002 RW 004', 'RT 008 RW 004', 'RT 009 RW 004', 'RT 010 RW 004'],
            'Tim 2' => ['RT 006 RW 015', 'RT 007 RW 015', 'RT 008 RW 015', 'RT 009 RW 015', 'RT 010 RW 015'],
            'Tim 3' => ['RT 001 RW 015', 'RT 002 RW 015', 'RT 003 RW 015', 'RT 005 RW 015'],
            'Tim 4' => ['RT 001 RW 004', 'RT 005 RW 004', 'RT 004 RW 015'],
            'Tim 5' => ['RT 003 RW 004', 'RT 004 RW 004', 'RT 006 RW 004', 'RT 007 RW 004'],
            'Tim 6' => ['RT 006 RW 002', 'RT 007 RW 002', 'RT 008 RW 002', 'RT 012 RW 002', 'RT 013 RW 002', 'RT 014 RW 002'],
            'Tim 7' => ['RT 002 RW 002', 'RT 003 RW 002', 'RT 004 RW 002'],
            'Tim 8' => ['RT 001 RW 002'],
            'Tim 9' => ['RT 005 RW 002', 'RT 010 RW 002', 'RT 011 RW 002'],
        ];

        $slsData = [
            ['sls' => 10, 'nm_sls' => 'RT 001 RW 002'],
            ['sls' => 11, 'nm_sls' => 'RT 002 RW 002'],
            ['sls' => 12, 'nm_sls' => 'RT 003 RW 002'],
            ['sls' => 13, 'nm_sls' => 'RT 004 RW 002'],
            ['sls' => 14, 'nm_sls' => 'RT 005 RW 002'],
            ['sls' => 15, 'nm_sls' => 'RT 006 RW 002'],
            ['sls' => 16, 'nm_sls' => 'RT 007 RW 002'],
            ['sls' => 17, 'nm_sls' => 'RT 008 RW 002'],
            ['sls' => 19, 'nm_sls' => 'RT 010 RW 002'],
            ['sls' => 20, 'nm_sls' => 'RT 011 RW 002'],
            ['sls' => 21, 'nm_sls' => 'RT 012 RW 002'],
            ['sls' => 22, 'nm_sls' => 'RT 013 RW 002'],
            ['sls' => 23, 'nm_sls' => 'RT 014 RW 002'],
            ['sls' => 36, 'nm_sls' => 'RT 001 RW 004'],
            ['sls' => 37, 'nm_sls' => 'RT 002 RW 004'],
            ['sls' => 38, 'nm_sls' => 'RT 003 RW 004'],
            ['sls' => 39, 'nm_sls' => 'RT 004 RW 004'],
            ['sls' => 40, 'nm_sls' => 'RT 005 RW 004'],
            ['sls' => 41, 'nm_sls' => 'RT 006 RW 004'],
            ['sls' => 42, 'nm_sls' => 'RT 007 RW 004'],
            ['sls' => 43, 'nm_sls' => 'RT 008 RW 004'],
            ['sls' => 44, 'nm_sls' => 'RT 009 RW 004'],
            ['sls' => 45, 'nm_sls' => 'RT 010 RW 004'],
            ['sls' => 165, 'nm_sls' => 'RT 001 RW 015'],
            ['sls' => 166, 'nm_sls' => 'RT 002 RW 015'],
            ['sls' => 167, 'nm_sls' => 'RT 003 RW 015'],
            ['sls' => 168, 'nm_sls' => 'RT 004 RW 015'],
            ['sls' => 169, 'nm_sls' => 'RT 005 RW 015'],
            ['sls' => 170, 'nm_sls' => 'RT 006 RW 015'],
            ['sls' => 171, 'nm_sls' => 'RT 007 RW 015'],
            ['sls' => 172, 'nm_sls' => 'RT 008 RW 015'],
            ['sls' => 173, 'nm_sls' => 'RT 009 RW 015'],
            ['sls' => 174, 'nm_sls' => 'RT 010 RW 015'],
        ];

        // Menambahkan data sls dan mengaitkan dengan tim
        foreach ($slsData as $index => $sls) {
            $teamName = $this->getTeamNameForSls($sls['nm_sls'], $teamsData);
            $team = DB::table('teams')->where('name', $teamName)->first();

            DB::table('sls')->insert([
                'sls' => $sls['sls'],
                'nm_sls' => $sls['nm_sls'],
                'team_id' => $team->id, // Mengaitkan dengan team_id
            ]);
        }
    }
    private function getTeamNameForSls($slsName, $teamsData)
    {
        foreach ($teamsData as $teamName => $slsList) {
            if (in_array($slsName, $slsList)) {
                return $teamName;
            }
        }

        return null; // Jika tidak ditemukan
    }
}
