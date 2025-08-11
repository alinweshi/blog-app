<?php

// app/Http/Controllers/AdminAuth/AdminController.php

namespace App\Http\Controllers\Admin\AdminAuth;

use Exception;
use App\Services\AdminService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;

class AdminController extends Controller
{
    public function __construct(protected AdminService $adminService) {}

    public function index()
    {
        $admins = $this->adminService->getAll();
        return view('auth.admins.index', compact('admins'));
    }

    public function create()
    {
        return view('auth.admins.create');
    }

    public function store(StoreAdminRequest $request)
    {
        try {
            $this->adminService->create($request->validated());
            return redirect()->route('admins.index')->with('success', 'Admin created successfully.');
        } catch (Exception $e) {
            Log::error('Admin create failed: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to create admin.'])->withInput();
        }
    }

    public function edit($id)
    {
        $admin = $this->adminService->find($id);
        return view('auth.admins.edit', compact('admin'));
    }

    public function update(UpdateAdminRequest $request, $id)
    {
        try {
            $this->adminService->update($id, $request->validated());
            return redirect()->route('admins.index')->with('success', 'Admin updated successfully.');
        } catch (Exception $e) {
            Log::error('Admin update failed: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to update admin.'])->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $this->adminService->delete($id);
            return redirect()->route('admins.index')->with('success', 'Admin deleted successfully.');
        } catch (Exception $e) {
            Log::error('Admin delete failed: ' . $e->getMessage());
            return redirect()->route('admins.index')->with('error', 'Failed to delete admin.');
        }
    }
}
