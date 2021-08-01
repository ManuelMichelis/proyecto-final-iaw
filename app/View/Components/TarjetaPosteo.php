<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TarjetaPosteo extends Component
{
    /**
     * Posteo asociado al componente
     */
    public $posteo;

    /**
     * Crea el componente con el posteo al cual estara vinculado
     */
    public function __construct($posteo)
    {
        $this->posteo = $posteo;
        $this->render();
    }


    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.tarjeta-posteo');
    }
}
