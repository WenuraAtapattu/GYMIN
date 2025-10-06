<!-- Package Create/Edit Modal -->
@if($showCreateModal)
    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" wire:click="closeCreatePackageModal">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white" wire:click.stop>
            <div class="mt-3">
                <!-- Header -->
                <div class="flex items-center justify-between pb-3 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">
                        {{ $editingPackage ? 'Edit Package' : 'Create New Package' }}
                    </h3>
                    <button wire:click="closeCreatePackageModal" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Form -->
                <form wire:submit.prevent="{{ $editingPackage ? 'updatePackage' : 'createPackage' }}" class="mt-6">
                    <div class="grid grid-cols-1 gap-6">
                        <!-- Package Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Package Name</label>
                            <input wire:model="name" 
                                   type="text" 
                                   id="name"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500"
                                   placeholder="Enter package name">
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea wire:model="description" 
                                      id="description"
                                      rows="3"
                                      class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500"
                                      placeholder="Enter package description"></textarea>
                            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Price and Category Row -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700">Price ($)</label>
                                <input wire:model="price" 
                                       type="number" 
                                       id="price"
                                       step="0.01"
                                       min="0"
                                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500"
                                       placeholder="0.00">
                                @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
                                <select wire:model="category" 
                                        id="category"
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500">
                                    <option value="">Select Category</option>
                                    <option value="workout">Workout</option>
                                    <option value="diet">Diet</option>
                                    <option value="meal_plan">Meal Plan</option>
                                    <option value="training">Training</option>
                                    <option value="supplement">Supplement</option>
                                </select>
                                @error('category') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Duration and Status Row -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="duration_days" class="block text-sm font-medium text-gray-700">Duration (Days)</label>
                                <input wire:model="duration_days" 
                                       type="number" 
                                       id="duration_days"
                                       min="1"
                                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500"
                                       placeholder="30">
                                @error('duration_days') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="is_active" class="block text-sm font-medium text-gray-700">Status</label>
                                <select wire:model="is_active" 
                                        id="is_active"
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                @error('is_active') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Features -->
                        <div>
                            <label for="features" class="block text-sm font-medium text-gray-700">Features (one per line)</label>
                            <textarea wire:model="features" 
                                      id="features"
                                      rows="4"
                                      class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500"
                                      placeholder="Enter package features, one per line"></textarea>
                            @error('features') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Image Upload -->
                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700">Package Image</label>
                            <input wire:model="image" 
                                   type="file" 
                                   id="image"
                                   accept="image/*"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500">
                            @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            
                            @if($image)
                                <div class="mt-2">
                                    <img src="{{ $image->temporaryUrl() }}" class="h-20 w-20 object-cover rounded">
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-end pt-6 border-t border-gray-200 mt-6">
                        <button type="button" 
                                wire:click="closeCreatePackageModal"
                                class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gradient-to-r from-red-600 to-black hover:from-red-700 hover:to-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <span wire:loading.remove>{{ $editingPackage ? 'Update Package' : 'Create Package' }}</span>
                            <span wire:loading>
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Processing...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif