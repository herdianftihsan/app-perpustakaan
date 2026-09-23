<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreMemberRequest;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    private array $member = [
        ['id' => 1, 'nama' => 'Siti Aminah', 'nim' => '2310501001', 'email' => 'siti.aminah@pens.ac.id', 'nomor_telepon' => '081234567890', 'status' => 'aktif'],
        ['id' => 2, 'nama' => 'Budi Santoso', 'nim' => '2310501002', 'email' => 'budi.santoso@pens.ac.id', 'nomor_telepon' => '081298765432', 'status' => 'aktif'],
        ['id' => 3, 'nama' => 'Dewi Lestari', 'nim' => '2310501003', 'email' => 'dewi.lestari@pens.ac.id', 'nomor_telepon' => '081211122233', 'status' => 'nonaktif'],
    ];

    public function index()
    {
        $members = Member::when(
            request('search'),
            fn($query, $search) => $query->where('nama', 'like', "%{$search}%")
        )->paginate(10);

        return view('members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('members.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMemberRequest $request)
    {
        $validated = $request->validated();

        Member::create($validated);

        return redirect()->route('members.index')
            ->with('success', "Member \"{$validated['nama']}\" berhasil ditambahkan (data dummy, belum tersimpan ke database).");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $members = Member::finOrFail($id);
        

        return view('members.show',compact('members'));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $members = Member::findOrFail($id);
        return view('members.edit',compact('members'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $members = Member::findOrFail($id);

        $validate = $request->validate([
            'nama' => 'required|string|min:3',
            "nim" => 'required',
            'email' => 'required',
            'nomor_telepon' => 'required|min:12',
            'alamat' => 'required',
            'status' => 'required'
        ]);

        $members->update($validate);
        return redirect()->route('members.index')
            ->with('success', "Member \"{$validate['nama']}\" berhasil diperbarui (data dummy, belum tersimpan ke database).");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $members = Member::findOrFail($id);
        $members->delete();
        return redirect()->route('members.index')
            ->with('success', 'Kategori berhasil dihapus.');
        
    }
}
