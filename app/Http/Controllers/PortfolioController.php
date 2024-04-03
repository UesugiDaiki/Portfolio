<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\SkillController;

class PortfolioController extends Controller
{
    // indexページ表示
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

        return view('portfolio', ['skills' => $skills, 'portfolios' => $portfolios]);
    }

    // 作品詳細ページ表示
    public function portfolioDetail($id) {
        // 作品情報取得
        $portfolio = DB::select('select * from work where id = :id', ['id' => $id]);
        
        // 作品画像ファイルパス取得
        $image_paths = DB::select('select * from image where work_id = :id', ['id' => $portfolio[0]->{'id'}]);
        
        // 作品スキル取得
        $skills = DB::select('select * from work_skill where work_id = :id', ['id' => $portfolio[0]->{'id'}]);
        foreach($skills as $key => $item) {
            $skill = DB::select('select * from skill where id = :id', ['id' => $item->{'skill_id'}]);
            $skills[$key]->{'skill_name'} = $skill[0]->{'name'};
        }

        return view('portfolio_detail', ['id' => $id, 'portfolio' => $portfolio, 'image_paths' => $image_paths, 'skills' => $skills]);
    }

    // 作品追加ページ表示
    public function add_portfolio_page() {
        $skills = DB::select('select * from skill');

        return view('add_portfolio', ['skills' => $skills]);
    }

    // 作品追加
    public function add_portfolio(Request $request) {
        // workテーブルに保存
        $portfolio_id = DB::table('work')->insertGetId([
            'name' => $request->name,
            'url' => $request->url,
            'description' => $request->description,
            'point' => $request->point,
            'file_path' => $request->file('file')->getClientOriginalName(),
        ]);
        
        // work_skillテーブルに保存
        foreach($request->skill as $skill_id) {
            $param = [
                'work_id' => $portfolio_id,
                'skill_id' => $skill_id,
            ];
            DB::insert('insert into work_skill (work_id, skill_id) values (:work_id, :skill_id)', $param);
        }

        // imageテーブルに保存、画像ファイルをストレージに保存
        foreach($request->image as $image) {
            $param = [
                'work_id' => $portfolio_id,
                'path' => $image->getClientOriginalName(),
            ];
            DB::insert('insert into image (work_id, path) values (:work_id, :path)', $param);
            Storage::putFileAs('/public/'.$portfolio_id, $image, $image->getClientOriginalName());
        }

        // ファイルをストレージに保存
        Storage::putFileAs('/public/'.$portfolio_id, $request->file('file'), $request->file('file')->getClientOriginalName());

        return redirect('/20031223');
    }

    // 作品編集ページ表示
    public function edit_portfolio_page($id) {
        // 作品情報取得
        $portfolio = DB::select('select * from work where id =:id', ['id' => $id]);
        
        // 作品画像ファイルパス取得
        $image_paths = DB::select('select * from image where work_id = :id', ['id' => $portfolio[0]->{'id'}]);
        
        // 作品スキルID取得
        $portfolio_skills = DB::select('select * from work_skill where work_id = :id', ['id' => $portfolio[0]->{'id'}]);
        $portfolio_skill_ids = [];
        foreach($portfolio_skills as $key => $item) {
            $portfolio_skill_ids[] = $item->{'skill_id'};
        }
        $skills = DB::select('select * from skill');

        return view('edit_portfolio', ['portfolio' => $portfolio, 'image_paths' => $image_paths, 'portfolio_skill_ids' => $portfolio_skill_ids, 'skills' => $skills]);
    }

    // 作品編集
    public function edit_portfolio(Request $request, $id) {
        // 前のファイルパスを取得
        $old_file_path = DB::select('select file_path from work where id =:id', ['id' => $id])[0]->file_path;

        // workテーブル更新
        $param = [
            'id' => $id,
            'name' => $request->name,
            'url' => $request->url,
            'description' => $request->description,
            'point' => $request->point,
            'file_path' => isset($request->file) ? $request->file('file')->getClientOriginalName() : $old_file_path,
        ];
        DB::update('update work set name =:name, url =:url, description =:description, point =:point, file_path =:file_path where id =:id', $param);

        // work_skillテーブル更新
        DB::delete('delete from work_skill where work_id =:id', ['id' => $id]);
        foreach($request->skill as $skill_id) {
            $param = [
                'work_id' => $id,
                'skill_id' => $skill_id,
            ];
            DB::insert('insert into work_skill (work_id, skill_id) values (:work_id, :skill_id)', $param);
        }

        // imageテーブル更新、画像ファイルをストレージから削除、保存
        if(isset($request["delete-image"])) {
            foreach($request["delete-image"] as $delete_image) {
                DB::delete('delete from image where work_id =:work_id and path =:path', ['work_id' => $id, 'path' => $delete_image]);
                Storage::delete('public/'.$id.'/'.$delete_image);
            }
        }
        if(isset($request->image)) {
            foreach($request->image as $image) {
                $param = [
                    'work_id' => $id,
                    'path' => $image->getClientOriginalName(),
                ];
                DB::insert('insert into image (work_id, path) values (:work_id, :path)', $param);
                Storage::putFileAs('/public/'.$id, $image, $image->getClientOriginalName());
            }
        }

        // ファイルをストレージから削除、保存
        if(isset($request->file)) {
            Storage::delete('public/'.$id.'/'.$old_file_path);
            Storage::putFileAs('/public/'.$id, $request->file('file'), $request->file('file')->getClientOriginalName());
        }

        return redirect('/20031223');
    }

    // 作品削除
    public function delete_portfolio($id) {
        // imageテーブルから削除
        DB::delete('delete from image where work_id =:work_id', ['work_id' => $id]);
        // work_skillテーブルから削除
        DB::delete('delete from work_skill where work_id =:work_id', ['work_id' => $id]);
        // workテーブルから削除
        DB::delete('delete from work where id =:id', ['id' => $id]);
        // storageからディレクトリ削除
        Storage::deleteDirectory('public/'.$id);
        
        return redirect('/20031223');
    }
}
