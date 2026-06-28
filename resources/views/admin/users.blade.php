<x-sidebar-layout>
    <div class="py-2">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white p-6 shadow-sm rounded-lg">
                <h2 class="text-xl font-bold mb-4">Manajemen User</h2>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="p-3 border">Nama</th>
                            <th class="p-3 border">Email</th>
                            <th class="p-3 border">Role</th>
                            <th class="p-3 border text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td class="p-3 border">{{ $user->name }}</td>
                            <td class="p-3 border">{{ $user->email }}</td>
                            
                            <td class="p-3 border">
                                <form action="{{ route('admin.users.updateRole', $user->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <select name="role" onchange="this.form.submit()" class="border-gray-300 rounded-md shadow-sm">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                                {{ ucfirst($role->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>

                            <td class="p-3 border text-center">
                                <div class="flex flex-col gap-2 items-center">
                                    {{-- Form Reset Password --}}
                                    <form action="{{ route('admin.users.resetPassword', $user->id) }}" method="POST" class="flex flex-col gap-1 w-full max-w-[160px]">
                                        @csrf @method('PATCH')
                                        <input type="password" name="password" placeholder="Pass Baru" required class="text-xs p-1 border rounded">
                                        <input type="password" name="password_confirmation" placeholder="Konf. Pass" required class="text-xs p-1 border rounded">
                                        <button type="submit" class="bg-yellow-500 text-white text-xs px-2 py-1 rounded hover:bg-yellow-600">Reset Pass</button>
                                    </form>

                                    {{-- Form Hapus --}}
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini?')" class="mt-2">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 font-bold text-sm">Hapus User</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-sidebar-layout>