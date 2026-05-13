<?php

namespace App\Livewire\Pages\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Soal;
use App\Models\Pelajaran;
use App\Models\Jawaban;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Illuminate\Database\QueryException;

#[Layout('layouts.admin')]
class CrudUjian extends Component
{
    use WithPagination;

    public $soal_id, $pelajaran_id, $pertanyaan;
    public $jawabanList = [];
    public $jawabanBenarIndex = null;
    public $updateMode = false;
    public $selectedPelajaran = null;
    public $confirmedPelajaran = null;

    protected $rules = [
        'pelajaran_id' => 'required|integer|exists:pelajarans,id',
        'pertanyaan' => 'required|string',
        'jawabanList' => 'required|array|min:2',
        'jawabanBenarIndex' => 'required|integer',
    ];

    public function filterPelajaran()
    {
        try {
            $this->confirmedPelajaran = Pelajaran::findOrFail($this->selectedPelajaran);
            $this->pelajaran_id = $this->confirmedPelajaran->id;
        } catch (\Exception $e) {
            session()->flash('error', 'Pelajaran tidak ditemukan.');
        }
    }

    public function render()
    {
        $query = Soal::with('pelajaran', 'jawabans')
            ->where('sekolah_id', Auth::user()->sekolah_id);

        if ($this->pelajaran_id) {
            $query->where('pelajaran_id', $this->pelajaran_id);
        }

        return view('livewire.pages.admin.crud-ujian', [
            'soals' => $query->paginate(10),
            'pelajarans' => Pelajaran::all(),
        ]);
    }

    public function resetInput()
    {
        $this->soal_id = null;
        $this->pelajaran_id = null;
        $this->pertanyaan = null;
        $this->jawabanList = [];
        $this->jawabanBenarIndex = null;
        $this->updateMode = false;
    }

    public function store()
    {
        try {
            $this->validate();

            $soal = Soal::create([
                'pelajaran_id' => $this->pelajaran_id,
                'sekolah_id' => Auth::user()->sekolah_id,
                'pertanyaan' => $this->pertanyaan,
                'tipe' => 'pilihan_ganda',
            ]);

            foreach ($this->jawabanList as $index => $teks) {
                Jawaban::create([
                    'soal_id' => $soal->id,
                    'teks_jawaban' => $teks,
                    'is_benar' => ((int) $this->jawabanBenarIndex === (int) $index),
                ]);
            }

            session()->flash('success', 'Soal berhasil ditambahkan.');
            $this->resetInput();
        } catch (QueryException $e) {
            session()->flash('error', 'Gagal menyimpan soal: ' . $e->getMessage());
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $soal = Soal::with('jawabans')->findOrFail($id);
            $this->soal_id = $soal->id;
            $this->pelajaran_id = $soal->pelajaran_id;
            $this->pertanyaan = $soal->pertanyaan;
            $this->jawabanList = $soal->jawabans->pluck('teks_jawaban')->toArray();
            $this->jawabanBenarIndex = $soal->jawabans->search(fn($j) => $j->is_benar);
            $this->updateMode = true;
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal memuat soal: ' . $e->getMessage());
        }
    }

    public function update()
    {
        try {
            $this->validate();

            $soal = Soal::findOrFail($this->soal_id);
            $soal->update([
                'pelajaran_id' => $this->pelajaran_id,
                'pertanyaan' => $this->pertanyaan,
                'tipe' => 'pilihan_ganda',
            ]);

            $soal->jawabans()->delete();
            foreach ($this->jawabanList as $index => $teks) {
                Jawaban::create([
                    'soal_id' => $soal->id,
                    'teks_jawaban' => $teks,
                    'is_benar' => ((int) $this->jawabanBenarIndex === (int) $index),
                ]);
            }

            session()->flash('success', 'Soal berhasil diperbarui.');
            $this->resetInput();
        } catch (QueryException $e) {
            session()->flash('error', 'Gagal memperbarui soal: ' . $e->getMessage());
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            Soal::findOrFail($id)->delete();
            session()->flash('success', 'Soal berhasil dihapus.');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menghapus soal: ' . $e->getMessage());
        }
    }
}
