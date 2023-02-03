<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

/**
 * @OA\Schema(schema="User",
 *      title="User",
 *      description="User model",
 *      type="object",
 *      required={"name", "email", "password"}
 * ){
 *    @OA\Property(property="id", type="integer", format="int64", example=1),
 *   @OA\Property(property="name", type="string", example="John Doe"),
 *  @OA\Property(property="api_token", type="string", example="api_token"),
 *  @OA\Property(property="email", type="string", format="email", example="jhon@admin.fr"),
 * @OA\Property(property="email_verified_at", type="string", format="date-time", example="2021-05-05T12:00:00+00:00"),
 * @OA\Property(property="created_at", type="string", format="date-time", example="2021-05-05T12:00:00+00:00"),
 * @OA\Property(property="updated_at", type="string", format="date-time", example="2021-05-05T12:00:00+00:00"),
 * }
 */
 
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public static function userAccessToken($token){
    //    if(Auth::guard('sanctum')->check()){
    //     $user = Auth::user();
    //     $user->api_token = $token;
    //     return $user;
          
    //    }else{
    //        return null;
    //    }
       
    // }

    // public function getApiTokenAttribute(){
    //     if($this->tokens()->where('tokenable_id', Auth::user()->id)->first()){
    //         return $this->tokens()->where('tokenable_id', Auth::user()->id)->first()->plainTextToken;
    //     }else{
    //         return null;
    //     }
       
    // }
       
}
