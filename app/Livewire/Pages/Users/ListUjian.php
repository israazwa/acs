<?php

namespace App\Livewire\Pages\Users;

use Livewire\Component;
use App\Models\pelajaran;

use Livewire\Attributes\Layout;
use Livewire\WithPagination;
#[Layout('layouts.app')]
class ListUjian extends Component
{
    use WithPagination;
    public function render()
    {
        $pelajarans = Pelajaran::with(['soals.jawabans'])
            ->orderBy('created_at', 'desc')
            ->get();

        $pelajaranDenganSoal = $pelajarans->filter(function ($p) {
            return $p->soals->isNotEmpty() &&
                $p->soals->every(fn($s) => $s->jawabans->isNotEmpty());
        });
        $pelajaranTerbaru = $pelajaranDenganSoal->take(3);
        $pelajaranLainIds = $pelajarans->diff($pelajaranTerbaru)->pluck('id');
        $pelajaranLain = Pelajaran::with(['soals.jawabans'])
            ->whereIn('id', $pelajaranLainIds)
            ->paginate(4);

        $data = [
            'pelajarans' => $pelajarans,
            'pelajaranDenganSoal' => $pelajaranDenganSoal,
            'pelajaranTerbaru' => $pelajaranTerbaru,
            'pelajaranLain' => $pelajaranLain,
        ];
        return view('livewire.pages.users.list-ujian', $data);
    }
}
