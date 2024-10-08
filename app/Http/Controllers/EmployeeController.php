<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'employees.';
    public function index()
    {
        $data = Employee::latest('id')->paginate(5);

        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'fist_name'         => 'required|max:100',
            'last_name'         => 'required|max:100',
            'email'             => [
                'required',
                'email',
                'max:150',
                Rule::unique('employees')
            ],
            'phone'             => 'required|max:15',
            'date_of_birth'     => [
                'required',
                'date',
                'before:today',
            ],
            'hire_date'         => [
                'required',
                'date_format:Y-m-d H:i:s',
                'before_or_equal:now',
            ],
            'salary'            => 'required|integer',
            'is_active'         => ['nullable', Rule::in([0, 1])],
            'department_id'     => 'required|integer',
            'manager_id'        => 'required|integer',
            'address'           => 'required|max:255',
            'profile_picture'   => 'nullable|image|max:2048'
        ]);

        try {
            if ($request->hasFile('profile_picture')) {
                $data['profile_picture'] = file_get_contents($request->file('profile_picture')->getRealPath());
            }
            Employee::query()->create($data);

            return redirect()
                ->route('employees.index')
                ->with('success', true);
        } catch (\Throwable $th) {
            if (!empty($data['profile_picture'])) {
                Log::error('profile_picture error ');
            }
            return back()
                ->with('success', false)
                ->with('error', $th->getMessage());
        }
    }

    public function showPicture($id)
    {
        $employee = Employee::findOrFail($id);

        if ($employee && $employee->profile_picture) {
            return response($employee->profile_picture)->header('Content-Type', 'image/jpeg');
        }

        return abort(404);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        return view(self::PATH_VIEW . __FUNCTION__, compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $data = $request->validate([
            'fist_name'         => 'required|max:100',
            'last_name'         => 'required|max:100',
            'email'             => [
                'required',
                'email',
                'max:150',
            ],
            'phone'             => 'required|max:15',
            'date_of_birth'     => [
                'required',
                'date',
                'before:today',
            ],
            'hire_date'         => [
                'required',
                'date_format:Y-m-d H:i:s',
                'before_or_equal:now',
            ],
            'salary'            =>'required|numeric',
            'is_active'         => ['nullable', Rule::in([0, 1])],
            'department_id'     => 'required|integer',
            'manager_id'        => 'required|integer',
            'address'           => 'required|max:255',
            'profile_picture'   => 'nullable|image|max:2048022'
        ]);

        try {

            $data['is_active'] ??= 0;

            if ($request->hasFile('profile_picture')) {
                $data['profile_picture'] = file_get_contents($request->file('profile_picture')->getRealPath());
            }
            $employee->update($data);

            return back()
                ->with('success', true);
        } catch (\Throwable $th) {

            return back()
                ->with('success', false)
                ->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        try {
            $employee->delete();
            
            return back()->with('success', true);
        } catch (\Throwable $th) {
            return back()
                ->with('success', false)
                ->with('error', $th->getMessage());
        }
    }
    public function forceDestroy(Employee $employee)
    {
        try {
            $employee->forceDelete();
            
            return back()->with('success', true);
        } catch (\Throwable $th) {
            return back()
                ->with('success', false)
                ->with('error', $th->getMessage());
        }
    }
}
