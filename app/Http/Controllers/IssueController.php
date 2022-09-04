<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $issues = Issue::where('status', '<>', 4)
            ->where('status', '<>', 5)->get();
        return view('dashboard', ['issues'=> $issues]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $users = User::all();
        $param = [
            'users'=> $users,
            'status'=> [
                0=> '未検討',
                1=> '検討中',
                2=> '対応中',
                3=> '対応済み',
                4=> '対応なし',
                5=> '連携済み',
            ],
        ];
        return view('issues.create', $param);
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
            'title'=> ['required'],
        ]);

        if ($request->responsible_user == "null") {
            $resopnsible_user = null;
        }
        else {
            $resopnsible_user = $request->responsible_user;
        }
        

        $result = Issue::create([
            'title'=> $request->title,
            'detail'=> $request->detail,
            'assign_user_id'=> Auth::id(),
            'responsible_user_id'=> $resopnsible_user,
            'timelimit'=> $request->timelimit,
            'status'=> $request->status,
        ]);
        dd($result);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function show(Issue $issue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function edit(Issue $issue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Issue $issue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Issue $issue)
    {
        //
    }
}
