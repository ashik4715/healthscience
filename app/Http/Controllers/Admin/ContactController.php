<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ImageUploadService;

class ContactController extends Controller
{
    public function index()
    {
        $contact = Contact::all();
        return view('admin.contact_us.index', compact(['contact']));
    }

    public function create()
    {
        return view('admin.contact_us.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'office_photo' => 'nullable|image',
            'office_name' => 'nullable',
            'location_name' => 'nullable',
            'location_url' => 'nullable',
            'location_address' => 'nullable',
            'telephone_no' => 'nullable',
            'fax_no' => 'nullable',
            'office_hours' => 'nullable',
        ]);

        $file = $request->office_photo;
        if (!file_exists('images/contact_us')){
            mkdir('images/contact_us',0777, true);
        }
        $path = 'images/contact_us/';
        $title = 'contact_us_image_';
        $image_url = ImageUploadService::fileUploadWithDirCreate($path, $file, $title);

        Contact::create(
            [
                'office_photo' => $image_url,
                'office_name' => $request->office_name,
                'location_name' => $request->location_name,
                'location_url' => $request->location_url,
                'location_address' => $request->location_address,
                'telephone_no' => $request->telephone_no,
                'fax_no' => $request->fax_no,
                'office_hours' => $request->office_hours,

                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
            ]
        );

        return redirect()->route('admin.contact.index');
    }

    public function show(Contact $contact)
    {
        //
    }

    public function edit(Contact $contact)
    {
        return view('admin.contact_us.edit',compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'office_photo' => 'nullable|image',
            'office_name' => 'nullable',
            'location_name' => 'nullable',
            'location_url' => 'nullable',
            'location_address' => 'nullable',
            'telephone_no' => 'nullable',
            'fax_no' => 'nullable',
            'office_hours' => 'nullable',
        ]);

        $image_url = $contact->office_photo;

        if ($request->office_photo) {
            $file = $request->office_photo;
            $path = 'images/contact_us/';
            $title = 'contact_us_image_';
            $image_url = ImageUploadService::fileUploadWithDirCreate($path, $file, $title);
        }

        $contact->update(
            [
                'office_photo' => $image_url,
                'office_name' => $request->office_name,
                'location_name' => $request->location_name,
                'location_url' => $request->location_url,
                'location_address' => $request->location_address,
                'telephone_no' => $request->telephone_no,
                'fax_no' => $request->fax_no,
                'office_hours' => $request->office_hours,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
            ]
        );

        return redirect()->route('admin.contact.index');
    }

    public function destroy(Contact $contact)
    {
        try {
            $contact->delete();
        } catch (\Exception $e) {
            session()->flash('message', 'Failed to delete SDIP Contact Us');
        }
        return redirect()->route('admin.contact.index');
    }
}
