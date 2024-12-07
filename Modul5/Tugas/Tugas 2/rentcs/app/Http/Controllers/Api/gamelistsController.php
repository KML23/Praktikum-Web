<?php

namespace App\Http\Controllers\Api;

use App\Models\gamelist;
use App\Http\Controllers\Controller;
use App\Http\Resources\gamelistsResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class gamelistsController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $gamelists = gamelist::all();
        return new gamelistsResource(true, 'List Data Games', $gamelists);
    }

    /**
     * store
     *
     * @param mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gamename' => 'required|string',
            'genre' => 'required|string',
            'release' => 'required|string',
            'description' => 'required|string',
            'rating' => 'required|string',
            'img_game' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Upload image
        $img_game = $request->file('img_game');
        $img_game->storeAs('public/gamelists', $img_game->hashName());

        // Simpan data game
        $gamelist = gamelist::create([
            'gamename' => $request->gamename,
            'genre' => $request->genre,
            'release' => $request->release,
            'description' => $request->description,
            'rating' => $request->rating,
            'img_game' => $img_game->hashName(),
        ]);

        return new gamelistsResource(true, 'Data Game Berhasil Ditambahkan!', $gamelist);
    }

    /**
     * update
     *
     * @param mixed $request
     * @param mixed $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'gamename' => 'required|string',
            'genre' => 'required|string',
            'release' => 'required|string',
            'description' => 'required|string',
            'rating' => 'required|string',
            'img_game' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $gamelist = gamelist::find($id);

        if (!$gamelist) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        if ($request->hasFile('img_game')) {
            $img_game = $request->file('img_game');
            $img_game->storeAs('public/gamelists', $img_game->hashName());
            Storage::delete('public/gamelists/' . $gamelist->img_game);

            $gamelist->update([
                'gamename' => $request->gamename,
                'genre' => $request->genre,
                'release' => $request->release,
                'description' => $request->description,
                'rating' => $request->rating,
                'img_game' => $img_game->hashName(),
            ]);
        } else {
            $gamelist->update([
                'gamename' => $request->gamename,
                'genre' => $request->genre,
                'release' => $request->release,
                'description' => $request->description,
                'rating' => $request->rating,
            ]);
        }

        return new gamelistsResource(true, 'Data Game Berhasil Diubah!', $gamelist);
    }

    /**
     * destroy
     *
     * @param mixed $id
     * @return void
     */
    public function destroy($id)
    {
        $gamelist = gamelist::find($id);

        if (!$gamelist) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        Storage::delete('public/gamelists/' . $gamelist->img_game);
        $gamelist->delete();

        return new gamelistsResource(true, 'Data Game Berhasil Dihapus!', null);
    }
}
