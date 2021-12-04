<?php
namespace App\Services;

use Illuminate\Support\Facades\Storage;
use \Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImageUploadService
{
    protected object $image;
    protected string $path = '';
    protected string $extension;
    protected string $filename;

    /**
     * @param $image
     * @return $this
     */
    public function make($image): object
    {
        $this->extension = is_string($image) ? "png" : $image->extension();
        $this->filename = Str::random(24).".$this->extension";

        $this->image = Image::make($image);
        $this->image->encode($this->extension, 90);

        return $this;
    }

    /**
     * @param string $path
     * @return object
     */
    public function path(string $path): object
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @param string $method
     * @param array $size
     * @return object
     */
    public function resize(string $method, array $size): object
    {
        $this->image->$method(key($size), $size[key($size)], function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        return $this;
    }

    /**
     * @return string
     */
    public function upload(): string
    {
        $path = "$this->path/$this->filename";

        Storage::disk(config('filesystems.default'))->put("public/$path", $this->image->stream(), 'public');

        return $path;
    }

    public function deleteImage($path): ImageUploadService
    {
        Storage::disk(config('filesystems.default'))->delete("public/$path");

        return $this;
    }
}

