<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department;
use App\Models\DepartmentUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $items = Department::all();
        return view('departments.index', ['departments'=> $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name'=> ['required', 'max:255'],
        ]);
        $department = Department::create([
            'name'=> $request->name,
        ]);
        $pivot = DepartmentUser::create([
            'user_id'=> Auth::id(),
            'department_id'=> $department->id,
        ]);

        return redirect(route('departments.index'))->with('added', 'Added New Department successfuly.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
        $item = Department::find($department);
        return view('departments.show', ['item'=> $item,]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        //
        return view('departments.edit', ['department'=> $department]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        //
        $request->validate([
            'name'=> ['required',],
        ]);
        $department->name = $request->name;
        $department->save();
        return redirect(route('departments.show', $department->id))->with('nameEdited', '部署名を変更しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        //
    }

    //
    /**
     * Show the form for adding a new member for the department.
     *
     * @return \Illuminate\Http\Response
     */
    public function addMember(Department $department)
    {
        //
        $depart = Department::find($department);
        $users = DepartmentUser::where('department_id', '<>', $depart[0]->id);
        $users = User::all();
        return view('departments.add-member', ['department'=> $depart, 'users'=> $users]);
    }

    /**
     * Store a newly member.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeMember(Request $request, Department $department)
    {
        $request->validate([
            'user'=> ['required'],
        ]);

        $member = DepartmentUser::where('user_id', $request->user)->where('department_id', $department->id)->get();
        $adduser = User::find($request->user);
        if ($member->isEmpty()) {
            // 未登録の場合は登録する
            $result = DepartmentUser::create([
                'user_id'=> $adduser->id,
                'department_id'=> $department->id,
            ]);
            return redirect(route('departments.show', $department->id))->with('memberAdded', sprintf('%sさんをメンバー追加しました。', $adduser->name));
        }
        else {
            return redirect(route('departments.addMember', $department->id))->with('alreadyStored', sprintf('%sさんは既に%sに登録されています。', $adduser->name, $department->name));
        }
    }
}
