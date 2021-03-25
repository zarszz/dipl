<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticketing extends Model
{
    use HasFactory;

    protected $fillable = ['id_user', 'pesan'];

    public function getTitleLinkAttribute()
    {
        $title = __('app.show_detail_title', [
            'title' => $this->title, 'type' => __('ticketing.ticketing'),
        ]);
        $link = '<a href="'.route('ticketings.show', $this).'"';
        $link .= ' title="'.$title.'">';
        $link .= $this->title;
        $link .= '</a>';

        return $link;
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
