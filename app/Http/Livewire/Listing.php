<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Listing as Mlisting;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
class Listing extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $photo;


public $search='';
public $name;
public $address;
public $website;
public $email;
public $phone;
public $bio;
public $showModal=false;
public $editMode=false;
public $listingId;
public $photoname;

protected $rules=[
'name'=>'required',
'address'=>'required',
'website'=>'required|url',
'email'=>'required|email',
'phone'=>'required',
'bio'=>'required|max:255',
    'photo' =>  'image|max:1024'

];



public function ShowCreateModal()
{
    $this->reset();
    $this->showModal=true;
    $this->editMode=false;
}
public function ShowEditModal($id)
{

    $this->showModal=true;
    $this->editMode=true;
    $this->listingId =  Mlisting::findorfail($id);

    $this->name=$this->listingId->name;
    $this->address=$this->listingId->address;
    $this->website=$this->listingId->website;
    $this->email=$this->listingId->email;
    $this->phone=$this->listingId->phone;
    $this->bio=$this->listingId->bio;
    $this->photoname=$this->listingId->photoname;
    $this->validate();

}
public function  listingUpdate()
{


    $this->validate();
if (isset($this->listingId->id)){

    if (isset($this->listingId->photoname)) {

        Storage::disk('public')->delete($this->listingId->photoname);
    }


    $folder = date('Y-m-d');
    $this->photoname=$this->photo->store("photos/{$folder}", 'public');

    $updateid=Mlisting::findorfail($this->listingId->id);
    $updateid->update([
        'name'=>$this->name,
        'address'=>$this->address,
        'website'=>$this->website,
        'email'=>$this->email,
        'phone'=>$this->phone,
        'bio'=>$this->bio,
        'photoname'=>$this->photoname,

    ]);
}
    $this->dispatchBrowserEvent('alert',
        ['type' => 'success', 'title' => 'Success!', 'message' => 'Listing created successfuly']);
//    session()->flash('flash.banner', 'Listing created successfuly');

    $this->reset();
}

public function  createLisitng()
{

    $folder = date('Y-m-d');
    $this->photoname=$this->photo->store("photos/{$folder}", 'public');

$this->validate();
Auth::user()->listings()->create([
    'name'=>$this->name,
    'address'=>$this->address,
    'website'=>$this->website,
    'email'=>$this->email,
    'phone'=>$this->phone,
    'bio'=>$this->bio,
 'photoname'=>$this->photoname ?? null
    ]

);


    $this->dispatchBrowserEvent('alert',
        ['type' => 'success', 'title' => 'Success!', 'message' => 'Listing created successfuly']);
$this->reset();
}

    public function deleteListing($id)
    {
      $listing =  Mlisting::findorfail($id);
        $listing->delete();
if (isset($listing->photoname)) {

    Storage::disk('public')->delete($listing->photoname);
    }


        $this->dispatchBrowserEvent('alert',
            ['type' => 'success', 'title' => 'Success!', 'message' => 'Listing deleted successfuly']);
    }


    public function updatedPhoto()
    {

    }

    public function save()
    {
        $this->validate();



            $folder = date('Y-m-d');
            $this->photo->store("photos/{$folder}", 'public');



        $this->reset();
//        $this->validate([
//            'photos.*' => 'image|max:1024', // 1MB Max
//        ]);

//        foreach ($this->photo as $photoe) {
//            $photoe->store('photos');
//        }


    }



    public function render()
    {

        $listings = Auth::user()->listings()->paginate(2);
        if (isset($this->search)) {
//            sleep(1);
//            DB::enableQueryLog();
            $listings = Auth::user()
                ->listings()
                ->where('name', 'like', "{$this->search}%")
                ->paginate(2);
        }
//        dd(DB::getQueryLog());
        return view('livewire.listing', [
            'listings' => $listings
        ]);



//        return view('livewire.listing',['listings'=>Auth::user()->listings]);
    }
}
