<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Sektor;
use App\Models\Kode2Digit;
use App\Models\Kode3Digit;
use App\Models\Kode4Digit;
use App\Models\Kode5Digit;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Http;


#[Title('KBLI')]
class KBLI extends Component
{
    public $sectors = [];
    public $judul = [];
    public $deskripsi = [];
    public $is_ekraf;
    public $selectedSector = null;
    public $selectedKode2Digit = null;
    public $selectedKode3Digit = null;
    public $selectedKode4Digit = null;
    public $selectedKode5Digit = null;
    public $kode2Digit = [];
    public $kode3Digit = [];
    public $kode4Digit = [];
    public $kode5Digit = [];
    public $query;
    public $searchResult = [];
    public $dummySearchResult = [];
    public $showSearchResult = false;

    public function sektorDetail($kode)
    {
        $sektor = Sektor::where('kode_sektor', $kode)->first();
        if ($sektor) {
            $this->selectedSector = $sektor->kode_sektor;
            $this->judul[0] = $sektor->judul;
            $this->deskripsi[0] = $sektor->deskripsi;
            $this->kode2Digit = Kode2Digit::where('kode_sektor_id', $sektor->id)->get()->toArray();
        }
    }

    public function Digit2Detail($kode)
    {
        $kode2 = Kode2Digit::where('kode_2_digit', $kode)->first();
        if ($kode2) {
            $this->selectedKode2Digit = $kode2->kode_2_digit;
            $this->judul[1] = $kode2->judul;
            $this->deskripsi[1] = $kode2->deskripsi;
            $this->kode3Digit = Kode3Digit::where('kode_2_digit_id', $kode2->id)->get()->toArray();
        }
    }

    public function Digit3Detail($kode)
    {
        $kode3 = Kode3Digit::where('kode_3_digit', $kode)->first();
        if ($kode3) {
            $this->selectedKode3Digit = $kode3->kode_3_digit;
            $this->judul[2] = $kode3->judul;
            $this->deskripsi[2] = $kode3->deskripsi;
            $this->kode4Digit = Kode4Digit::where('kode_3_digit_id', $kode3->id)->get()->toArray();
        }
    }

    public function Digit4Detail($kode)
    {
        $kode4 = Kode4Digit::where('kode_4_digit', $kode)->first();
        if ($kode4) {
            $this->selectedKode4Digit = $kode4->kode_4_digit;
            $this->judul[3] = $kode4->judul;
            $this->deskripsi[3] = $kode4->deskripsi;
            $this->kode5Digit = Kode5Digit::where('kode_4_digit_id', $kode4->id)->get()->toArray();
        }
    }

    public function Digit5Detail($kode)
    {
        $kode5 = Kode5Digit::where('kode_5_digit', $kode)->first();
        if ($kode5) {
            $this->selectedKode5Digit = $kode5->kode_5_digit;
            $this->judul[4] = $kode5->judul;
            $this->deskripsi[4] = $kode5->deskripsi;
        }
    }

    public function Digit5Search($kode)
    {
        $kode5 = Kode5Digit::where('kode_5_digit', $kode)->first();
        if ($kode5) {
            $this->selectedKode5Digit = $kode5->kode_5_digit;
            $this->judul[4] = $kode5->judul;
            $this->deskripsi[4] = $kode5->deskripsi;
            $this->is_ekraf = $kode5->is_ekraf;
        }
        $kode4 = Kode4Digit::where('id', $kode5->kode_4_digit_id)->first();
        if ($kode4) {
            $this->selectedKode4Digit = $kode4->kode_4_digit;
            $this->judul[3] = $kode4->judul;
            $this->deskripsi[3] = $kode4->deskripsi;
            $this->kode5Digit = Kode5Digit::where('kode_4_digit_id', $kode4->id)->get()->toArray();
        }
        $kode3 = Kode3Digit::where('id', $kode4->kode_3_digit_id)->first();
        if ($kode3) {
            $this->selectedKode3Digit = $kode3->kode_3_digit;
            $this->judul[2] = $kode3->judul;
            $this->deskripsi[2] = $kode3->deskripsi;
            $this->kode4Digit = Kode4Digit::where('kode_3_digit_id', $kode3->id)->get()->toArray();
        }
        $kode2 = Kode2Digit::where('id', $kode3->kode_2_digit_id)->first();
        if ($kode2) {
            $this->selectedKode2Digit = $kode2->kode_2_digit;
            $this->judul[1] = $kode2->judul;
            $this->deskripsi[1] = $kode2->deskripsi;
            $this->kode3Digit = Kode3Digit::where('kode_2_digit_id', $kode2->id)->get()->toArray();
        }
        $sektor = Sektor::where('kode_sektor', $kode5->sektor)->first();
        if ($sektor) {
            $this->selectedSector = $sektor->kode_sektor;
            $this->judul[0] = $sektor->judul;
            $this->deskripsi[0] = $sektor->deskripsi;
        }
        $this->dummySearchResult = $this->searchResult;
        $this->searchResult = [];
    }

    public function backToSearchResult()
    {
        $this->searchResult = $this->dummySearchResult;
        $this->dummySearchResult = [];
    }

    public function mount()
    {
        // Ambil data dari tabel sektor
        $this->sectors = Sektor::orderBy('kode_sektor')->get();
    }

    // Search function
    public function searchKode()
    {
        //Database sudah menerapkan full text search pada kolom description_generate, deskripsi, kode_5_digit, dan judul
        //caranya dengan ALTER TABLE kode5_digit ADD FULLTEXT(description_generate, deskripsi, kode_5_digit);
        $this->searchResult = Kode5Digit::selectRaw("
                sektor,
                kode_5_digit,
                judul,
                deskripsi,
                is_ekraf,
                MATCH(kode_5_digit,judul) AGAINST(? IN NATURAL LANGUAGE MODE) as relevance
            ", [$this->query])
            ->whereRaw("MATCH(kode_5_digit, judul) AGAINST(? IN NATURAL LANGUAGE MODE)", [$this->query])
            ->orderByDesc('relevance') // Urutkan berdasarkan kecocokan
            ->take(10)
            ->get()
            ->map(function ($item) {
                return [
                    'sector' => substr($item->sektor, 0, 1),
                    'kode_5_digit' => $item->kode_5_digit,
                    'judul' => $item->judul,
                    'deskripsi' => $item->deskripsi,
                    'is_ekraf' => $item->is_ekraf,
                ];
            });
    }

    public function search()
    {
        $apiUrl = "https://ds.stis.ac.id/pkl64/predict/";

        try {
            // Kirim request ke API
            $response = Http::get($apiUrl, [
                'description' => $this->query,
                'top_k' => 10,
            ]);

            // Periksa apakah request berhasil (status code 200)
            if ($response->successful()) {
                $data = $response->json();

                // Pastikan 'predictions' ada di response
                if (!isset($data['predictions'])) {
                    throw new \Exception("API tidak mengembalikan predictions.");
                }

                $predictions = collect($data['predictions']);

                // Ambil kode KBLI dari hasil prediksi
                $kbliCodes = $predictions->pluck('label')->toArray();

                // Cari informasi tambahan dari database berdasarkan kode KBLI
                $kbliData = Kode5Digit::whereIn('kode_5_digit', $kbliCodes)->get()->keyBy('kode_5_digit');

                // Gabungkan hasil prediksi API dengan informasi dari database
                $this->searchResult = $predictions->map(function ($prediction) use ($kbliData) {
                    $kode = $prediction['label'];
                    $kbliInfo = $kbliData[$kode] ?? null;

                    return [
                        'sector' => $kbliInfo ? substr($kbliInfo->sektor, 0, 1) : 'N/A',
                        'kode_5_digit' => $kode,
                        'judul' => $kbliInfo ? $kbliInfo->judul : 'Judul tidak ditemukan',
                        'deskripsi' => $kbliInfo ? $kbliInfo->deskripsi : 'Deskripsi tidak ditemukan',
                        'is_ekraf' => $kbliInfo ? $kbliInfo->is_ekraf : false,
                        'probability' => round($prediction['probability'] * 100, 2) . '%',
                    ];
                });
            } else {
                throw new \Exception("Gagal menghubungi API. Status code: " . $response->status());
            }
        } catch (\Exception $e) {
            // Jika terjadi error, tampilkan pesan error dan kosongkan hasil pencarian
            $this->searchResult = [];
            session()->flash('error', "Terjadi kesalahan: " . $e->getMessage());
        }
    }


    public function render()
    {
        return view(
            'livewire.kbli'
        );
    }

    public function goBack($level)
    {
        if ($level == 'sector') {
            $this->selectedSector = null;
            $this->selectedKode2Digit = null;
            $this->selectedKode3Digit = null;
            $this->selectedKode4Digit = null;
            $this->selectedKode5Digit = null;
        } elseif ($level == 'kode2digit') {
            $this->sektorDetail($this->selectedSector);
            $this->selectedKode2Digit = null;
            $this->selectedKode3Digit = null;
            $this->selectedKode4Digit = null;
            $this->selectedKode5Digit = null;
            // Kembalikan ke judul yang sesuai dengan kode dua digit
        } elseif ($level == 'kode3digit') {
            $this->Digit2Detail($this->selectedKode2Digit);
            $this->selectedKode3Digit = null;
            $this->selectedKode4Digit = null;
            $this->selectedKode5Digit = null;
        } elseif ($level == 'kode4digit') {
            $this->Digit3Detail($this->selectedKode3Digit);
            $this->selectedKode4Digit = null;
            $this->selectedKode5Digit = null;
        } elseif ($level == 'kode5digit') {
            $this->Digit4Detail($this->selectedKode4Digit);
            $this->selectedKode5Digit = null;
        }
    }
}
