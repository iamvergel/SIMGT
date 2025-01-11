<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    // Fetch all images (paginated)
    public function index()
    {
        $images = Image::paginate();  // Paginate as needed
        return response()->json($images);
    }

    // Store a new image
    public function store(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Handle image upload
        $fileName = time() . '.' . $request->image->extension();
        $request->image->storeAs('images', $fileName, 'public');

        // Create and save image record in the database
        $image = Image::create([
            'name' => $request->name,
            'file_name' => $fileName,
        ]);

        return response()->json(['message' => 'Image uploaded successfully!', 'data' => $image], 201);
    }

    // Show a specific image by ID
    public function show($id)
    {
        $image = Image::find($id);
        if (!$image) {
            return response()->json(['message' => 'Image not found'], 404);
        }

        return response()->json($image);
    }

    // Update an existing image
    public function update(Request $request, $id)
    {
        // Log the incoming request data for debugging
        \Log::info($request->all());

        // Validate incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = Image::find($id);

        // Check if the image exists
        if (!$image) {
            return response()->json(['message' => 'Image not found'], 404);
        }

        // Update image name
        $image->name = $request->name;

        // Check if a new image file was uploaded
        if ($request->hasFile('image')) {
            // Delete old image file
            Storage::disk('public')->delete('images/' . $image->file_name);

            // Store the new image and update the filename
            $fileName = time() . '.' . $request->image->extension();
            $request->image->storeAs('images', $fileName, 'public');

            // Update the file name in the database
            $image->file_name = $fileName;
        }

        // Save the updated image record
        $image->save();

        // Return the updated image data as a response
        return response()->json(['message' => 'Image updated successfully!', 'data' => $image]);
    }

    // Delete an image
    public function destroy($id)
    {
        $image = Image::find($id);
        if (!$image) {
            return response()->json(['message' => 'Image not found'], 404);
        }

        // Delete image from storage
        Storage::disk('public')->delete('images/' . $image->file_name);

        // Delete the record from the database
        $image->delete();

        return response()->json(['message' => 'Image deleted successfully!']);
    }
}
