<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Roles - Data";

        $confTitle = 'Delete Subject Data!';
        $confText = "Are you sure you want to delete?";

        confirmDelete($confTitle, $confText);

        return view('master.role.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Roles - Create";

        return view('master.role.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        try {
            Role::create([
                'name' => strtolower(str_replace(" ", "-", $request->name)),
                'description' => $request->description,
                'guard_name' => 'web'
            ]);

            Alert::success('Congrats', 'You\'ve Successfully Created');
            return redirect()->route('role.index');
        } catch (\Exception $excep) {
            Log::error('Error Adding Role: ' . $excep->getMessage());

            Alert::error('Error', 'An error occurred while adding the Role.');
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
            $title = "Roles - Edit";

            $roleId = Crypt::decrypt($id);
            $data = Role::findOrFail($roleId);

            return view('master.role.edit', compact('title', 'data'));
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid Decryption Key or Ciphertext.');
            return redirect()->route('role.index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, string $id)
    {
        try {
            $roleId = Crypt::decrypt($id);
            $role = Role::findOrFail($roleId);

            $role->update([
                'name' => strtolower(str_replace(" ", "-", $request->name)),
                'description' => $request->description
            ]);

            Alert::success('Congrats', 'You\'ve Successfully Updated');
            return redirect()->route('role.index');
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid Decryption Key or Ciphertext.');
            return redirect()->route('role.index');
        } catch (\Exception $excep) {
            Log::error('Error Updating Role: ' . $excep->getMessage());

            Alert::error('Error', 'An error occurred while updating the role.');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $roleId = Crypt::decrypt($id);
            Role::findOrFail($roleId)->delete();

            Alert::success('Congrats', 'You\'ve Successfully Deleted');
            return redirect()->route('role.index');
        } catch (DecryptException $decryptExcep) {
            Alert::error('Error', 'Invalid Decryption Key or Ciphertext.');
            return redirect()->route('role.index');
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function data()
    {
        $data = Role::withCount(['users', 'permissions'])
                    ->get()
                    ->map(function($role) {
                        $role->uuid = Crypt::encrypt($role->uuid);

                        return $role;
                    });

        return DataTables::of($data)
                        ->editColumn('name', function($item) {
                            $words = explode(" ", str_replace("-", " ", $item->name));

                            $processedWords = array_map(function ($word) {
                                return preg_match('/[aeiou]/i', $word) ? ucwords($word) : strtoupper($word);
                            }, $words);

                            return implode(" ", $processedWords);
                        })
                        ->editColumn('guard_name', function($item) {
                            return ucwords($item->guard_name);
                        })
                        ->make(true);
    }
}
