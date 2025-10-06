<div class="space-y-6">
    <div class="text-center lg:text-left">
        <h3 class="text-lg font-semibold text-gray-900 mb-2">Profile Information</h3>
        <p class="text-gray-600">Update your account's profile information and email address.</p>
    </div>

    <form wire:submit="updateProfileInformation" class="space-y-6">
        
        <!-- Profile Photo Section -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="flex flex-col lg:flex-row items-center space-y-4 lg:space-y-0 lg:space-x-6 p-6 bg-gray-50 rounded-xl">
                <!-- Current/Preview Photo -->
                <div class="relative">
                    <!-- Current Profile Photo -->
                    <div class="w-24 h-24 lg:w-32 lg:h-32" x-show="! photoPreview">
                        <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" 
                             class="w-full h-full rounded-full object-cover border-4 border-red-200 shadow-lg">
                    </div>

                    <!-- New Profile Photo Preview -->
                    <div class="w-24 h-24 lg:w-32 lg:h-32" x-show="photoPreview" style="display: none;">
                        <div class="w-full h-full rounded-full bg-cover bg-no-repeat bg-center border-4 border-red-200 shadow-lg"
                             x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                        </div>
                    </div>
                </div>

                <!-- Photo Actions -->
                <div class="flex-1 text-center lg:text-left">
                    <h4 class="text-lg font-semibold text-gray-900 mb-2">Profile Photo</h4>
                    <p class="text-gray-600 mb-4">Upload a new profile picture to personalize your account.</p>
                    
                    <div class="space-y-3">
                        <input type="file" id="photo" class="hidden"
                               wire:model.live="photo"
                               x-ref="photo"
                               x-on:change="
                                       photoName = $refs.photo.files[0].name;
                                       const reader = new FileReader();
                                       reader.onload = (e) => {
                                           photoPreview = e.target.result;
                                       };
                                       reader.readAsDataURL($refs.photo.files[0]);
                               " />

                        <button type="button" x-on:click.prevent="$refs.photo.click()" 
                                class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Select New Photo
                        </button>

                        @if ($this->user->profile_photo_path)
                            <button type="button" wire:click="deleteProfilePhoto" 
                                    class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Remove Photo
                            </button>
                        @endif
                    </div>

                    @error('photo')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        @endif

        <!-- Personal Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name -->
            <div class="space-y-2">
                <label for="name" class="block text-sm font-semibold text-gray-700">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Full Name
                    </div>
                </label>
                <input id="name" type="text" 
                       wire:model="state.name" 
                       required autocomplete="name"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition duration-200 bg-gray-50 focus:bg-white"
                       placeholder="Enter your full name">
                @error('name')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="space-y-2">
                <label for="email" class="block text-sm font-semibold text-gray-700">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                        </svg>
                        Email Address
                    </div>
                </label>
                <input id="email" type="email" 
                       wire:model="state.email" 
                       required autocomplete="username"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition duration-200 bg-gray-50 focus:bg-white"
                       placeholder="Enter your email address">
                @error('email')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror

                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mt-3">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-yellow-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                            <div>
                                <p class="text-sm text-yellow-800 font-medium">Your email address is unverified.</p>
                                <button type="button" wire:click.prevent="sendEmailVerification" 
                                        class="text-sm text-yellow-600 hover:text-yellow-800 underline font-medium">
                                    Click here to re-send the verification email.
                                </button>
                            </div>
                        </div>

                        @if ($this->verificationLinkSent)
                            <div class="mt-2 p-3 bg-green-50 border border-green-200 rounded-lg">
                                <p class="text-sm text-green-600 font-medium">
                                    A new verification link has been sent to your email address.
                                </p>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <!-- Save Button -->
        <div class="flex items-center justify-between pt-6 border-t border-gray-200">
            <div class="flex items-center">
                @if (session()->has('saved'))
                    <div class="flex items-center text-green-600 mr-4">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-sm font-medium">Profile updated successfully!</span>
                    </div>
                @endif
            </div>

            <button type="submit" wire:loading.attr="disabled" wire:target="photo"
                    class="bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-bold py-3 px-8 rounded-lg transition duration-200 flex items-center shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                <svg wire:loading wire:target="updateProfileInformation" class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Save Profile
            </button>
        </div>
    </form>
</div>
