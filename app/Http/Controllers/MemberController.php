<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreMemberRequest;


use Illuminate\Http\Request;

class MemberController extends Controller
{   
    private array $member = [
        ['id'=>1,'nama' => 'Herdian','nim' => '4567432','email' => 'herdian@gmail.com','nomor_telepon' =>'082121313123','alamat' => 'di gebang rt.1','status' => 'aktif'],
        ['id'=>2,'nama' => 'gema','nim' => '4567432','email' => 'gema@gmail.com','nomor_telepon'=>'082121313123','alamat' => 'di gebang rt.3','status' => 'aktif'],
        ['id'=>3,'nama' => 'Alvin','nim' => '4567432','email' => 'alvin@gmail.com','nomor_telepon'=>'082121313123','alamat' => 'di keputih rt.1','status' => 'aktif'],
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = $this->member;

        return view('members.index',compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $members = $this->member;
        
        return view('members.create',compact('members'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMemberRequest $request)
    {
        $validated = $request->validated();

        return redirect()->route('members.index')
            ->with('success', "Member \"{$validated['nama']}\" berhasil ditambahkan (data dummy, belum tersimpan ke database).");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return "MemberController@show,id: {$id}";
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return "MemberController@edit,id:{$id}";
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return "MemberController@update,id:{$id}";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return "MemberController@destroy,id:{$id}";
        
    }
}
