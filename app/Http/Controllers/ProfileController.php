<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use App\Service;
use App\Purchase;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = \Auth::user();

        return view('profiles.create', [
            'user' => $user,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = \Auth::user();
        $profile = Profile::create([
            'user_id' => \Auth::user()->id,
            'firstname' => $request->input('firstname', ''),
            'lastname' => $request->input('lastname', ''),
            'address' => $request->input('address', ''),
            'phone_number' => $request->input('phone_number', ''),
            'profession' => $request->input('profession', '')
        ]);

        $profile->save();

        $search = $request->get('buscar');
        $services = Service::search($search)->paginate(3);

        return redirect('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        return view('profiles.show', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = \Auth::user();
        $profile = Profile::where('user_id', '=', \Auth::user()->id)->first();

        if ($profile == null) {
            return view('profiles.create', [
                'user' => $user
            ]);
        }

        $services = Service::where('profile_id', $profile->id)->get();
        $n_services_finished = 0;
        $n_services_pending = 0;
        foreach ($services as $service) {
            foreach ($service->purchases as $purchase) {
                if ($purchase->status) {
                    $n_services_finished = $n_services_finished + 1;
                } else {
                    $n_services_pending = $n_services_pending + 1;
                }
            }
        }

        $purchases_pending = Purchase::where([
            ['profile_id', $profile->id],
            ['status', 0],
        ])->get();

        $purchases_finished = Purchase::where([
            ['profile_id', $profile->id],
            ['status', 1],
        ])->get();

        return view('profiles.edit',  [
            'user' => $user,
            'profile' => $profile,
            'services' => $services,
            'purchases_pending' => $purchases_pending,
            'purchases_finished' => $purchases_finished,
            'services_pending' => $n_services_pending,
            'services_finished' => $n_services_finished
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
         //$user->name = $request->input('name');
         //$user->email = $request->input('email');
        //$user->password = $request->input('password');
        //$user->save();

        $user = \Auth::user();
        $profile = Profile::where('user_id', '=', \Auth::user()->id)->first();
        $profile->firstname = $request->input('firstname', '');
        $profile->lastname = $request->input('lastname', '');
        $profile->address = $request->input('address', '');
        $profile->phone_number = $request->input('phone_number', '');
        $profile->profession = $request->input('profession', '');
        $profile->save();

        return redirect('profile/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $profile = Profile::where('user_id', '=', \Auth::user()->id)->first();
        $profile->delete();

        $user = \Auth::user();
        $user->delete();

        return back();
    }
}
