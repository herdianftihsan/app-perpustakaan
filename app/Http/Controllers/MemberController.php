<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreMemberRequest;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{

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
        $member = Member::with('loans.loanItems.book','loans.user')->findOrFail($id);
        

        return view('members.show',compact('member'));
        
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
