<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Laravel\Jetstream\Jetstream;
use Illuminate\Validation\Rules\Password; // เพิ่มบรรทัดนี้
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class OwnerController extends Controller
{


    public function searchEmployee(Request $request)
    {
        $search = $request->input('search');
        $employee = User::where('userType', '1')
            ->where('name', 'like', "%$search%")
            ->get();
        return view('owner.employee', compact('employee'));
    }

    public function employee()
    {
        $employee = User::where('userType', '1')->get();
        return view('owner.employee', compact('employee'));
    }
    public function users()
    {
        $ีusers = User::all();
        return view('owner.employee', compact('users'));
    }

    public function add_employee()
    {
        $employee = User::where('userType', '1')->get();
        return view('owner.add_employee', compact('employee'));
    }
    public function employeedetail()
    {
        $employeedetail = User::where('userType', '1')->get();
        return view('owner.employeedetail', compact('employeedetail'));
    }

    public function checkUserType()
    {
        if (!Auth::check()) {
            return redirect()->route('welcome');
        }

        $userType = Auth::user()->userType;

        if ($userType === "0") {
            return redirect()->route('room');
        }

        if ($userType === "1") {
            return redirect()->route('checkin');
        }
        if ($userType === "2") {
            return redirect()->route('home');
        }
    }

    public function createUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Password::defaults()],
            'tel' => 'required|string|max:20',
            'birthday' => 'required|date_format:d/m/Y',
            'address' => 'required|string|max:255',
            'image' => 'required|image|max:10240',
            'salary' => 'required|numeric',
            'work_shift' => 'required|string',
            'position' => 'required|string',
            'payment_date' => 'required|date_format:d/m/Y',
        ]);

        $imageName = time() . '.' . $request->file('image')->extension();
        $request->file('image')->move(public_path('images'), $imageName);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'tel' => $request->tel,
            'birthday' => Carbon::createFromFormat('d/m/Y', $request->birthday)->format('Y-m-d'),
            'address' => $request->address,
            'image' => $imageName,
            'userType' => $request->userType,
            'start_date' => $request->start_date ? Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d') : null,
            'salary' => $request->salary,
            'work_shift' => $request->work_shift,
            'position' => $request->position,
            'payment_date' => Carbon::createFromFormat('d/m/Y', $request->payment_date)->format('d'),
        ]);

        return redirect()->route('employee')->with('success', 'บันทึกข้อมูลสำเร็จ');
    }


    public function edit($id)
    {
        $user = User::find($id);
        return view('owner.editemployee', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'tel' => 'required|string|max:20',
            'start_date' => 'required|date_format:d/m/Y',
            'birthday' => 'required|date_format:d/m/Y',
            'address' => 'required|string|max:255',
            'image' => 'image|max:10240',
            'salary' => 'required|numeric',
            'work_shift' => 'required|string',
            'position' => 'required|string',
            'payment_date' => 'required|date_format:d/m/Y',
        ]);

        $user = User::find($id);

        if (!$user) {
            return redirect()->route('employee.edit', $id)->with('error', 'ไม่พบผู้ใช้ที่ต้องการแก้ไข');
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->tel = $request->tel;
        $user->start_date = Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d');
        $user->birthday = Carbon::createFromFormat('d/m/Y', $request->birthday)->format('Y-m-d');
        $user->address = $request->address;
        $user->salary = $request->salary;
        $user->work_shift = $request->work_shift;
        $user->position = $request->position;
        $user->payment_date = Carbon::createFromFormat('d/m/Y', $request->payment_date)->format('Y-m-d');

        if ($request->hasFile('image')) {
            if ($user->image) {
                Storage::delete('public/images/' . $user->image);
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $user->image = $imageName;
        }

        $user->save();

        return redirect()->route('employee')->with('success', 'ข้อมูลพนักงานอัปเดตเรียบร้อย');
    }

    public function delete($id)
    {
        $user = User::find($id);

        if ($user) {
            if ($user->image) {
                Storage::delete('public/images/' . $user->image);
            }
            $user->delete();
            return redirect()->route('employee')->with('success', 'ลบข้อมูลสำเร็จ');
        } else {
            return redirect()->route('employee')->with('error', 'ไม่พบผู้ใช้ที่ต้องการลบ');
        }
    }
}
