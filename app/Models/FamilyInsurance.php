<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class FamilyInsurance extends Model
{
    protected $guarded = ['id'];
	use SoftDeletes;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function getDetailById($id)
    {
        $family_ins = $this->where('id', $id)->firstOrFail();
        return $family_ins;
    }

    public function getFirstRecordByUserId($user_id)
    {
        $first_femilyins_record = $this->where('user_id', $user_id)->firstOrFail();
        return $first_femilyins_record;
    }

    public function countRegistration($user_id, $relationship)
    {
		$check_number = null;
		$has_spouse = $this->getFirstRecordByUserId($user_id)->user->spouse;
		$children_num = $this->getFirstRecordByUserId($user_id)->user->children;
        $count_reg = FamilyInsurance::where('user_id', $user_id)->where('relationship', $relationship)->get()->count();

		switch ($relationship) {
		case 1:
			if ($count_reg >= 1) {
				$check_number = "本人が登録できるのは1人までです。";
			}
			break;
		case 2:
			if ($count_reg >= $has_spouse) {
				$check_number = "お先にプロフィールの登録をお願いします";
			}
			break;
		case 3:
			if ($count_reg >= $children_num) {
				$check_number = "プロフィールの登録より多いお子様数は登録できません";
			}
			break;
		case 4:
			if ($count_reg >= 2) {
				$check_number = "親が登録できるのは2人までです。";
			}
			break;
		case 5:
			if ($count_reg >= 2) {
				$check_number = "祖父が登録できるのは2人までです。";
			}
			break;
		case 6:
			if ($count_reg >= 2) {
				$check_number = "祖母が登録できるのは2人までです。";
			}
			break;
		}
        return $check_number;
    }

    public function saveFamilyIns($data)
    {
        $this->user_id = Auth::id();
        $this->age = $data->age;
        $this->relationship = $data->relationship;
        $this->have_insurance_company = $data->have_insurance_company;
        $this->have_insurance_content = $data->have_insurance_content;
        $this->save();
        return true;
    }

    public function editFamilyIns($data)
    {
		$family_ins = $this->getDetailById($data->id);
        $family_ins->age = $data->age;
        $family_ins->relationship = $data->relationship;
        $family_ins->have_insurance_company = $data->have_insurance_company;
        $family_ins->have_insurance_content = $data->have_insurance_content;
        $family_ins->save();
        return true;
    }

    public function deleteFamilyInsById($id)
    {
        $this->findOrFail($id)->delete();
        return true;
    }
}
