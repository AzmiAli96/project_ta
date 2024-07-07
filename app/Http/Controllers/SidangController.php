<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Ruangan;
use App\Models\Sesi;
use App\Models\Sidang;
use App\Models\TA;
use App\Models\tanggal;
use App\Models\Validasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SidangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sidang = Sidang::with([
            'ta'
        ])->latest()->paginate(10);
        return view('sidang.index', ['sidangs' => $sidang, ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $taTervalidasi = ta::where('status', '=', true )->where('status_p1', '=', true )->where('status_p2', '=', true )->get();

        return view('sidang.create', ['tas'=>$taTervalidasi, 'ruangans' => Ruangan::all(),'sesis' => Sesi::all(), 'dosens' => Dosen::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $validated = $request->validate([
                // 'validasi_id' => 'required',
                'ta_id' => 'required',
    'tanggal' => 'required|date',
    'ruangan_id' => 'required',
    'sesi_id' => 'required',
    'ketua_sidang' => 'required|exists:dosens,id|different:sekr_sidang,anggota1,anggota2',
    'sekr_sidang' => 'required|exists:dosens,id|different:ketua_sidang,anggota1,anggota2',
    'anggota1' => 'required|exists:dosens,id|different:ketua_sidang,sekr_sidang,anggota2',
    'anggota2' => 'required|exists:dosens,id|different:ketua_sidang,sekr_sidang,anggota1',
]);


$validator = Validator::make($request->all(), [
    'ta_id' => 'required',
    'tanggal' => 'required|date',
    'ruangan_id' => 'required',
    'sesi_id' => 'required',
    'ketua_sidang' => 'required|exists:dosens,id|different:sekr_sidang,anggota1,anggota2',
    'sekr_sidang' => 'required|exists:dosens,id|different:ketua_sidang,anggota1,anggota2',
    'anggota1' => 'required|exists:dosens,id|different:ketua_sidang,sekr_sidang,anggota2',
    'anggota2' => 'required|exists:dosens,id|different:ketua_sidang,sekr_sidang,anggota1',
]);

$validator->after(function ($validator) use ($request) {
    $tanggal = $request->input('tanggal');
    $sesi_id = $request->input('sesi_id');
    $dosens = [
        'ketua_sidang' => $request->input('ketua_sidang'),
        'sekr_sidang' => $request->input('sekr_sidang'),
        'anggota1' => $request->input('anggota1'),
        'anggota2' => $request->input('anggota2'),
    ];

    foreach ($dosens as $role => $dosen_id) {
        $exists = DB::table('sidangs')
            ->where($role, $dosen_id)
            ->where('tanggal', $tanggal)
            ->where('sesi_id', $sesi_id)
            ->exists();

        if ($exists) {
            $validator->errors()->add($role, "penguji $role sudah ada di  .");
        }
    }
});

if ($validator->fails()) {
    return redirect()->back()
        ->withErrors($validator)
        ->withInput();
}

        // $data = [
        //     "validasi_id	tanggal_id	sekr_sidang	anggota1	anggota2"
        // ];
        $sidang=Sidang::create($validated);
        activity()->causedBy(Auth::user())->log('User ' . auth()->user()->name . ' berhasil menambahkan data sidang dengan ID ' . $sidang->id);

        return redirect('/sidang')->with('pesan', 'berhasil menyimpan data.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sidang $sidang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('sidang.edit', ['tas' => TA::all(), 'dosens' => Dosen::all(),'ruangans' => Ruangan::all(),  'sesis' => Sesi::all(), 'sidang' => Sidang::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $validated = $request->validate([
            // 'validasi_id' => 'required',
            'ta_id' => 'required',
            'tanggal' => 'required',
            'ruangan_id' => 'required',
            'sesi_id' => 'required',
            'ketua_sidang' => 'required|exists:dosens,id|different:sekr_sidang,anggota1,anggota2',
            'sekr_sidang' => 'required|exists:dosens,id|different:ketua_sidang,anggota1,anggota2',
            'anggota1' => 'required|exists:dosens,id|different:ketua_sidang,sekr_sidang,anggota2',
            'anggota2' => 'required|exists:dosens,id|different:ketua_sidang,sekr_sidang,anggota1',
        ]);
        Sidang::where('id', $id)->update($validated);
        activity()->causedBy(Auth::user())->log('User ' . auth()->user()->name . ' berhasil mengupdate data sidang dengan ID ' . $id);

        return redirect('/sidang')->with('pesan', 'berhasil di-update.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        Sidang::destroy($id);
        activity()->causedBy(Auth::user())->log('User ' . auth()->user()->name . ' berhasil menghapus data sidang dengan ID ' . $id);

        return redirect('/sidang')->with('pesan', 'Berhasil Dihapuskan.');
    }
}
