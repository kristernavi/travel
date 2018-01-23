<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected function enoughBalance($paidAmount)
    {
        $remain = $this->balance - $paidAmount;
        if ($remain < 0) {
            throw new \Exception('Error Processing Request', 422);
        }
    }

    protected function active()
    {
        if (!$this->actived) {
            throw new \Exception('Error Processing Request', 422);
        }
    }

    protected function valid()
    {
        $now = Carbon::now();
        $expire_date = Carbon::create($this->expire_date);
        if ($now->diffInDays($expire_date) < 0) {
            throw new \Exception('Error Processing Request', 422);
        }
    }

    public function check($amount)
    {
        $this->active();
        $this->valid();
        $this->enoughBalance($amount);
    }
}
