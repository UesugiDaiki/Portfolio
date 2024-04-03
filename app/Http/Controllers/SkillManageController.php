<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SkillManageController extends Controller
{
    // skill追加
    public function add_skill(Request $request) {
        $param = [
            'name' => $request->name,
            'level' => $request->level,
        ];
        DB::insert('insert into skill (name, level) values (:name, :level)', $param);
        return redirect('/20031223');
    }

    // dashboardからskill削除
    public function delete_skills(Request $request) {
        foreach($request->skills as $skill_id) {
            DB::delete('delete from skill where id =:id', ['id' => $skill_id]);
        }
        return redirect('/20031223');
    }

    // skill編集画面
    public function skill_detail($id) {
        $skill = DB::select('select * from skill where id =:id', ['id' => $id])[0];
        return view('edit_skill', ['skill' => $skill]);
    }

    // skill編集
    public function edit_skill(Request $request, $id) {
        $param = [
            'id' => $id,
            'name' => $request->name,
            'level' => $request->level,
        ];
        DB::update('update skill set name =:name, level =:level where id =:id', $param);
        return redirect('/20031223');
    }

    // skill削除
    public function delete_skill($id) {
        DB::delete('delete from skill where id =:id', ['id' => $id]);
        return redirect('/20031223');
    }
}
