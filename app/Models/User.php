<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\Role;
use App\Providers\RouteServiceProvider;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'name',
        'username',
        'city',
        'country',
        'about_me',
        'profile_image',
        'password',
        'cover_image',
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

    public function images(){
        return $this->hasMany(Image::class);
    }

    public function social(){
        return $this->hasOne(Social::class)->withDefault();
    }

    public function setting(): HasOne{
        return $this->hasOne(Settings::class)->withDefault();
    }

    public function comments(): HasMany{
        return $this->hasMany(Comment::class);
    }

    public function likes() : BelongsToMany{
        return $this->belongsToMany(Image::class,'likes','user_id','image_id')->withTimestamps();
    }
    public function favorites() : BelongsToMany{
        return $this->belongsToMany(Image::class,'favorites','user_id','image_id')->withTimestamps();
    }

    protected static function booted() : void
    {
        static::created(function($user){
            $user->setting()->create([
                'email_notification' => [
                    'new_comment' => 1,
                    'new_image'   => 1,
                ]
            ]);
        });
    }

    public static function makeDirectory(): string
    {
        $directory = 'users';
        Storage::makeDirectory($directory);
        return $directory;
    }

    public function updateSettings($data) : void
    {
        $this->update($data['user']);
        $this->updateSocialProfile($data['social']);
        $this->updateOptions($data['options']);
    }

    public function updateOptions($options) : void
    {
        $this->setting()->update($options);
    }

    public function url()
    {
        return route('author.show',$this->username);
    }

    public function inlineProfile() {
        // Eding Muhamad Saprudin &nbsp; • &nbsp; Indonesia &nbsp; • &nbsp; Member since Oct. 28,
        //             2017 &nbsp; • &nbsp; 40
        //             images
        return collect([
            $this->name,
            trim(join('/', [$this->city, $this->country]), '/'),
            'Member Since' . $this->created_at->toFormattedDateString(),
            $this->getImagesCount(),
        ])->filter()->implode('•');
    }

    public function profileImageUrl(){
        return Storage::url($this->profile_image ? $this->profile_image :
            'users/user-default.png');
    }

    public function coverImageUrl(){
        return Storage::url($this->cover_image);
    }

    public function hasCoverImage(){
        return !!$this->cover_image;
    }

    public function updateSocialProfile($social){
        Social::updateOrCreate(
            ['user_id' => $this->id],
            $social
        );
        // if($this->social()->exists())
        //     $this->social()->update($social);
        // else $this->social()->create($social);
    }

    public function getImagesCount(){
        $imagesCount = $this->images()->published()->count();
        return $imagesCount .' '. str()->plural('photo',$imagesCount);
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'role' => Role::class,
    ];
}
