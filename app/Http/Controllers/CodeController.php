<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Code; 
use Illuminate\Support\Facades\Auth;

class CodeController extends Controller
{
    public function index()
    {
        $codes = Code::all(); 
        return view('contentview', compact('codes'));
    }

    public function show($id)
    {
        $code = Code::findOrFail($id); 
        return view('detailview', compact('code'));
    }

    public function create()
    {
        // Pastikan hanya Super Admin yang bisa mengakses
        if (!Auth::user() || !Auth::user()->isSuperAdmin()) {
            return redirect('/')->with('error', 'Unauthorized access.');
        }
    
        return view('createcode');
    }
    

    public function store(Request $request)
    {
        if (!Auth::user()->isSuperAdmin()) {
            return redirect()->route('codes.index')->with('error', 'Unauthorized access.');
        }

        // Validate and store the new code
        $request->validate([
            'name' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'logo' => 'required|image|max:2048', // Contoh validasi file gambar
        ]);
    
        $code = new Code;
        $code->name = $request->name;
        $code->deskripsi = $request->deskripsi;
        
        // Handle file upload
        if ($request->hasFile('logo')) {
            $filename = time().'.'.$request->logo->getClientOriginalExtension();
            $request->logo->move(public_path('images'), $filename);
            $code->logo = 'images/'.$filename;
        }
    
        $code->user_id = Auth::id(); // Mengatur user_id ke user yang sedang login
        $code->save();
    
        return redirect()->back()->with('success', 'Data berhasil ditambahkan');

    }

    public function edit($id)
    {
        if (!Auth::user()->isSuperAdmin()) {
            return redirect()->route('codes.index')->with('error', 'Unauthorized access.');
        }

        $code = Code::findOrFail($id);
        return view('editCode', compact('code'));
    }


    public function update(Request $request, $id)
            {
                $request->validate([
                    'name' => 'required|string|max:255',
                    'deskripsi' => 'required|string',
                    'logo' => 'image|max:2048', // Validasi file gambar, opsional
                ]);

                $code = Code::findOrFail($id);
                $code->name = $request->name;
                $code->deskripsi = $request->deskripsi;
                
                // Jika file logo baru diunggah
                if ($request->hasFile('logo')) {
                    $filename = time().'.'.$request->logo->getClientOriginalExtension();
                    $request->logo->move(public_path('images'), $filename);
                    $code->logo = 'images/'.$filename;
                }

                $code->save();

                //return redirect()->route('contentview')->with('success', 'Data berhasil diupdate');
                return back()->with('success', 'Data berhasil diupdate');

            }






    public function destroy($id)
        {
            if (!Auth::user()->isSuperAdmin()) {
                return redirect()->route('codes.index')->with('error', 'Unauthorized access.');
            }

            $code = Code::findOrFail($id);
            $code->delete();

            return redirect()->route('codes.index')->with('success', 'Code deleted successfully.');
        }


                public function viewById($id)
                {
                    $code = Code::findOrFail($id); // Ganti 'Code' dengan model yang sesuai
                    return view('viewbyid', compact('code'));
                }




}
