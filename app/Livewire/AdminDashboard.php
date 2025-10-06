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
    
    // User CRUD
    public $showCreateUserModal = false;
    public $showEditUserModal = false;
    public $showDeleteUserModal = false;
    public $editingUser = null;
    public $deletingUser = null;
    
    // User form fields
    public $userName = '';
    public $userEmail = '';
    public $userPassword = '';
    public $userPhone = '';
    public $userGender = 'male';
    public $userIsTrainer = false;
    public $userFitnessGoals = '';
    
    // New User form fields
    public $newUserName = '';
    public $newUserEmail = '';
    public $newUserPassword = '';
    public $newUserPhone = '';
    public $newUserGender = 'male';
    public $newUserIsTrainer = false;
    
    // Edit User form fields
    public $editUserName = '';
    public $editUserEmail = '';
    public $editUserPhone = '';
    public $editUserGender = 'male';
    public $editUserIsTrainer = false;
    
    // Order management
    public $showEditOrderModal = false;
    public $showDeleteOrderModal = false;
    public $editingOrder = null;
    public $deletingOrder = null;
    public $orderStatus = '';
    
    // Search and filters
    public $searchUsers = '';
    public $searchPackages = '';
    public $searchOrders = '';
    public $filterUserType = '';
    public $filterPackageCategory = '';
    public $filterOrderStatus = '';

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshStats' => 'loadStats'];

    public function mount()
    {
        $this->loadStats();
    }

    public function loadStats()
    {
        try {
            $this->stats = [
                'total_users' => User::where('is_admin', false)->count(),
                'total_trainers' => User::where('is_trainer', true)->count(),
                'total_packages' => Product::count(),
                'active_packages' => Product::where('is_active', true)->count(),
                'total_orders' => Order::count(),
                'pending_orders' => Order::where('status', 'pending')->count(),
                'completed_orders' => Order::where('status', 'completed')->count(),
                'total_revenue' => Order::where('status', 'completed')->sum('total_amount'),
                'monthly_revenue' => Order::where('status', 'completed')
                    ->whereMonth('created_at', now()->month)->sum('total_amount'),
                'active_members' => User::where('is_admin', false)
                    ->where('created_at', '>', now()->subDays(30))->count(),
                'recent_orders' => Order::with('user')->latest()->take(5)->get(),
                'popular_packages' => Product::orderBy('created_at', 'desc')->take(3)->get()
            ];
            
            // Dispatch event for real-time updates
            $this->dispatch('stats-updated');
        } catch (\Exception $e) {
            session()->flash('error', 'Error loading stats: ' . $e->getMessage());
        }
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetPage();
    }

    // Package CRUD Methods
    public function openCreatePackageModal()
    {
        $this->resetNewPackageForm();
        $this->showCreateModal = true;
    }

    public function openEditPackageModal($packageId)
    {
        $package = Product::findOrFail($packageId);
        $this->editingPackage = $package;
        
        // Populate form fields
        $this->name = $package->name;
        $this->price = $package->price;
        $this->description = $package->description;
        $this->category = $package->category;
        $this->brand = $package->brand ?? '';
        $this->model = $package->model ?? '';
        $this->stock_quantity = $package->stock_quantity ?? 0;
        $this->features = is_array($package->features) ? implode("\n", $package->features) : '';
        $this->is_active = $package->is_active;
        
        $this->showEditModal = true;
    }

    public function openDeletePackageModal($packageId)
    {
        $this->deletingPackage = Product::findOrFail($packageId);
        $this->showDeleteModal = true;
    }

    public function createPackage()
    {
        $this->validate([
            'name' => 'required|min:3|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|min:10',
            'category' => 'required|in:cardio,strength,accessories,supplements',
            'brand' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'stock_quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|max:10240', // 10MB max
        ]);

        try {
            DB::beginTransaction();
            
            $productData = [
                'name' => $this->name,
                'price' => $this->price,
                'description' => $this->description,
                'category' => $this->category,
                'brand' => $this->brand ?? 'Generic',
                'model' => $this->model ?? '',
                'specifications' => $this->features ? explode("\n", $this->features) : [],
                'features' => $this->features ? explode("\n", $this->features) : [],
                'stock_quantity' => $this->stock_quantity ?? 0,
                'sku' => 'GYMEQ-' . strtoupper(substr(uniqid(), -6)),
                'is_active' => $this->is_active ?? true,
                'is_featured' => false,
                'condition' => 'new',
            ];

            // Handle image upload
            if ($this->image) {
                $imagePath = $this->image->store('products', 'public');
                $productData['main_image'] = '/storage/' . $imagePath;
                $productData['images'] = ['/storage/' . $imagePath];
            } else {
                // Default images if no upload
                $productData['images'] = [
                    'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                    'https://images.unsplash.com/photo-1517838277536-f5f99be501cd?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
                ];
            }

            $product = Product::create($productData);

            DB::commit();
            
            // Clear form and close modal
            $this->resetPackageModalForm();
            $this->showCreateModal = false;
            
            // Clear search/filter to show new package
            $this->search = '';
            $this->filterCategory = '';
            
            // Refresh data and stats
            $this->loadStats();
            $this->resetPage('packages'); // Reset pagination to first page
            
            // Flash success message and dispatch event
            session()->flash('success', 'Product created successfully!');
            $this->dispatch('package-created');
            
            // Force full component refresh
            $this->dispatch('$refresh');
            
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Error creating product: ' . $e->getMessage());
        }
    }

    public function updatePackage()
    {
        $this->validate([
            'name' => 'required|min:3|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|min:10',
            'category' => 'required|in:cardio,strength,accessories,supplements',
            'brand' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'stock_quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|max:10240', // 10MB max
        ]);

        try {
            DB::beginTransaction();
            
            $updateData = [
                'name' => $this->name,
                'price' => $this->price,
                'description' => $this->description,
                'category' => $this->category,
                'brand' => $this->brand ?? 'Generic',
                'model' => $this->model ?? '',
                'specifications' => $this->features ? explode("\n", $this->features) : [],
                'features' => $this->features ? explode("\n", $this->features) : [],
                'stock_quantity' => $this->stock_quantity ?? 0,
                'is_active' => $this->is_active ?? true
            ];

            // Handle image upload if provided
            if ($this->image) {
                // Delete old image if exists
                if ($this->editingPackage->main_image && str_starts_with($this->editingPackage->main_image, '/storage/')) {
                    $oldImagePath = str_replace('/storage/', '', $this->editingPackage->main_image);
                    Storage::disk('public')->delete($oldImagePath);
                }
                
                // Store new image
                $imagePath = $this->image->store('products', 'public');
                $updateData['main_image'] = '/storage/' . $imagePath;
                $updateData['images'] = ['/storage/' . $imagePath];
            }
            
            $this->editingPackage->update($updateData);

            DB::commit();
            
            $this->resetPackageModalForm();
            $this->showEditModal = false;
            $this->editingPackage = null;
            
            session()->flash('success', 'Product updated successfully!');
            $this->loadStats();
            $this->dispatch('package-updated');
            
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('error', 'Error updating product: ' . $e->getMessage());
        }
    }

    public function confirmPackageDeletion($packageId)
    {
        $package = Product::findOrFail($packageId);
        $this->deletingPackage = $package;
        $this->deleteType = 'package';
        $this->deleteItemName = $package->name;
        $this->showDeleteModal = true;
    }

    public function confirmDelete()
    {
        if ($this->deletingPackage) {
            $this->deletePackage();
        }
    }

    public function deletePackage()
    {
        try {
            DB::beginTransaction();
            
            $this->deletingPackage->delete();
            
            DB::commit();
            
            $this->showDeleteModal = false;
            $this->deletingPackage = null;
            $this->loadStats();
            
            session()->flash('success', 'Product deleted successfully!');
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

    // User CRUD Methods
    public function openCreateUserModal()
    {
        $this->resetUserForm();
        $this->showCreateUserModal = true;
    }

    public function openEditUserModal($userId)
    {
        $user = User::findOrFail($userId);
        $this->editingUser = $user;
        
        $this->editUserName = $user->name;
        $this->editUserEmail = $user->email;
        $this->editUserPhone = $user->phone;
        $this->editUserGender = $user->gender;
        $this->editUserIsTrainer = $user->is_trainer;
        
        $this->showEditUserModal = true;
    }

    public function openDeleteUserModal($userId)
    {
        $this->deletingUser = User::findOrFail($userId);
        $this->showDeleteUserModal = true;
    }

    public function createUser()
    {
        $this->validate([
            'newUserName' => 'required|string|max:255',
            'newUserEmail' => 'required|email|unique:users,email',
            'newUserPassword' => 'required|min:8',
            'newUserPhone' => 'nullable|string|max:20',
            'newUserGender' => 'required|in:male,female,other'
        ]);

        try {
            DB::beginTransaction();
            
            User::create([
                'name' => $this->newUserName,
                'email' => $this->newUserEmail,
                'password' => Hash::make($this->newUserPassword),
                'phone' => $this->newUserPhone,
                'gender' => $this->newUserGender,
                'is_trainer' => $this->newUserIsTrainer,
                'fitness_goals' => [],
                'email_verified_at' => now()
            ]);

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
            'editUserGender' => 'required|in:male,female,other'
        ]);

        try {
            DB::beginTransaction();
            
            $updateData = [
                'name' => $this->editUserName,
                'email' => $this->editUserEmail,
                'phone' => $this->editUserPhone,
                'gender' => $this->editUserGender,
                'is_trainer' => $this->editUserIsTrainer
            ];

            $this->editingUser->update($updateData);

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

    public function deleteUser()
    {
        try {
            DB::beginTransaction();
            
            $this->deletingUser->delete();
            
            DB::commit();
            
            $this->showDeleteUserModal = false;
            $this->deletingUser = null;
            $this->loadStats();
            
            session()->flash('success', 'User deleted successfully!');
            $this->dispatch('user-deleted');
            
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Error deleting user: ' . $e->getMessage());
        }
    }

    // Order Management
    public function openEditOrderModal($orderId)
    {
        $order = Order::findOrFail($orderId);
        $this->editingOrder = $order;
        $this->orderStatus = $order->status;
        $this->showEditOrderModal = true;
    }

    public function updateOrderStatus($orderId, $newStatus)
    {
        try {
            DB::beginTransaction();
            
            $order = Order::findOrFail($orderId);
            $order->update(['status' => $newStatus]);
            
            DB::commit();
            
            $this->loadStats();
            
            session()->flash('success', 'Order status updated successfully!');
            $this->dispatch('order-updated');
            
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Error updating order status: ' . $e->getMessage());
        }
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
        session()->flash('success', 'Orders export feature will be implemented!');
    }

    public function viewOrderDetails($orderId)
    {
        // This would show order details modal or redirect to order page
        session()->flash('success', 'Order details view will be implemented!');
    }

    // Reset form methods
    public function resetPackageForm()
    {
        $this->packageName = '';
        $this->packagePrice = '';
        $this->packageDescription = '';
        $this->packageCategory = 'fitness';
        $this->packageDurationMonths = 1;
        $this->packageDiscountPercentage = 0;
        $this->packageFeatures = '';
        $this->packageIsActive = true;
        $this->editingPackage = null;
    }

    public function resetUserForm()
    {
        $this->userName = '';
        $this->userEmail = '';
        $this->userPassword = '';
        $this->userPhone = '';
        $this->userGender = 'male';
        $this->userIsTrainer = false;
        $this->userFitnessGoals = '';
        $this->editingUser = null;
    }

    public function resetNewPackageForm()
    {
        $this->newPackageName = '';
        $this->newPackagePrice = '';
        $this->newPackageDescription = '';
        $this->newPackageCategory = 'fitness';
    }

    public function resetEditPackageForm()
    {
        $this->editPackageName = '';
        $this->editPackagePrice = '';
        $this->editPackageDescription = '';
        $this->editPackageCategory = 'fitness';
        $this->editingPackage = null;
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

    // Modal methods
    public function closeCreatePackageModal()
    {
        $this->showCreateModal = false;
        $this->editingPackage = null;
        $this->resetPackageModalForm();
    }

    public function closeCreateUserModal()
    {
        $this->showCreateUserModal = false;
        $this->editingUser = null;
        $this->resetUserModalForm();
    }

    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->deletingPackage = null;
        $this->deleteType = null;
        $this->deleteItemName = null;
    }

    // Additional properties for modals
    public $name = '';
    public $description = '';
    public $price = '';
    public $category = '';
    public $duration_days = 30;
    public $is_active = 1;
    public $features = '';
    public $image = null;
    public $brand = '';
    public $model = '';
    public $stock_quantity = 0;

    // User modal properties
    public $userPasswordConfirmation = '';
    public $isAdmin = false;
    public $isTrainer = false;

    // Delete modal properties
    public $deleteType = null;
    public $deleteItemName = null;

    // Search and filter properties
    public $search = '';
    public $filterCategory = '';

    // Package modal form methods
    private function resetPackageModalForm()
    {
        $this->name = '';
        $this->description = '';
        $this->price = '';
        $this->category = '';
        $this->duration_days = 30;
        $this->is_active = 1;
        $this->features = '';
        $this->image = null;
        $this->brand = '';
        $this->model = '';
        $this->stock_quantity = 0;
    }

    // User modal form methods
    private function resetUserModalForm()
    {
        $this->userName = '';
        $this->userEmail = '';
        $this->userPassword = '';
        $this->userPasswordConfirmation = '';
        $this->userPhone = '';
        $this->isAdmin = false;
        $this->isTrainer = false;
    }

    // Watch for search changes
    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedFilterCategory()
    {
        $this->resetPage();
    }

    public function render()
    {
        $usersQuery = User::where('is_admin', false);
        
        if ($this->searchUsers) {
            $usersQuery->where(function($q) {
                $q->where('name', 'like', '%' . $this->searchUsers . '%')
                  ->orWhere('email', 'like', '%' . $this->searchUsers . '%');
            });
        }
        
        if ($this->filterUserType === 'trainers') {
            $usersQuery->where('is_trainer', true);
        } elseif ($this->filterUserType === 'members') {
            $usersQuery->where('is_trainer', false);
        }
        
        $users = $usersQuery->latest()->paginate(10, ['*'], 'users');

        $packagesQuery = Product::query();
        
        if ($this->searchPackages) {
            $packagesQuery->where('name', 'like', '%' . $this->searchPackages . '%');
        }
        
        if ($this->filterPackageCategory) {
            $packagesQuery->where('category', $this->filterPackageCategory);
        }
        
        $packages = $packagesQuery->latest()->paginate(10, ['*'], 'packages');

        $ordersQuery = Order::with(['user', 'product']);
        
        if ($this->searchOrders) {
            $ordersQuery->whereHas('user', function($q) {
                $q->where('name', 'like', '%' . $this->searchOrders . '%')
                  ->orWhere('email', 'like', '%' . $this->searchOrders . '%');
            });
        }
        
        if ($this->filterOrderStatus) {
            $ordersQuery->where('status', $this->filterOrderStatus);
        }
        
        $orders = $ordersQuery->latest()->paginate(10, ['*'], 'orders');

        return view('livewire.admin-dashboard', compact('users', 'packages', 'orders'));
    }
}