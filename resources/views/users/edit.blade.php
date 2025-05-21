<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form id="edit-user-form" action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                            <span id="name-error" class="text-red-500 text-xs italic hidden"></span>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror">
                            @error('email')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                            <span id="email-error" class="text-red-500 text-xs italic hidden"></span>
                        </div>

                        <div class="mb-4">
                            <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Phone Number:</label>
                            <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $user->phone_number) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('phone') border-red-500 @enderror">
                            @error('phone_number')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                            <span id="phone-error" class="text-red-500 text-xs italic hidden"></span>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Gender:</label>
                            <div class="mt-2">
                                <label class="inline-flex items-center">
                                    <input type="radio" class="form-radio" name="gender" value="male" {{ old('gender', $user->gender) == 'male' ? 'checked' : '' }}>
                                    <span class="ml-2">Male</span>
                                </label>
                                <label class="inline-flex items-center ml-6">
                                    <input type="radio" class="form-radio" name="gender" value="female" {{ old('gender', $user->gender) == 'female' ? 'checked' : '' }}>
                                    <span class="ml-2">Female</span>
                                </label>
                                <label class="inline-flex items-center ml-6">
                                    <input type="radio" class="form-radio" name="gender" value="other" {{ old('gender', $user->gender) == 'other' ? 'checked' : '' }}>
                                    <span class="ml-2">Other</span>
                                </label>
                            </div>
                            @error('gender')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                            <span id="gender-error" class="text-red-500 text-xs italic hidden"></span>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Hobbies:</label>
                            <div class="mt-2">
                                @foreach($hobbies as $hobby)
                                    <label class="inline-flex items-center mr-4 mb-2">
                                        <input type="checkbox" class="form-checkbox" name="hobbies[]" value="{{ $hobby->id }}" 
                                            {{ (is_array(old('hobbies')) && in_array($hobby->id, old('hobbies'))) || 
                                               (empty(old('hobbies')) && $user->hobbies->contains($hobby->id)) ? 'checked' : '' }}>
                                        <span class="ml-2">{{ $hobby->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                            @error('hobbies')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                            <span id="hobbies-error" class="text-red-500 text-xs italic hidden"></span>
                        </div>

                        <div class="mb-4">
                            <label for="role_id" class="block text-gray-700 text-sm font-bold mb-2">Role:</label>
                            <select name="role_id" id="role_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('role_id') border-red-500 @enderror">
                                <option value="">Select Role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                            <span id="role_id-error" class="text-red-500 text-xs italic hidden"></span>
                        </div>

                        <div class="mb-8">
                            <h3 class="font-semibold text-lg text-gray-800 mb-4">Change Password (leave blank to keep current password)</h3>
                            
                            <div class="mb-4">
                                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">New Password:</label>
                                <input type="password" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror">
                                @error('password')
                                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                                <span id="password-error" class="text-red-500 text-xs italic hidden"></span>
                            </div>

                            <div class="mb-4">
                                <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirm New Password:</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <span id="password_confirmation-error" class="text-red-500 text-xs italic hidden"></span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" class="btn btn-primary hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" id="submit-btn">
                                Update User
                            </button>
                            <a href="{{ route('users.index') }}" class="bg-gray-500 btn btn-danger bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        $(document).ready(function() {
            $('#edit-user-form').submit(function(e) {
                let isValid = true;
                // Clear previous errors
                $('.text-red-500').hide();
                
                // Validate Name
                if ($('#name').val() === '') {
                    $('#name-error').text('The name field is required.').removeClass('hidden').show();
                    isValid = false;
                }
                
                // Validate Email
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if ($('#email').val() === '') {
                    $('#email-error').text('The email field is required.').removeClass('hidden').show();
                    isValid = false;
                } else if (!emailRegex.test($('#email').val())) {
                    $('#email-error').text('Please enter a valid email address.').removeClass('hidden').show();
                    isValid = false;
                }
                
              
                if ($('#phone_number').val() === '') {
                    $('#phone-error').text('The phone field is required.').removeClass('hidden').show();
                    isValid = false;
                }
                
                else if($('#phone_number').val().length>10){
                    $('#phone-error').text('The phone Number should be only 10 digits').removeClass('hidden').show();
                    isValid = false;
                }
             
                if (!$('input[name="gender"]:checked').val()) {
                    $('#gender-error').text('Please select a gender.').removeClass('hidden').show();
                    isValid = false;
                }
                
               
                if (!$('input[name="hobbies[]"]:checked').length) {
                    $('#hobbies-error').text('Please select at least one hobby.').removeClass('hidden').show();
                    isValid = false;
                }
                
                // Validate Role
                if ($('#role_id').val() === '') {
                    $('#role_id-error').text('Please select a role.').removeClass('hidden').show();
                    isValid = false;
                }
                
              
                if ($('#password').val() !== '') {
                    if ($('#password').val().length < 8) {
                        $('#password-error').text('The password must be at least 8 characters.').removeClass('hidden').show();
                        isValid = false;
                    }
                    
                    if ($('#password').val() !== $('#password_confirmation').val()) {
                        $('#password_confirmation-error').text('The password confirmation does not match.').removeClass('hidden').show();
                        isValid = false;
                    }
                }
                
                if (!isValid) {
                    e.preventDefault(); // Prevent form submission
                }
            });
        });
    </script>
    @endpush
</x-app-layout>