<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\WorkoutRoutine;
use App\Models\DietPlan;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

#[Layout('layouts.app')]
class AdminDashboard extends Component
{
    use WithPagination, WithFileUploads;

    public $stats = [];
    public $activeTab = 'packages';
    
    // Package CRUD
    public $showCreateModal = false;
    public $showEditModal = false;
    public $showDeleteModal = false;
    public $showDeleteOrderModal = false;
    public $editingPackage = null;
    public $deletingPackage = null;
    
    // Package form fields
    public $packageName = '';
    public $packagePrice = '';
    public $packageDescription = '';
    public $packageCategory = 'fitness';
    public $packageDurationMonths = 1;
    public $packageDiscountPercentage = 0;
    public $packageFeatures = '';
    public $packageIsActive = true;
    
    // New Package form fields
    public $newPackageName = '';
    public $newPackagePrice = '';
    public $newPackageDescription = '';
    public $newPackageCategory = 'fitness';
    
    // Edit Package form fields
    public $editPackageName = '';
    public $editPackagePrice = '';
    public $editPackageDescription = '';
    public $editPackageCategory = 'fitness';
    public $editPackageDurationMonths = 1;
    public $editPackageDiscountPercentage = 0;
    public $editPackageFeatures = '';
    public $editPackageIsActive = true;
    
    // User Management
    public $showCreateUserModal = false;
    public $showEditUserModal = false;
    public $showDeleteUserModal = false;
    public $editingUser = null;
    public $deletingUser = null;
    
    // User form fields
    public $newUserName = '';
    public $newUserEmail = '';
    public $newUserPassword = '';
    public $newUserPhone = '';
    public $newUserGender = 'male';
    public $newUserIsTrainer = false;
    
    public $editUserName = '';
    public $editUserEmail = '';
    public $editUserPhone = '';
    public $editUserGender = 'male';
    public $editUserIsTrainer = false;
    
    // Order Management
    public $showEditOrderModal = false;
    public $editingOrder = null;
    public $deletingOrder = null;
    
    // Search and filter
    public $search = '';
    public $statusFilter = '';
    public $dateFilter = '';
    
    // Delete confirmation
    public $deleteType = '';
    public $deleteItemName = '';
    
    // Image upload
    public $image = null;
    
    // Additional properties for modals
    public $name = '';
    public $description = '';
    public $price = '';
    public $category = '';
    public $duration_days = 30;
    public $is_active = 1;
    public $features = '';
    public $brand = '';
    public $model = '';
    public $stock_quantity = 0;

    // User modal properties
    public $userPasswordConfirmation = '';
    public $isAdmin = false;

    public function mount()
    {
        $this->loadStats();
    }

    public function loadStats()
    {
        $this->stats = [
            'total_users' => User::count(),
            'total_orders' => Order::count(),
            'total_products' => Product::count(),
            'total_revenue' => Order::sum('total_amount'),
        ];
    }

    // Package CRUD Methods
    public function openCreatePackageModal()
    {
        $this->resetPackageForm();
        $this->showCreateModal = true;
    }
    
    public function openEditPackageModal($packageId)
    {
        $package = Product::findOrFail($packageId);
        $this->editingPackage = $package;
        $this->editPackageName = $package->name;
        $this->editPackageDescription = $package->description;
        $this->editPackagePrice = $package->price;
        $this->editPackageCategory = $package->category;
        $this->editPackageDurationMonths = $package->duration_days / 30;
        $this->editPackageDiscountPercentage = $package->discount_percentage;
        $this->editPackageFeatures = $package->features;
        $this->editPackageIsActive = $package->is_active;
        
        $this->showEditModal = true;
    }
    
    public function openDeletePackageModal($packageId)
    {
        $package = Product::findOrFail($packageId);
        $this->deletingPackage = $package;
        $this->deleteType = 'package';
        $this->deleteItemName = $package->name;
        $this->showDeleteModal = true;
    }
    
    public function createPackage()
    {
        $this->validate([
            'newPackageName' => 'required|string|max:255',
            'newPackageDescription' => 'required|string',
            'newPackagePrice' => 'required|numeric|min:0',
            'packageCategory' => 'required|string|max:255',
            'packageDurationMonths' => 'required|integer|min:1',
            'packageDiscountPercentage' => 'required|numeric|min:0|max:100',
            'packageFeatures' => 'nullable|string',
            'packageIsActive' => 'boolean',
            'image' => 'nullable|image|max:2048',
        ]);
        
        DB::beginTransaction();
        
        try {
            $imagePath = null;
            if ($this->image) {
                $imagePath = $this->image->store('products', 'public');
            }
            
            Product::create([
                'name' => $this->newPackageName,
                'description' => $this->newPackageDescription,
                'price' => $this->newPackagePrice,
                'category' => $this->packageCategory,
                'duration_days' => $this->packageDurationMonths * 30,
                'discount_percentage' => $this->packageDiscountPercentage,
                'features' => $this->packageFeatures,
                'is_active' => $this->packageIsActive,
                'main_image' => $imagePath ? '/storage/' . $imagePath : null,
                'images' => $imagePath ? ['/storage/' . $imagePath] : [],
            ]);
            
            DB::commit();
            
            $this->resetPackageForm();
            $this->showCreateModal = false;
            $this->loadStats();
            
            session()->flash('success', 'Package created successfully!');
            $this->dispatch('package-created');
            
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Error creating package: ' . $e->getMessage());
        }
    }
    
    public function updatePackage()
    {
        if (!$this->editingPackage) {
            session()->flash('error', 'No package selected for update.');
            return;
        }
        
        $this->validate([
            'editPackageName' => 'required|string|max:255',
            'editPackageDescription' => 'required|string',
            'editPackagePrice' => 'required|numeric|min:0',
            'editPackageCategory' => 'required|string|max:255',
            'editPackageDurationMonths' => 'required|integer|min:1',
            'editPackageDiscountPercentage' => 'required|numeric|min:0|max:100',
            'editPackageFeatures' => 'nullable|string',
            'editPackageIsActive' => 'boolean',
            'image' => 'nullable|image|max:2048',
        ]);
        
        DB::beginTransaction();
        
        try {
            $updateData = [
                'name' => $this->editPackageName,
                'description' => $this->editPackageDescription,
                'price' => $this->editPackagePrice,
                'category' => $this->editPackageCategory,
                'duration_days' => $this->editPackageDurationMonths * 30,
                'discount_percentage' => $this->editPackageDiscountPercentage,
                'features' => $this->editPackageFeatures,
                'is_active' => $this->editPackageIsActive,
            ];
            
            // Handle image upload if provided
            if ($this->image) {
                // Delete old image if exists
                if ($this->editingPackage->main_image && str_starts_with($this->editingPackage->main_image, '/storage/')) {
                    $oldImagePath = str_replace('/storage/', '', $this->editingPackage->main_image);
                    if (Storage::disk('public')->exists($oldImagePath)) {
                        Storage::disk('public')->delete($oldImagePath);
                    }
                }
                
                // Store new image with a unique name
                $imagePath = $this->image->store('products', 'public');
                
                // Update the image path in the database
                $updateData['main_image'] = '/storage/' . $imagePath;
                $updateData['images'] = ['/storage/' . $imagePath];
            } else {
                // If no new image is provided, keep the old image
                $updateData['main_image'] = $this->editingPackage->main_image;
                $updateData['images'] = $this->editingPackage->images;
            }
            
            $this->editingPackage->update($updateData);
            
            DB::commit();
            
            // Reset form and close modal
            $this->resetPackageModalForm();
            $this->showEditModal = false;
            $this->editingPackage = null;
            $this->image = null; // Reset the image property
            
            session()->flash('success', 'Package updated successfully!');
            $this->loadStats();
            $this->dispatch('package-updated');
            
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Error updating package: ' . $e->getMessage());
        }
    }
    
    public function deletePackage()
    {
        if (!$this->deletingPackage) {
            session()->flash('error', 'No package selected for deletion.');
            return;
        }
        
        DB::beginTransaction();
        
        try {
            // Delete the image if it exists
            if ($this->deletingPackage->main_image && str_starts_with($this->deletingPackage->main_image, '/storage/')) {
                $imagePath = str_replace('/storage/', '', $this->deletingPackage->main_image);
                if (Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
            }
            
            $packageName = $this->deletingPackage->name;
            $this->deletingPackage->delete();
            
            DB::commit();
            
            // Reset and close modal
            $this->reset(['deletingPackage', 'deleteType', 'deleteItemName']);
            $this->showDeleteModal = false;
            
            // Show success message
            session()->flash('success', 'Package "' . $packageName . '" has been deleted successfully!');
            
            // Refresh the packages list
            $this->loadStats();
            $this->dispatch('package-deleted');
            
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Error deleting package: ' . $e->getMessage());
        }
    }
    
    public function togglePackageStatus($packageId)
    {
        try {
            $package = Product::findOrFail($packageId);
            $package->update(['is_active' => !$package->is_active]);
            
            $status = $package->is_active ? 'activated' : 'deactivated';
            session()->flash('message', "Product {$status} successfully!");
            $this->loadStats();
            
        } catch (\Exception $e) {
            session()->flash('error', 'Error updating product status: ' . $e->getMessage());
        }
    }
    
    public function confirmDelete()
    {
        if ($this->deleteType === 'package' && $this->deletingPackage) {
            $this->deletePackage();
        } elseif ($this->deleteType === 'user' && $this->deletingUser) {
            $this->deleteUser();
        } else {
            session()->flash('error', 'No item selected for deletion or invalid delete type.');
            $this->closeDeleteModal();
        }
    }
    
    public function closeDeleteModal()
    {
        $this->reset(['deletingPackage', 'deletingUser', 'deleteType', 'deleteItemName']);
        $this->showDeleteModal = false;
    }

    // User CRUD Methods
    public function openCreateUserModal()
    {
        $this->resetNewUserForm();
        $this->showCreateUserModal = true;
    }
    
    public function openEditUserModal($userId)
    {
        try {
            $user = User::findOrFail($userId);
            $this->editingUser = $user;
            $this->editUserName = $user->name;
            $this->editUserEmail = $user->email;
            $this->editUserPhone = $user->phone ?? '';
            $this->editUserGender = $user->gender ?? 'male';
            $this->editUserIsTrainer = $user->is_trainer ?? false;
            
            $this->showEditUserModal = true;
            
            // Emit an event to ensure the modal opens
            $this->dispatch('editUserModalOpened');
        } catch (\Exception $e) {
            session()->flash('error', 'Error opening user edit: ' . $e->getMessage());
        }
    }

    public function openDeleteUserModal($userId)
    {
        try {
            $user = User::findOrFail($userId);
            $this->deletingUser = $user;
            $this->deleteType = 'user';
            $this->deleteItemName = $user->name;
            $this->showDeleteModal = true;
            
            // Emit an event to ensure the modal opens
            $this->dispatch('deleteUserModalOpened');
        } catch (\Exception $e) {
            session()->flash('error', 'Error opening delete confirmation: ' . $e->getMessage());
        }
    }
    
    public function deleteUser()
    {
        if (!$this->deletingUser) {
            session()->flash('error', 'No user selected for deletion.');
            return;
        }

        DB::beginTransaction();
        try {
            // Get the user ID safely
            $userId = is_object($this->deletingUser) 
                ? (property_exists($this->deletingUser, 'id') ? $this->deletingUser->id : null)
                : (is_array($this->deletingUser) 
                    ? ($this->deletingUser['id'] ?? null) 
                    : $this->deletingUser);

            // Get the user directly from the database
            $user = User::findOrFail($userId);
            $authId = auth()->id();
            
            // Prevent deleting the current admin user
            if ($user->getKey() == $authId) {
                throw new \Exception('You cannot delete your own account.');
            }
            
            $userName = $user->name;
            $user->delete();
            
            DB::commit();
            
            // Reset and close modal
            $this->reset(['deletingUser', 'deleteType', 'deleteItemName']);
            $this->showDeleteModal = false;
            
            // Show success message
            session()->flash('success', 'User "' . $userName . '" has been deleted successfully!');
            
            // Refresh the users list
            $this->loadStats();
            
            // Emit event to refresh any listening components
            $this->dispatch('userDeleted');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Error deleting user: ' . $e->getMessage());
        }
    }

    public function createUser()
    {
        $this->validate([
            'newUserName' => 'required|string|max:255',
            'newUserEmail' => 'required|email|unique:users,email',
            'newUserPassword' => 'required|min:8',
            'newUserPhone' => 'nullable|string|max:20',
            'newUserGender' => 'required|in:male,female,other',
            'newUserIsTrainer' => 'boolean',
        ]);

        try {
            DB::beginTransaction();
            
            $user = User::create([
                'name' => $this->newUserName,
                'email' => $this->newUserEmail,
                'password' => Hash::make($this->newUserPassword),
                'phone' => $this->newUserPhone,
                'gender' => $this->newUserGender,
                'is_trainer' => $this->newUserIsTrainer,
                'email_verified_at' => now(),
            ]);

            // Assign role based on is_trainer
            $role = $this->newUserIsTrainer ? 'trainer' : 'member';
            $user->assignRole($role);

            DB::commit();
            
            $this->resetNewUserForm();
            $this->showCreateUserModal = false;
            $this->loadStats();
            
            session()->flash('success', 'User created successfully!');
            $this->dispatch('user-created');
            
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Error creating user: ' . $e->getMessage());
        }
    }
    
    public function updateUser()
    {
        $this->validate([
            'editUserName' => 'required|string|max:255',
            'editUserEmail' => 'required|email|unique:users,email,' . $this->editingUser->id,
            'editUserPhone' => 'nullable|string|max:20',
            'editUserGender' => 'required|in:male,female,other',
            'editUserIsTrainer' => 'boolean',
        ]);

        try {
            DB::beginTransaction();
            
            $updateData = [
                'name' => $this->editUserName,
                'email' => $this->editUserEmail,
                'phone' => $this->editUserPhone,
                'gender' => $this->editUserGender,
                'is_trainer' => $this->editUserIsTrainer,
            ];

            $this->editingUser->update($updateData);

            // Update role if changed
            $role = $this->editUserIsTrainer ? 'trainer' : 'member';
            if (!$this->editingUser->hasRole($role)) {
                $this->editingUser->syncRoles([$role]);
            }

            DB::commit();
            
            $this->resetEditUserForm();
            $this->showEditUserModal = false;
            $this->loadStats();
            
            session()->flash('success', 'User updated successfully!');
            $this->dispatch('user-updated');
            
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Error updating user: ' . $e->getMessage());
        }
    }

    // Order Management Methods
    public function openEditOrderModal($orderId)
    {
        $this->editingOrder = Order::with(['user', 'items'])->findOrFail($orderId);
        $this->showEditOrderModal = true;
    }
    
    public function openDeleteOrderModal($orderId)
    {
        $this->deletingOrder = $orderId;
        $this->showDeleteOrderModal = true;
    }

    public function deleteOrder()
    {
        try {
            if ($this->deletingOrder) {
                DB::transaction(function () {
                    Order::findOrFail($this->deletingOrder)->delete();
                });
                
                session()->flash('success', 'Order deleted successfully!');
                $this->showDeleteOrderModal = false;
                $this->deletingOrder = null;
                $this->loadStats(); // Refresh stats
                $this->dispatch('order-deleted');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Error deleting order: ' . $e->getMessage());
        }
    }

    public function exportOrders()
    {
        // This would typically export to CSV or Excel
        return response()->streamDownload(function() {
            $orders = Order::with(['user', 'items'])->get();
            $handle = fopen('php://output', 'w');
            
            // Add headers
            fputcsv($handle, [
                'Order ID', 'Customer', 'Email', 'Total Amount', 'Status', 'Order Date'
            ]);
            
            // Add data
            foreach ($orders as $order) {
                fputcsv($handle, [
                    $order->id,
                    $order->user->name,
                    $order->user->email,
                    '₹' . number_format($order->total_amount, 2),
                    ucfirst($order->status),
                    $order->created_at->format('M d, Y H:i')
                ]);
            }
            
            fclose($handle);
        }, 'orders_export_' . now()->format('Y-m-d') . '.csv');
    }

    // Form reset methods
    public function resetPackageForm()
    {
        $this->reset([
            'packageName', 'packagePrice', 'packageDescription', 'packageCategory',
            'packageDurationMonths', 'packageDiscountPercentage', 'packageFeatures', 'packageIsActive', 'image'
        ]);
    }
    
    public function resetNewUserForm()
    {
        $this->newUserName = '';
        $this->newUserEmail = '';
        $this->newUserPassword = '';
        $this->newUserPhone = '';
        $this->newUserGender = 'male';
        $this->newUserIsTrainer = false;
    }

    public function resetEditUserForm()
    {
        $this->editUserName = '';
        $this->editUserEmail = '';
        $this->editUserPhone = '';
        $this->editUserGender = 'male';
        $this->editUserIsTrainer = false;
        $this->editingUser = null;
    }

    // Close modal methods
    public function closeModals()
    {
        $this->showCreateModal = false;
        $this->showEditModal = false;
        $this->showDeleteModal = false;
        $this->showCreateUserModal = false;
        $this->showEditUserModal = false;
        $this->showDeleteUserModal = false;
        $this->showEditOrderModal = false;
        $this->resetPackageForm();
        $this->resetUserForm();
    }

    /**
     * Set the active tab
     *
     * @param string $tab
     * @return void
     */
    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }
    
    public function render()
    {
        $query = Product::query();
        
        if (!empty($this->search)) {
            $query->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
        }
        
        if ($this->statusFilter) {
            $query->where('is_active', $this->statusFilter === 'active');
        }
        
        if ($this->dateFilter) {
            $query->whereDate('created_at', '>=', now()->sub($this->dateFilter . ' days'));
        }
        
        $packages = $query->latest()->paginate(10);
        
        $users = User::query()
            ->when($this->search, function($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10, ['*'], 'usersPage');
            
        $orders = Order::with(['user', 'product'])
            ->when($this->search, function($query) {
                $query->whereHas('user', function($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->latest()
            ->paginate(10, ['*'], 'ordersPage');
        
        return view('livewire.admin-dashboard', [
            'packages' => $packages,
            'users' => $users,
            'orders' => $orders,
        ]);
    }
    
    public function resetPackageModalForm()
    {
        $this->reset([
            'editPackageName', 'editPackagePrice', 'editPackageDescription', 'editPackageCategory',
            'editPackageDurationMonths', 'editPackageDiscountPercentage', 'editPackageFeatures', 'editPackageIsActive', 'image'
        ]);
        $this->resetErrorBag();
    }
    
    public function resetUserForm()
    {
        $this->reset([
            'editUserName', 'editUserEmail', 'editUserPhone', 'editUserGender', 'editUserIsTrainer'
        ]);
        $this->resetErrorBag();
    }
    
    public function resetOrderForm()
    {
        $this->reset([
            'editingOrder', 'deletingOrder'
        ]);
        $this->resetErrorBag();
    }
}