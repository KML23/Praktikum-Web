<?php

namespace App\Http\Controllers\Api;

// Import model gamelist
use App\Models\gamelist;

use Illuminate\Http\Request;

// Import resource gamelistResource
use App\Http\Controllers\Controller;

// Import Http request
use App\Http\Resources\gamelistResource;

// Import facade Validator
use Illuminate\Support\Facades\Validator;

// Import facade Storage
use Illuminate\Support\Facades\Storage;

class GamelistController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        // Get all gamelist
        $gamelist = gamelist::latest()->paginate(5);

        // Return collection of gamelist as a resource
        return new gamelistResource(true, 'List Data gamelist', $gamelist);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'gamename'   => 'required|string|max:255',
            'genre'      => 'required|string|max:255',
            'release'    => 'required|string|max:255',
            'description'=> 'required|string',
            'rating'     => 'required|string|max:5',
            'img_game'   => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi file gambar
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Upload image
        $img_game = $request->file('img_game'); // Pastikan nama field sesuai
        $imagePath = $img_game->storeAs('public/gamelist', $img_game->hashName());

        // Create gamelist
        $gamelist = gamelist::create([
            'gamename'   => $request->gamename,
            'genre'      => $request->genre,
            'release'    => $request->release,
            'description'=> $request->description,
            'rating'     => $request->rating,
            'img_game'   => $img_game->hashName(), // Simpan nama file gambar
        ]);

        // Return response
        return new gamelistResource(true, 'Data gamelist Berhasil Ditambahkan!', $gamelist);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        // Find gamelist by ID
        $gamelist = gamelist::find($id);

        // Check if gamelist exists
        if (!$gamelist) {
            return response()->json(['message' => 'Gamelist not found'], 404);
        }

        // Return single gamelist as a resource
        return new gamelistResource(true, 'Detail Data gamelist!', $gamelist);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'gamename'   => 'required|string|max:255',
            'genre'      => 'required|string|max:255',
            'release'    => 'required|string|max:255',
            'description'=> 'required|string',
            'rating'     => 'required|string|max:5',
            'img_game'   => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Gambar opsional pada update
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Find gamelist by ID
        $gamelist = gamelist::find($id);

        // Check if gamelist exists
        if (!$gamelist) {
            return response()->json(['message' => 'Gamelist not found'], 404);
        }

        // Update gamelist without image if no new image is provided
        $data = [
            'gamename'   => $request->gamename,
            'genre'      => $request->genre,
            'release'    => $request->release,
            'description'=> $request->description,
            'rating'     => $request->rating,
        ];

        // Check if a new image is uploaded
        if ($request->hasFile('img_game')) {
            // Upload new image
            $img_game = $request->file('img_game'); // Pastikan nama field sesuai
            $img_game->storeAs('public/gamelist', $img_game->hashName());

            // Delete old image
            Storage::delete('public/gamelist/' . basename($gamelist->img_game));

            // Update image path
            $data['img_game'] = $img_game->hashName();
        }

        // Update gamelist with new data
        $gamelist->update($data);

        // Return response
        return new gamelistResource(true, 'Data gamelist Berhasil Diubah!', $gamelist);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        // Find gamelist by ID
        $gamelist = gamelist::find($id);

        // Check if gamelist exists
        if (!$gamelist) {
            return response()->json(['message' => 'Gamelist not found'], 404);
        }

        // Delete image
        Storage::delete('public/gamelist/' . basename($gamelist->img_game));

        // Delete gamelist
        $gamelist->delete();

        // Return response
        return new gamelistResource(true, 'Data gamelist Berhasil Dihapus!', null);
    }
}