<x-form-section submit="updateProfileInformation">
    @include('admin.partials.loader')
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>
    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>
    <x-slot name="form">

        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
<section class="relative pt-36 pb-15">
    <img src="https://pagedone.io/asset/uploads/1705471739.png" alt="cover-image" class="w-full absolute top-0 left-0 z-0 h-60 object-cover">
    <div class="w-full mx-auto px-6 md:px-8">
        <div class="flex items-center justify-center relative z-10 mb-2.5">

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


                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full size-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full size-20 bg-cover bg-no-repeat bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

            </div>

                <div class="flex flex-col sm:flex-row max-sm:gap-5 items-center justify-center mb-5 mt-5">

                    <div class="flex items-center gap-4">
                        <button  x-on:click.prevent="$refs.photo.click()"  type="button"
                            class="rounded-full border border-solid border-indigo-600 bg-indigo-600 py-3 px-4 text-sm font-semibold text-white whitespace-nowrap shadow-sm
                            shadow-transparent transition-all duration-500 hover:shadow-gray-200 hover:bg-indigo-700 hover:border-indigo-700">
                            Subir imagen  </button>

                            @if ($this->user->profile_photo_path)
                            <button  wire:click="deleteProfilePhoto" type="button"
                            class="rounded-full border border-solid border-gray-300 bg-gray-50 py-3 px-4 text-sm font-semibold
                             text-gray-900 shadow-sm shadow-transparent transition-all duration-500 hover:shadow-gray-50 hover:bg-gray-100
                              hover:border-gray-300">Remover foto</button>
                        @endif


                    </div>
                </div>


                <x-input-error for="photo" class="mt-2" />


        </div>

        <h3 class="text-center font-manrope font-bold text-3xl leading-10 text-gray-900 mb-3">{{ Auth()->user()->name }}</h3>
        <p class="font-normal text-base leading-7 text-gray-500 text-center ">Administrador</p>
    </div>
</section>

        @endif

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4 mb-4">
            <x-label for="name" value="{{ __('Name') }}" />
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model="state.name" autocomplete="name" />
            <x-input-error for="name" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4 mb-4">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="email" class="mt-1 block w-full" wire:model="state.email" autocomplete="username" />
            <x-input-error for="email" class="mt-2" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
            <p class="text-sm mt-2">
                {{ __('Your email address is unverified.') }}

                <button type="button" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" wire:click.prevent="sendEmailVerification">
                {{ __('Click here to re-send the verification email.') }}
                </button>
            </p>

            @if ($this->verificationLinkSent)
                <p class="mt-2 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to your email address.') }}
                </p>
            @endif
            @endif
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-button>
    </x-slot>

</x-form-section>
