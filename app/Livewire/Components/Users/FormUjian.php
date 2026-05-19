<?php

namespace App\Livewire\Components\Users;

use App\Models\hasilTest;
use App\Models\jawaban;
use Livewire\Component;
use App\Models\Pelajaran;
use Illuminate\Support\Facades\Auth;

use Livewire\Attributes\Layout;
use Livewire\WithPagination;
#[Layout('layouts.app')]
class FormUjian extends Component
{
    public $pelajaran;
    public $soals;
    public $answers = [];
    public $page = 1; // halaman soal
    public $perPage = 4; // jumlah soal per halaman

    public function mount($pelajaranId)
    {
        $this->pelajaran = Pelajaran::findOrFail($pelajaranId);
        $existingResult = HasilTest::where('user_id', Auth::id())
            ->where('pelajaran_id', $this->pelajaran->id)
            ->latest()
            ->first();

        if ($existingResult) {
            return redirect()->route('ujian.hasil', $this->pelajaran->id);
        }

        $this->soals = $this->pelajaran->soals()
            ->with('jawabans')
            ->get()
            ->shuffle()
            ->values();
    }

    public function nextPage()
    {
        if ($this->page < ceil($this->soals->count() / $this->perPage)) {
            $this->page++;
        }
    }

    public function prevPage()
    {
        if ($this->page > 1) {
            $this->page--;
        }
    }

    public function submit()
    {
        $benarCount = 0;
        $totalSoal = $this->soals->count();

        foreach ($this->answers as $soalId => $jawabanId) {
            $jawaban = jawaban::find($jawabanId);

            Auth::user()->jawabanSiswa()->create([
                'soal_id' => $soalId,
                'jawaban_id' => $jawabanId,
                'jawaban' => $jawaban->teks_jawaban,
                'is_benar' => $jawaban->is_benar,
            ]);

            if ($jawaban->is_benar) {
                $benarCount++;
            }
        }
        $skor = ($benarCount / $totalSoal) * 100;

        if ($skor < 60) {
            $sts = false;
        } else {
            $sts = true;
        }
        ;

        hasilTest::create([
            'user_id' => Auth::id(),
            'pelajaran_id' => $this->pelajaran->id,
            'nilai' => $skor,
            'status_kelulusan' => $sts,
        ]);

        session()->flash('success', "Ujian berhasil dikumpulkan. Skor Anda: {$skor}");
        return redirect()->route('ujian.hasil', [$this->pelajaran->id, 'skor' => $skor]);
    }


    public function render()
    {
        // ambil soal sesuai halaman
        $start = ($this->page - 1) * $this->perPage;
        $currentSoals = $this->soals->slice($start, $this->perPage);

        return view('livewire.components.users.form-ujian', [
            'currentSoals' => $currentSoals,
            'totalPages' => ceil($this->soals->count() / $this->perPage),
        ]);
    }
}
