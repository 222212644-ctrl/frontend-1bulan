<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Peta Usaha')]
class PetaUsaha extends Component
{
    public $search = '';
    public $kabupaten_kota = '';
    public $kecamatan = '';
    public $kelurahan_desa = '';
    public $maps = [];
    public $kabupatenOptions = [];

    public function resetFilters()
    {
        $this->reset(['search', 'kabupaten_kota', 'kecamatan', 'kelurahan_desa', 'maps']);
    }

    public function mount()
    {
        $this->loadKabupatenOptions();
    }

    public function loadKabupatenOptions()
    {
        $this->kabupatenOptions = collect(json_decode(file_get_contents(public_path('geojson/data_pkl_kabupaten.geojson')), true)['features'])
            ->map(fn($feature) => [
                'kode' => $feature['properties']['kodekab'],
                'nama' => $feature['properties']['nama_wilayah']
            ])
            ->unique('kode')
            ->values()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.peta-usaha');
    }
}
