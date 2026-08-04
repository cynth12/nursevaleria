<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Mostrar únicamente los enfermeros.
     */
    public function index()
    {
        $users = User::where('is_shift_nurse', true)
            ->orderBy('name')
            ->paginate(10);

        return view('users.index', compact('users'));
    }

    /**
     * Formulario para crear un enfermero.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Guardar un nuevo enfermero.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|email|max:150|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'is_shift_nurse' => true,
            'is_active' => true,
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Formulario para editar un enfermero.
     */
    public function edit(User $user)
    {
        $this->ensureShiftNurse($user);

        return view('users.edit', compact('user'));
    }

    /**
     * Actualizar nombre, correo y contraseña.
     */
    public function update(Request $request, User $user)
    {
        $this->ensureShiftNurse($user);

        $data = $request->validate([
            'name' => 'required|string|max:150',
            'email' => [
                'required',
                'email',
                'max:150',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $updateData = [
            'name' => $data['name'],
            'email' => $data['email'],
        ];

        /*
         * Si la contraseña queda vacía, conserva la anterior.
         */
        if (!empty($data['password'])) {
            $updateData['password'] = Hash::make($data['password']);
        }

        $user->update($updateData);

        return redirect()
            ->route('users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Activar o desactivar al enfermero.
     */
    public function toggle(User $user)
    {
        $this->ensureShiftNurse($user);

        $user->update([
            'is_active' => !$user->is_active,
        ]);

        $message = $user->is_active
            ? 'User activated successfully.'
            : 'User deactivated successfully.';

        return redirect()
            ->route('users.index')
            ->with('success', $message);
    }

    /**
     * Eliminar definitivamente al enfermero.
     */
    public function destroy(User $user)
    {
        $this->ensureShiftNurse($user);

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'User deleted successfully.');
    }

    /**
     * Evitar que se edite o elimine al administrador.
     */
    private function ensureShiftNurse(User $user): void
    {
        abort_unless(
            $user->is_shift_nurse,
            403,
            'You cannot modify an administrator account.'
        );
    }
}