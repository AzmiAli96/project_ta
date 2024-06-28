<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Penjumlahan;
use Illuminate\Http\Request;

class PenjumlahanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $penjumlahan=Penjumlahan::latest()->paginate(10);
        // return view ('nilai.edit', ['penjumlahans'=>$penjumlahan]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        return view('nilai.D4', ['nilais' => Nilai::all(), 'penjumlahan' => Penjumlahan::find($id)]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nilai_id' => 'required',
            'penilai' => 'required',
            'n1' => 'nullable',
            'n2' => 'nullable',
            'n3' => 'nullable',
            'n4' => 'nullable',
            'n5' => 'nullable',
            'n6' => 'nullable',
            'n7' => 'nullable',
            'n8' => 'nullable',
            'n9' => 'nullable',
            'n10' => 'nullable',
            'ket' => 'required',
        ]);
        Penjumlahan::create($validated);
        return redirect('/nilai')->with('pesan', 'berhasil menyimpan data.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penjumlahan $penjumlahan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $jenjang = request('jenjang');
        $penilai = request('penilai');
        $nilai = Nilai::find(request('nilai_id'));

        if (!$nilai) {
            return redirect()->back()->withErrors(['msg' => 'Nilai not found.']);
        }

        $penjumlahan = Penjumlahan::withNilaiIdAndPenilai(request('nilai_id'), $penilai)->first();
        
        if (!$penjumlahan) {
            $penjumlahan = Penjumlahan::create([
                'nilai_id' => $nilai->id,
                'penilai' => $penilai,
            ]);
        }
        if ($jenjang == 'D3') {
            return view('nilai.D3')->with([
                'nilais' => $nilai,
                'penjumlahan' => $penjumlahan,
                'penilai' => $penilai
            ]);
        } else {
            return view('nilai.D4')->with([
                'nilais' => $nilai,
                'penjumlahan' => $penjumlahan,
                'penilai' => $penilai
            ]);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $request->validate([
            'n1' => 'nullable|numeric',
            'n2' => 'nullable|numeric',
            'n3' => 'nullable|numeric',
            'n4' => 'nullable|numeric',
            'n5' => 'nullable|numeric',
            'n6' => 'nullable|numeric',
            'n7' => 'nullable|numeric',
            'n8' => 'nullable|numeric',
            'n9' => 'nullable|numeric',
            'n10' => 'nullable|numeric',
            'ket' => 'required',
        ]);

        $jenjang = request('jenjang');
        $total_nilai = 0;

        if ($jenjang == 'D4') {
            $n1 = $request->input('n1');
            $n2 = $request->input('n2');
            $n3 = $request->input('n3');
            $n4 = $request->input('n4');
            $n5 = $request->input('n5');
            $n6 = $request->input('n6');
            $n7 = $request->input('n7');
            $n8 = $request->input('n8');
            $n9 = $request->input('n9');
            $n10 = $request->input('n10');
            $total_nilai = ($n1 * 0.05) + ($n2 * 0.05) + ($n3 * 0.2) + ($n4 * 0.05) + ($n5 * 0.05) + ($n6 * 0.1) + ($n7 * 0.15) + ($n8 * 0.05) + ($n9 * 0.05) + ($n10 * 0.25);
        } else {
            if ($jenjang == 'D3') {
                $n1 = $request->input('n1');
                $n2 = $request->input('n2');
                $n3 = $request->input('n3');
                $n4 = $request->input('n4');
                $n5 = $request->input('n5');
                $n6 = $request->input('n6');
                $n7 = $request->input('n7');
                $n8 = $request->input('n8');
                $n9 = $request->input('n9');
                $n10 = $request->input('n10');
                $total_nilai = ($n1 * 0.05) + ($n2 * 0.05) + ($n3 * 0.2) + ($n4 * 0.05) + ($n5 * 0.05) + ($n6 * 0.1) + ($n7 * 0.15) + ($n8 * 0.05) + ($n9 * 0.05);
            }
        }

        $nilai_id = $request->input('nilai_id');
        $penilai = $request->input('penilai');

        $pe = Penjumlahan::withNilaiIdAndPenilai($nilai_id, $penilai);
        dd($pe);
        $pe->update([
            'n1' => $request->input('n1'),
            'n2' => $request->input('n2'),
            'n3' => $request->input('n3'),
            'n4' => $request->input('n4'),
            'n5' => $request->input('n5'),
            'n6' => $request->input('n6'),
            'n7' => $request->input('n7'),
            'n8' => $request->input('n8'),
            'n9' => $request->input('n9'),
            'n10' => $request->input('n10'),
            'total_nilai' => $total_nilai
        ]);
        return redirect('/nilai')->with('pesan', 'berhasil di-update.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Penjumlahan::destroy($id);
        return redirect('/nilai')->with('pesan', 'Berhasil Dihapuskan.');
    }
}
