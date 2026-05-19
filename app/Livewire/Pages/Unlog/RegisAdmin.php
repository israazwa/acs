<?php

namespace App\Livewire\Pages\Unlog;


use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\requestAdmin;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
#[Layout('layouts.guest')]
class RegisAdmin extends Component
{
    use WithFileUploads;
    public $name, $email, $password, $password_confirmation;
    public $sekolah, $alamat;
    public $ktp;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:request_admins,email',
        'password' => 'required|min:6|confirmed',
        'sekolah' => 'required|string|max:255',
        'alamat' => 'required|string',
        'ktp' => 'required|file|mimes:jpg,jpeg,png',
    ];

    public function submit()
    {
        try {
            $this->validate();

            // Buat nama file unik
            $uniqueName = uniqid('ktp_') . '.' . $this->ktp->getClientOriginalExtension();

            // Simpan file KTP ke folder reqAdmin dengan nama unik
            $ktpPath = $this->ktp->storeAs('reqAdmin', $uniqueName, 'public');

            RequestAdmin::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'sekolah' => $this->sekolah,
                'alamat' => $this->alamat,
                'catatan' => $this->password,
                'ktp_path' => $ktpPath,
                'status_permintaan' => 'menunggu',
            ]);

            session()->flash('success', 'Permintaan registrasi berhasil dikirim. Tunggu verifikasi Superadmin.');
            $this->reset();

        } catch (\Illuminate\Validation\ValidationException $e) {
            session()->flash('error', 'Validasi gagal: ' . $e->getMessage());
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }




    public function render()
    {
        return view('livewire.pages.unlog.regis-admin');
    }
}
