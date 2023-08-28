<?php

namespace App\Http\Controllers;

//import model caleg
use App\Models\Caleg;
use App\Models\Partai;
//return type view
use Illuminate\View\View;
//import facade stroage
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CalegController extends Controller
{
    /**
     * index
     *
     * @return View
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): view
    {
        $searchkey = $request->searchkey;
        $rows = 5;
        if (strlen($searchkey)) {
            $calegs = Caleg::where('nama', 'like', "%$searchkey%")
                ->orWhere('gender', 'like', "%$searchkey%")
                ->orWhere('partaiId', 'like', "%$searchkey%")
                ->orWhere('alamat', 'like', "%$searchkey%")
                ->orWhere('ttl', 'like', "%$searchkey%")
                ->paginate($rows);
        } else {
            $calegs = Caleg::with('partais')->paginate($rows);
        }

        //render view with posts
        return view('calegs.index', compact('calegs'));
    }

    public function create(): view
    {
        $partais = Partai::latest()->paginate(5);
        
        return view('calegs.create', compact('partais'));
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'foto' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'nama' => 'required|min:5',
            'ttl' => 'required|min:10',
            'gender' => 'required|in:Laki-Laki,Perempuan',
            'alamat' => 'required|min:8',
            'pendidikan_terakhir' => 'required|min:2',
            'partaiId' => 'required|exists:partais,id'
        ]);

        //upload image
        $image = $request->file('foto');
        $image->storeAs('public/calegs', $image->hashName());

        //create post
        Caleg::create([
            'foto' => $image->hashName(),
            'nama' => $request->nama,
            'ttl' => $request->ttl,
            'gender' => $request->gender,
            'alamat' => $request->alamat,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'partaiId' => $request->partaiId
        ]);

        //redirect to index
        return redirect()->route('calegs.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get post by ID
        $caleg = Caleg::findOrFail($id);

        //render view with post
        return view('calegs.show', compact('caleg'));
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */

    public function edit(string $id): View
    {
        //get post by id
        $caleg = Caleg::findOrFail($id);

        //render view the post
        return view('calegs.edit', compact('caleg'));
    }


    /**
     * update
     *
     * @param  mixed $request 
     * @param  mixed $id
     * @return RedirectResponse
     */

    public function update(Request $request, $id): RedirectResponse
    {

        //validate form

        $this->validate($request, [
            'foto' => 'image|mimes:jpeg,jpg,png|max:2048',
            'nama' => 'required|min:5',
            'ttl' => 'required|min:10',
            'alamat' => 'required|min:8',
            'pendidikan_terakhir' => 'required|min:2',
            'partaiId' => 'required|exists:partais,id'
        ]);

        //get post by Id

        $caleg = Caleg::findOrFail($id);

        //check if image is uploaded

        if ($request->hasFile('foto')) {

            //upload new image
            $image = $request->file('foto');
            $image->storeAs('public/calegs', $image->hashName());

            //delete old image

            Storage::delete('public/calegs' . $caleg->image);

            //update post with new image 

            $caleg->update([
                'foto' => $image->hashName(),
                'nama' => $request->nama,
                'ttl' => $request->ttl,
                'alamat' => $request->alamat,
                'pendidikan_terakhir' => $request->pendidikan_terakhir,
                'partaiId' => $request->partaiId
            ]);


        } else {

            //update post without image
            $caleg->update([
                'nama' => $request->nama,
                'ttl' => $request->ttl,
                'alamat' => $request->alamat,
                'pendidikan_terakhir' => $request->pendidikan_terakhir,
                'partaiId' => $request->partaiId
            ]);
        }

        //redirect to index

        return redirect()->route('calegs.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $caleg
     * @return void
     */

    public function destroy($id): RedirectResponse
    {
        //get post by id
        $caleg = Caleg::findOrFail($id);

        //delete image
        Storage::delete('public/calegs/' . $caleg->foto);

        //delete post
        $caleg->delete();

        //redirect to index
        return redirect()->route('calegs.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}