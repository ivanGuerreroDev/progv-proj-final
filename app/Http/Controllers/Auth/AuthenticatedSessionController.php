<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */

    public function store(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();

        $user = Auth::user();
        $ipAddress = $request->ip();
        $userAgent = $request->header('User-Agent');
        $osInfo = php_uname('s') . ' ' . php_uname('r');
        $createdAt = Carbon::now();

        // Registrar en la base de datos
        DB::table('logs')->insert([
            'user_id' => $user->id,
            'ip_address' => $ipAddress,
            'os_info' => $osInfo,
            'user_agent' => $userAgent,
            'session_duration' => null,
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ]);

        // Registrar en un archivo de log compatible con Log Viewer
        Log::channel('daily')->info('Login event', [
            'user_id' => $user->id,
            'ip_address' => $ipAddress,
            'os_info' => $osInfo,
            'user_agent' => $userAgent,
            'created_at' => $createdAt,
        ]);

        return redirect()->intended(route('dashboard'));
    }


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        $userId = Auth::id(); // ID del usuario autenticado

        // Obtener el registro más reciente del usuario en la tabla logs
        $startTime = DB::table('logs')
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($startTime) {
            // Calcular la duración de la sesión
            $endTime = Carbon::now();
            $sessionDuration = $endTime->diff($startTime->created_at)->format('%H:%I:%S');

            // Actualizar la duración de la sesión en la tabla logs
            DB::table('logs')
                ->where('id', $startTime->id)
                ->update(['session_duration' => $sessionDuration]);

            // Registrar la información en el archivo de log
            Log::channel('daily')->info('Session ended', [
                'user_id' => $userId,
                'session_duration' => $sessionDuration,
                'ip_address' => $startTime->ip_address,
                'os_info' => $startTime->os_info,
                'user_agent' => $startTime->user_agent,
                'updated_at' => Carbon::now(),
            ]);
        }

        // Cerrar la sesión del usuario
        Auth::guard('web')->logout();

        // Invalidar la sesión actual
        $request->session()->invalidate();

        // Regenerar el token CSRF
        $request->session()->regenerateToken();

        // Redirigir al usuario a la página de inicio
        return redirect('/');
    }

}
