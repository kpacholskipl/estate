<?php

namespace App\Jobs;

use App\Models\Estate;
use App\Models\UserShift;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ChangeSupervisor implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        $finishedShifts = UserShift::getFinishedShifts();
        if ($finishedShifts->count()) {
            $this->updateFinishedShifts($finishedShifts);
        }

        $currentShifts = UserShift::getCurrentShifts();
        if ($currentShifts->count()) {
            $this->updateCurrentShifts($currentShifts);
        }
    }

    private function updateFinishedShifts($finishedShifts)
    {
        foreach ($finishedShifts as $shift) {
            $estateIds = json_decode($shift->temp_changes);
            Estate::whereIn('id', $estateIds)->update(['supervisor_user_id' => $shift->user->user_id]);
            $shift->temp_changes = NULL;
            $shift->save();
        }
    }

    private function updateCurrentShifts($currentShifts)
    {
        foreach ($currentShifts as $shift) {
            $estatesToChange = $shift->user->estates;
            $estatesToChange->each(function ($estate) use ($shift) {
                $estate->update(['supervisor_user_id' => $shift->substituteUser->user_id]);
            });
            $shift->temp_changes = $estatesToChange->pluck('id')->toJson();
            $shift->save();
        }
    }
}
