<?php

namespace Tests\Feature;

use App\Models\Loan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class LoanReturnTest extends TestCase
{
    use RefreshDatabase;

    public function test_returning_a_loan_updates_its_status_and_return_date(): void
    {
        $memberId = DB::table('members')->insertGetId([
            'nama' => 'Anggota Tes',
            'nim' => 'TEST-001',
            'email' => 'anggota@example.test',
            'nomor_telepon' => '081234567890',
            'alamat' => 'Alamat tes',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $userId = DB::table('users')->insertGetId([
            'name' => 'Petugas Tes',
            'email' => 'petugas@example.test',
            'password' => bcrypt('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $loan = Loan::create([
            'member_id' => $memberId,
            'user_id' => $userId,
            'tanggal_pinjam' => now()->subDays(2)->toDateString(),
            'tanggal_kembali' => now()->addDays(5)->toDateString(),
        ]);

        $today = now()->toDateString();
        $response = $this->put(route('loans.kembalikan', $loan->id));

        $response->assertRedirect(route('loans.index'));
        $response->assertSessionHas('success', 'Buku berhasil dikembalikan.');
        $this->assertDatabaseHas('loans', [
            'id' => $loan->id,
            'status' => 'dikembalikan',
            'tanggal_dikembalikan' => $today,
        ]);
    }
}
