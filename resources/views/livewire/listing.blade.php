<div>

    <x-jet-banner />
    <div class="container">

        <div class="w-full flex justify-between p-2">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
            <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
            <script>
                window.addEventListener('alert', event => {
                    toastr[event.detail.type](event.detail.message,
                        event.detail.title ?? ''), toastr.options = {
                        "closeButton": false,
                        "progressBar": false,
                    }
                });
            </script>
            <div class="flex items-center mt-2 mb-6">
                <svg class="w-4 h-4 fill-current text-gray-500 ml-4 z-10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
                <input wire:model="search" type="search" class="p-2 m-2 rounded" placeholder="Search">
            </div>
          <div class="p-2 m-2">
<x-jet-button wire:click="ShowCreateModal" class="bg-green-500 p-2 m-2">
    Create
</x-jet-button></div>
        </div>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-lg-1 pg-empty-placeholder">
                    </div>
                    <div class="col-lg-10">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Website</th>
                                <th>Email</th>
                                <th>Bio</th>
                                <th>Photo</th>

                            </tr>
                            </thead>
                            <tbody wire:loading.class="opacity-50">
{{--@if(!empty($listings))--}}
    @forelse($listings as $listing)
        <tr>
        <th scope="row"></th>
        <td>{{$listing->name}}</td>
        <td>{{$listing->address}}</td>
        <td>{{$listing->website}}</td>
        <td>{{$listing->email}}</td>
        <td>{{$listing->bio}}</td>
        <td>
            <img class="img-thumbnail" src="{{asset('storage/' . $listing->photoname)}}" alt="" width="100" height="100">


        </td>
        <td>
            <x-jet-button wire:click="ShowEditModal({{$listing->id}})" class="bg-green-500  p-2 m-2" > Edit </x-jet-button>
            <x-jet-button wire:click="deleteListing({{$listing->id}})" class="bg-red-500">Delete</x-jet-button>



{{--            <a href="#" class="btn btn-primary pl-3 pr-3 rounded-pill text-uppercase">  <button type="button">--}}

{{--                </button>--}}
{{--                Edit</a>--}}
{{--            <a href="#" class="btn btn-danger ml-2 pl-2 pr-2 rounded-pill text-uppercase">  <button type="button">--}}

{{--                </button>--}}
{{--                Delete</a>--}}

{{--            <a href="#" class="btn btn-success ml-2 pl-2 pr-2 rounded-pill text-uppercase">  <button type="button">--}}

{{--                </button>--}}
{{--                Update</a>--}}

        </td>

    </tr>
        @empty
        <tr>
        <td>No Result</td>

        </tr>
    @endforelse
{{--@endif--}}

                            </tbody>

                        </table>
                        {{$listings->links()}}
                    </div>

                </div>
            </div>
        </section>
    </div>
    <x-jet-dialog-modal wire:model="showModal">
        <x-slot name="title">Create Listing</x-slot>
        <x-slot name="content">
            <div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form wire:submit.prevent="save" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="shadow sm:rounded-md sm:overflow-hidden">
                            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                                <div class="grid grid-cols-3 gap-6">
                                    <div class="col-span-3 sm:col-span-2">
                                        <label for="name" class="block text-sm font-medium text-gray-700">
                                            Name
                                        </label>
                                        <div class="mt-1 flex rounded-md shadow-sm">

                                            <input type="text" id="name" wire:model="name"
                                                   class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300"
                                                   placeholder="Name">
                                        </div>
                                        @error('name') <span class="text-red-400">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="grid grid-cols-3 gap-6">
                                    <div class="col-span-3 sm:col-span-2">
                                        <label for="address" class="block text-sm font-medium text-gray-700">
                                            Address
                                        </label>
                                        <div class="mt-1 flex rounded-md shadow-sm">

                                            <input type="text" id="address" wire:model="address"
                                                   class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300"
                                                   placeholder="Address">
                                        </div>
                                        @error('address') <span class="text-red-400">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="grid grid-cols-3 gap-6">
                                    <div class="col-span-3 sm:col-span-2">
                                        <label for="company_website" class="block text-sm font-medium text-gray-700">
                                            Website
                                        </label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <input type="text" wire:model="website" id="company_website"
                                                   class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300"
                                                   placeholder="www.example.com">
                                        </div>
                                        @error('website') <span class="text-red-400">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="grid grid-cols-3 gap-6">
                                    <div class="col-span-3 sm:col-span-2">
                                        <label for="email" class="block text-sm font-medium text-gray-700">
                                            Email
                                        </label>
                                        <div class="mt-1 flex rounded-md shadow-sm">

                                            <input type="email" id="email" wire:model="email"
                                                   class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300"
                                                   placeholder="Email">
                                        </div>
                                        @error('email') <span class="text-red-400">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="grid grid-cols-3 gap-6">
                                    <div class="col-span-3 sm:col-span-2">
                                        <label for="phone" class="block text-sm font-medium text-gray-700">
                                            Phone
                                        </label>
                                        <div class="mt-1 flex rounded-md shadow-sm">

                                            <input type="tel" id="phone" wire:model="phone"
                                                   class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-md sm:text-sm border-gray-300"
                                                   placeholder="Phone">
                                        </div>
                                        @error('phone') <span class="text-red-400">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div>
                                    <label for="about" class="block text-sm font-medium text-gray-700">
                                        Bio
                                    </label>
                                    <div class="mt-1">
                                        <textarea id="about" rows="3" wire:model="bio"
                                                  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md"
                                                  placeholder="bio"></textarea>
                                    </div>
                                    @error('bio') <span class="text-red-400">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label for="about" class="block text-sm font-medium text-gray-700">

                                    </label>
                                    <div class="mt-1">
                                        @if ($photo)
                                            Photo Preview:
                                            <img class="w-100 img-thumbnail" src="{{ $photo->temporaryUrl() }}">
                                        @else
                                                Photo Preview:
                                                <img class="w-100 img-thumbnail" src="{{asset('storage/' . $photoname)}}" alt="">

                                            @endif



                                        <input type="file" wire:model="photo" class="form-control-file"
                                               id="PhotoUpload1" name = "PhotoUpload1"  placeholder="Photo">

                                        @error('photo') <span class="error">{{ $message }}</span> @enderror
                                    </div>

                                </div>




                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            @if ($editMode)
                <x-slot name="title">Update Listing</x-slot>
                <x-jet-button wire:click="listingUpdate">Update</x-jet-button>
            @else
                <x-slot name="title">Create Listing</x-slot>
                <x-jet-button wire:click="createLisitng">Create</x-jet-button>
            @endif
        </x-slot>
    </x-jet-dialog-modal>

</div>
