<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Riset4q2;

class Riset4q2Controller extends Controller
{
    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'kabupaten_kota' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'klasifikasi_wilayah' => 'required|string|in:Perkotaan,Pedesaan',
            'nomor_blok_sensus' => 'required|string|max:50',
            'kode_sls' => 'required|string|max:50',
            'nama_sls' => 'required|string|max:255',
            'pcl_nama' => 'required|string|max:255',
            'pcl_nim' => 'required|string|max:50',
            'pcl_jenis_kelamin' => 'required|in:L,P',
            'kortim_nama' => 'required|string|max:255',
            'kortim_nim' => 'required|string|max:50',
            'kortim_jenis_kelamin' => 'required|in:L,P',
            'kd_peta' => 'required|in:Ya,Tidak',
            'kd_daftar_sls' => 'required|in:Ya,Tidak',
            'kd_daftar_sampel_sls' => 'required|in:Ya,Tidak',
            'kd_bukped_listing' => 'required|in:Ya,Tidak',
            'kd_surat_tugas' => 'required|in:Ya,Tidak',
            'kd_surat_izin' => 'required|in:Ya,Tidak',
            'kelengkapan_instrumen' => 'required|in:Ya,Tidak',
            'salam_pembuka' => 'required|in:Ya,Tidak',
            'kesediaan_responden' => 'required|in:Ya,Tidak',
            'perkenalan' => 'required|in:Ya,Tidak',
            'tujuan_wawancara' => 'required|in:Ya,Tidak',
            'surat_tugas' => 'required|in:Ya,Tidak',
            'jaminan_kerahasiaan' => 'required|in:Ya,Tidak',
            'kondisi_lingkungan' => 'required|in:Ya,Tidak',
            'probing' => 'required|in:Ya,Tidak',
            'konfirmasi_ulang' => 'nullable|string|max:255',
            'pemahaman_konsep_dan_definisi' => 'nullable|string|max:255',
            'leading' => 'required|in:Ya,Tidak',
            'pertanyaan_interogatif' => 'required|in:Ya,Tidak',
            'pengulangan_pertanyaan' => 'required|integer|min:0',
            'metode_bertanya' => 'required|array', // Validasi array
            'metode_bertanya.*' => 'required|string|max:255', // Validasi elemen array
            'kewajaran' => 'required|in:Ya,Tidak',
            'pemberitahuan_revisit' => 'required|in:Ya,Tidak',
            'penutup_wawancara' => 'required|in:Ya,Tidak',
            'waktu' => 'required|integer|min:0',
        ]);

        $validatedData['metode_bertanya'] = implode(', ', $request->metode_bertanya);

        // Simpan data ke dalam model
        Riset4q2::create($validatedData);

        // Redirect ke halaman tertentu
        return redirect()->route('riset4q2.index')->with('success', 'Data berhasil disimpan.');
    }
}
