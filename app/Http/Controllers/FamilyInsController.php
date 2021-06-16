<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\FamilyInsurance;
use App\Http\Requests\SaveFamilyInsRule;

class FamilyInsController extends Controller
{
	private $user;
	private $family_ins;

	public function __construct(User $user, FamilyInsurance $family_ins) {
		$this->user = $user;
		$this->family_ins = $family_ins;
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return view('profile.create_familyins');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveFamilyInsRule $request)
    {
		$check = $this->family_ins->checkRegNumber(Auth::id(), $request->relationship);
		if ($check != null) {
			return redirect(route('profile', [Auth::id()]))->with('error',$check);
		}
		$this->family_ins->saveFamilyIns($request);
		return redirect(route('profile', [Auth::id()]))->with('success', '家族加入保険を追加しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $family_ins = $this->family_ins->getDetailById($request->input('id'));
		if ($family_ins->user_id != Auth::id()) {
			return redirect(route('profile', [Auth::id()]))->with('error', '不正な処理が検出されました');
		}
		$family_ins = $this->family_ins->getDetailById($request->input('id'));
		return view('profile.edit_familyins', compact('family_ins'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveFamilyInsRule $request)
    {
        $family_ins = $this->family_ins->getDetailById($request->input('id'));
		if ($family_ins->user_id != Auth::id()) {
			return redirect(route('profile', [Auth::id()]))->with('error', '不正な処理が検出されました');
		}

		$check = $this->family_ins->checkRegNumber(Auth::id(), $request->relationship);
		if ($check != null) {
			return redirect(route('profile', [Auth::id()]))->with('error',$check);
		}

		//問題なければアップデート
		$this->family_ins->editFamilyIns($request);
		return redirect(route('profile', [Auth::id()]))->with('success', '家族加入保険を編集しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $family_ins = $this->family_ins->getDetailById($request->input('id'));
		if ($family_ins->user_id != Auth::id()) {
			return redirect(route('profile', [Auth::id()]))->with('error', '不正な処理が検出されました');
		}
        $this->family_ins->deleteFamilyInsById($request->input('id'));
		return redirect(route('profile', [Auth::id()]))->with('success', '家族加入保険を削除しました');
    }
}
