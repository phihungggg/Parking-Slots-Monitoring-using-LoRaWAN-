<?php

namespace App\Livewire;
use Livewire\Attributes\On; 
use Livewire\Component;

class Maps extends Component



{  public $message; 
    
    public $latitud;
    public $longitud;
    public function render()
    {
        return view('livewire.maps');
    }

   
    protected $listeners = ['markerClicked' => 'dosomething'];


    public function dosomething($lat,$lng)
    {
        // Set the message based on the data received
        $this->latitud = $lat;
        $this->longitud= $lng;
        $this->message = "Marker clicked at Latitude: {$this->latitud}, Longitude: {$this->longitud}";

       

    }

    public function dosomething2()
    {
        $value=1;

        $this->dispatchBrowserEvent('name-updated', ['newName' => $value]);

    }
}   
