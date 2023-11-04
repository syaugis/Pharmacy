<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        $user = User::where('id', Auth::user()->id)->first();

        return view('profile.index', compact('user'));
    }

    public function update(Request $request): RedirectResponse
    {
        $user = User::where('id', Auth::user()->id)->first();

        $this->validate($request, [
            'name' => 'required', 'string', 'max:255',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            // 'password' => 'required', 'string', 'min:8', 'confirmed',
            'birth_date' => 'required', 'date',
            'gender' => 'required', 'string',
            'address' => 'required', 'string', 'max:255',
            'city' => 'required', 'string',
            'contact' => 'required|unique:users,contact,' . $user->id,
            'paypal_id' => 'required', 'string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->birth_date = $request->birth_date;
        $user->gender = $request->gender;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->contact = $request->contact;
        $user->paypal_id = $request->paypal_id;
        if ($request->password != null) {
            $user->password = Hash::make($request->password);
        }
        if ($request->image != null) {
            $imageName = $user->getAttribute('image');
            if (file_exists("img_profiles/" . $imageName)) {
                unlink('img_profiles/' . $imageName);
            }
            $imageName = $request->file('image')->hashName();
            $request->image->move(public_path('img_profiles'), $imageName);
            $user->image = $imageName;
        }
        $user->update();

        alert()->toast('Your profile has been updated', 'success');
        return redirect()->route('home');
    }
}