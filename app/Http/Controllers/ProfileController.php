<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Skill;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

/**
 * Class ProfileController
 * @package App\Http\Controllers
 */
class ProfileController extends Controller
{


    /**
     * @param Request $request
     * @param Response $response
     * @return array
     */
    public function index(Request $request, Response $response, $id)
    {
        $profile = User::find($id)->Profile;
        $skill = User::find($id)->Skill;
        return ['profile' => $profile, 'skill' => $skill,];
    }
//
//    /**
//     * @param Request $request
//     * @param Response $response
//     * @return mixed
//     */
//    public function all(Request $request, Response $response)
//    {
//        //$profile = Profile::where('user_id', Auth::user()->id)->first();
//        $profile = Profile::where('user_id', '!=', Auth::user()->id)->get();
//        $skill = Skill::where('user_id', '!=', Auth::user()->id)->get();
//
//
//        return $profile;
//    }


    /**
     * @param Request $request
     * @param Response $response
     * @return Profile
     */
    public function create(Request $request, Response $response)
    {

        $profile = new Profile();
        $data = [
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'purpose' => $request->purpose
        ];

        $this->createSkill($request->skill);
        $profile->fill($data)->save();

        return $response->status();
    }


    /**
     * @param Request $request
     * @param Response $response
     * @return mixed
     */
    public function update(Request $request, Response $response)
    {

        $profile = Profile::where('user_id', Auth::user()->id)->first();
        $data = [
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'purpose' => $request->purpose
        ];

        $this->createSkill($request->skill);

        $profile->fill($data)->save();

        return $response->status();
    }

    public function delete(Request $request, Response $response)
    {
        $skill = Skill::find($request->id);

        $skill->delete();
        return User::find(Auth::user()->id)->Skill;
    }

    private function createSkill($skill)
    {
        // 未登録(id)がないitemだけ登録
        $skills = array_filter($skill, function ($d) {
            return empty($d['id']);
        });


        foreach ($skills as $sk) {
            $skill = new Skill();

            $skill_data = [
                'user_id' => Auth::user()->id,
                'label' => $sk['label'],
                'level' => $sk['level']
            ];

            $skill->fill($skill_data)->save();
        }
    }
}
