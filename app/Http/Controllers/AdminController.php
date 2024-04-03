<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // Adminメインページ表示
    public function index() {
        // スキル取得
        $skills = DB::select('select * from skill');
        // 作品取得
        $portfolios = DB::select('select * from work');
        // 作品画像ファイルパス取得
        foreach($portfolios as $portfolio) {
            $image_paths = DB::select('select * from image where work_id = :id', ['id' => $portfolio->{'id'}]);
            $portfolio->{'image'} = $image_paths[0]->{'path'};
        }

        return view('dashboard', ['skills' => $skills, 'portfolios' => $portfolios]);
    }
}
