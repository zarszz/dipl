<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = ['nama_brg', 'jenis_brg', 'jumlah_brg', 'kode_gudang', 'kode_ruangan', 'user_id'];

    public function getTitleLinkAttribute()
    {
        $title = __('app.show_detail_title', [
            'title' => $this->title, 'type' => __('barang.barang'),
        ]);
        $link = '<a href="'.route('barangs.show', $this).'"';
        $link .= ' title="'.$title.'">';
        $link .= $this->title;
        $link .= '</a>';

        return $link;
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function gudang() {
        return $this->belongsTo(Gudang::class);
    }
}
