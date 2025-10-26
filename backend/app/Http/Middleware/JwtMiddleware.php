public function handle($request, Closure $next)
{
    try {
        $user = JWTAuth::parseToken()->authenticate();
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
    } catch (TokenExpiredException $e) {
        return response()->json(['error' => 'Token expired'], 401);
    } catch (TokenInvalidException $e) {
        return response()->json(['error' => 'Token invalid'], 401);
    } catch (JWTException $e) {
        return response()->json(['error' => 'Token absent'], 401);
    }

    return $next($request);
}