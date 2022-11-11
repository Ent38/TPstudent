<?php

namespace App\Http\Livewire;

use App\Models\AddToCart;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use Livewire\Component;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class Cart extends Component
{
    public $getUserAddToCartProduct;

    public function render()
    {
        if (Auth::check()) {
            $this->updateCartAfterUserLogin();
        }
        $this->getAddToCartProducts();

        return view('livewire.cart');
    }

    public function removeBookFromCart($id)
    {
        $addToCart = AddToCart::find($id);

        $addToCart->delete();
        $this->emit('updateAddToCartCount');

        session()->flash('success', 'Product removed from cart !!!');
    }

    public function getAddToCartProducts()
    {
        $agent = new Agent();

        $this->getUserAddToCartProduct = Auth::check()
            ? AddToCart::with('Book')->whereUserId(auth()->user()->id)
            ->whereStatus('!=', \constPayPalStatus::SUCCESS)
            ->get()
            : AddToCart::with('Book')->whereBrowserName($agent->browser())
            ->whereStatus('!=', \constPayPalStatus::SUCCESS)->get();
    }

    public function addToCartButton($Book_id)
    {
        $agent = new Agent();

        // dd($Book_id);

        $Book = Book::find($Book_id);

        // Sorry here is if the Book is already inside tha cart

        if (count(AddToCart::where(['browser_name' => $agent->browser(), 'Book_id' => $Book_id])->get()) > 0) {
            session()->flash('info', 'The Book'.$Book->name.' is already available in cart');

            return;
        }

        // Sorry here is if the authenticated users Book is already inside tha cart

        elseif (Auth::check() && count(AddToCart::where(['user_id' => auth()->user()->id, 'Book_id' => $Book_id])->get()) > 0) {
            session()->flash('info', 'The Book '.$Book->name.' is already available in cart');

            return;
        }

        // Check if the user is not logged in add to cart with the broswer name
        if (! Auth::check()) {
            AddToCart::create(['browser_name' => $agent->browser(), 'Book_id' => $Book_id, 'price' => $Book->price, 'qty' => 1]);
        }

        // If the user is logged in add to cart with User Id;
        else {
            AddToCart::create(['user_id' => auth()->user()->id, 'Book_id' => $Book_id, 'price' => $Book->price, 'qty' => 1]);
        }

        session()->flash('success', 'The Book'.$Book->name.' added to cart');
        $this->emit('updateAddToCartCount');
    }

    public function checkOut($Book_id = null)
    {
        if (! empty($Book_id)) {
            $this->addToCartButton($Book_id);  // is a function
        }

        // if (!Auth::check()) {
        //     return   $this->dispatchBrowserEvent('loginModal');
        // }

        $this->getUserAddToCartProduct = AddToCart::with('Book')->whereUserId(auth()->user()->id)
            ->where('status', '!=', \constPayPalStatus::SUCCESS)
            ->get();

        $provider = new PayPalClient([]);
        $token = $provider->getAccessToken();
        $provider->setAccessToken($token);

        // dd($provider);

        $payPalOrder = $provider->createOrder([
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'amount' => [
                        'currency_code' => 'USD',
                        'value' => $this->getUserAddToCartProduct->sum('price'),
                    ],
                ],
            ],
            'application_context' => [
                'cancel_url' => route('payment.cancel'),
                'return_url' => route('payment.success'),
            ],

        ]);

        // dd($payPalOrder);

        if ($payPalOrder['status'] == 'CREATED') {
            foreach ($this->getUserAddToCartProduct as $key => $cartBook) {
                $cartBook->status = \constPayPalStatus::IN_PROCESS;
                $cartBook->payment_id = $payPalOrder['id'];
                $cartBook->save();
            }

            return redirect($payPalOrder['links'][1]['href']);
        } else {
            return redirect()->back()->with('Whoops!! Something got wrong');
        }
    }

    public function updateAddToCartAfterUserLogin()
    {
        $agent = new Agent();

        $BooksInCartByIpBrowserName = AddToCart::with('Book')
            ->whereBrowserName($agent->browser());

        if (count($BooksInCartByIpBrowserName->get()) > 0) {
            $BooksInCartByIpBrowserName->update(
                ['user_id' => auth()->user()->id, 'browser_name' => null]
            );
        }
    }
}
