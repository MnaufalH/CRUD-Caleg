<?php

namespace App\Http\Controllers;
use App\Models\Partai;
use Illuminate\View\view;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class PartaiController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(Request $request):view
    {
        $searchkey = $request->searchkey;
        $rows = 5;
        if (strlen($searchkey)) {
            $partais = Partai::where('pimpinan', 'like', "%$searchkey%")
                ->orWhere('nama_partai', 'like', "%$searchkey%")
                ->paginate($rows);
        } else {
            $partais = Partai::latest()->paginate($rows);
        }

        //render view with posts
        return view('partais.index', compact('partais'));
    }

    public function create():view
    {
        return view('partais.create');
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
            'logo_partai'            => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'nama_partai'            => 'required|min:3',
            'pimpinan'               => 'required|min:5',
            'vmisi'                  => 'required|min:8',
            'periode'                => 'required|min:8'
        ]);

        //upload image
        $image = $request->file('logo_partai');
        $image->storeAs('public/partais', $image->hashName());

        //create post
        Partai::create([
            'logo_partai' => $image->hashName(),
            'nama_partai' => $request->nama_partai,
            'pimpinan'  => $request->pimpinan,
            'vmisi' => $request->vmisi,
            'periode' => $request->periode
        ]);

        //redirect to index
        return redirect()->route('partais.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
        $partai = Partai::findOrFail($id);

        //render view with post
        return view('partais.show', compact('partai'));
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
        $partai = Partai::findOrFail($id);

        //render view the post
        return view('partais.edit', compact('partai'));
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
            'logo_partai' => 'image|mimes:jpeg,jpg,png|max:2048',
            'nama_partai' => 'required|min:3',
            'pimpinan' => 'required|min:5',
            'vmisi' => 'required|min:8',
            'periode' => 'required|min:8'
        ]);

        //get post by Id

        $partai = Partai::findOrFail($id);

        //check if image is uploaded

        if ($request->hasFile('logo_partai')) {

            //upload new image
            $image = $request->file('logo_partai');
            $image->storeAs('public/partais', $image->hashName());

            //delete old image

            Storage::delete('public/partais' . $partai->image);

            //update post with new image 

            $partai->update([
                'logo_partai' => $image->hashName(),
                'nama_partai' => $request->nama_partai,
                'pimpinan' => $request->pimpinan,
                'vmisi' => $request->vmisi,
                'periode' => $request->periode
            ]);


        } else {

            //update post without image
            $partai->update([
                'nama_partai' => $request->nama_partai,
                'pimpinan' => $request->pimpinan,
                'vmisi' => $request->vmisi,
                'periode' => $request->periode
            ]);
        }

        //redirect to index

        return redirect()->route('partais.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $partai
     * @return void
     */

    public function destroy($id): RedirectResponse
    {
        //get post by id
        $partai = Partai::findOrFail($id);

        //delete image
        Storage::delete('public/partais/' . $partai->foto);

        //delete post
        $partai->delete();

        //redirect to index
        return redirect()->route('partais.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
