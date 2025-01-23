<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "User - Data";

        $confTitle = 'Delete Subject Data!';
        $confText = "Are you sure you want to delete?";

        confirmDelete($confTitle, $confText);

        return view('master.user.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "User - Create";

        return view('master.user.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try {
            $gender = $request->gender == 'male' ? true : false;

            User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'no_telp' => $request->no_telp,
                'password' => Hash::make($request->password),
                'alamat' => $request->alamat,
                'kode_pos' => $request->kode_pos,
                'kelurahan' => $request->kelurahan,
                'kecamatan' => $request->kecamatan,
            ])->assignRole('user');

            Alert::success('Congrats', 'You\'ve Successfully Created');
            return redirect()->route('user.index');
        } catch (\Exception $excep) {
            Log::error('Error Adding User: ' . $excep->getMessage());

            Alert::error('Error', $excep->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $title = "User - Edit";

            $userId = Crypt::decrypt($id);
            $data = User::find($userId);

            return view('master.user.edit', compact('title', 'data'));
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid Decryption Key or Ciphertext.');
            return redirect()->route('user.index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        try {
            $userId = Crypt::decrypt($id);
            $userId = User::findOrFail($userId);

            $userId->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'no_telp' => $request->no_telp,
                'password' => Hash::make($request->password),
                'alamat' => $request->alamat,
            ]);

            Alert::success('Congrats', 'You\'ve Successfully Updated');
            return redirect()->route('student.index');
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid Decryption Key or Ciphertext.');
            return redirect()->route('student.index');
        } catch (\Exception $excep) {
            Log::error('Error Updating Student: ' . $excep->getMessage());

            Alert::error('Error', 'An error occurred while updating the Student.');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $userId = Crypt::decrypt($id);
            User::findOrFail($userId)->delete();

            Alert::success('Congrats', 'You\'ve Successfully Deleted');
            return redirect()->route('user.index');
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid Decryption Key or Ciphertext.');
            return redirect()->route('user.index');
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function data()
    {
        $data = User::get()
                    ->map(function ($user) {
                        $user->id = Crypt::encrypt($user->id);
                        return $user;
                    });

        return DataTables::of($data)
                        ->editColumn('gender', function ($item) {
                            return $item->gender ? 'Male' : 'Female';
                        })
                        ->make(true);
    }
}
