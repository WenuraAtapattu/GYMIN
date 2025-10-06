<!-- User Create/Edit Modal -->
@if($showCreateUserModal)
    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" wire:click="closeCreateUserModal">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 shadow-lg rounded-md bg-white" wire:click.stop>
            <div class="mt-3">
                <!-- Header -->
                <div class="flex items-center justify-between pb-3 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">
                        {{ $editingUser ? 'Edit User' : 'Create New User' }}
                    </h3>
                    <button wire:click="closeCreateUserModal" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Form -->
                <form wire:submit.prevent="{{ $editingUser ? 'updateUser' : 'createUser' }}" class="mt-6">
                    <div class="grid grid-cols-1 gap-6">
                        <!-- Name -->
                        <div>
                            <label for="userName" class="block text-sm font-medium text-gray-700">Full Name</label>
                            <input wire:model="userName" 
                                   type="text" 
                                   id="userName"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500"
                                   placeholder="Enter full name">
                            @error('userName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="userEmail" class="block text-sm font-medium text-gray-700">Email Address</label>
                            <input wire:model="userEmail" 
                                   type="email" 
                                   id="userEmail"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500"
                                   placeholder="Enter email address">
                            @error('userEmail') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Password (only for new users) -->
                        @if(!$editingUser)
                            <div>
                                <label for="userPassword" class="block text-sm font-medium text-gray-700">Password</label>
                                <input wire:model="userPassword" 
                                       type="password" 
                                       id="userPassword"
                                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500"
                                       placeholder="Enter password">
                                @error('userPassword') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="userPasswordConfirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                                <input wire:model="userPasswordConfirmation" 
                                       type="password" 
                                       id="userPasswordConfirmation"
                                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500"
                                       placeholder="Confirm password">
                                @error('userPasswordConfirmation') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        @endif

                        <!-- Role Selection -->
                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex items-center">
                                <input wire:model="isAdmin" 
                                       type="checkbox" 
                                       id="isAdmin"
                                       class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded">
                                <label for="isAdmin" class="ml-2 block text-sm text-gray-900">
                                    Administrator
                                </label>
                            </div>

                            <div class="flex items-center">
                                <input wire:model="isTrainer" 
                                       type="checkbox" 
                                       id="isTrainer"
                                       class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded">
                                <label for="isTrainer" class="ml-2 block text-sm text-gray-900">
                                    Trainer
                                </label>
                            </div>
                        </div>

                        <!-- Phone (optional) -->
                        <div>
                            <label for="userPhone" class="block text-sm font-medium text-gray-700">Phone Number (Optional)</label>
                            <input wire:model="userPhone" 
                                   type="tel" 
                                   id="userPhone"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-red-500 focus:border-red-500"
                                   placeholder="Enter phone number">
                            @error('userPhone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-end pt-6 border-t border-gray-200 mt-6">
                        <button type="button" 
                                wire:click="closeCreateUserModal"
                                class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gradient-to-r from-red-600 to-black hover:from-red-700 hover:to-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <span wire:loading.remove>{{ $editingUser ? 'Update User' : 'Create User' }}</span>
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