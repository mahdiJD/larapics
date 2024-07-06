<?php

namespace App\Http\Requests;

use App\Models\Image;
use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->method()=='PUT'){
            return [
                'title' => 'required',
                'tags' => 'required'
            ];
        }
        return [
            'file' => 'required|image',
            'title' => 'nullable',
            'tags' => 'nullable',
        ];
    }
    public function getData(){
        $data = $this->validated() + [
            'user_id' => $this->user()->id,
            ];
        if ($this->hasFile('file')){  // برای بروز رسانی که عکس نداریم
            $directory = Image::makeDirectory();
            $data['file'] = $this->file->store($directory);
            $data['dimension'] = Image::getDimension($data['file']);
        }
//        if ($title = $data['title']){
//            $data['slug'] = $this->getSlug($title );
//        }
        return $data;
    }
//    protected function getSlug($title){
//        $slug = str($title)->slug();
//        $numSlugsFound =Image::where('slug','regexp',"^".$slug."(-[0-9])?")->count();
//        if ($numSlugsFound > 0){
//            return $slug . "-" . $numSlugsFound + 1;
//        }
//        return $slug;
//    }
}
