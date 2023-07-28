<?php

namespace App\Http\Middleware;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Carbon;
use Closure;
use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;

class TrustToken
{
    /**
     * Gère une requête entrante.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifie si la route a un paramètre "token".
        if ($request->route()->hasParameter("token")) {
            // Recherche le jeton d'accès personnel par rapport au paramètre "token".
            $token = PersonalAccessToken::findToken($request->route()->token);
            // Vérifie si le jeton est trouvé et s'il n'a pas expiré.
            if ($token && optional($token)->expires_at > now()) {
                // Si le jeton est valide, passe à la middleware suivante dans la chaîne de traitement.
                return $next($request);
            }
        }
        // Si le jeton est inexistant ou expiré, renvoie une réponse JSON indiquant que le token n'est pas valide.
        return response()->json([['error'=>' ',"Message"=>"token non valide" ,'status'=>'failed']]);
    }
}
