<?php

namespace App\Http\Controllers\Cabinet;

use App\Entity\Ticket\Ticket;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\CreateRequest;
use App\Http\Requests\Ticket\MessageRequest;
use App\Models\Conversation;
use App\Services\CategoriesService;
use App\UseCases\Tickets\TicketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TicketController extends Controller
{
    private $service;

    public function __construct(TicketService $service, CategoriesService $categoriesService)
    {
        $this->categoriesArray = $categoriesService;
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray->getCategories();

        if($request->type=='send')
        {
            $conversations  = Conversation::where('send_id', Auth::id())->with('user')
                ->with('messages')
                ->orderBy('id', 'desc')->get();
            for($i = 0; $i < count($conversations); $i++){
                $db = 'App\Models\\' . $conversations[$i]->slug;
                $conversations[$i]['announcement']  =   $db::where('id', $conversations[$i]->product_id)->select('name')->first();
            }
            return view('cabinet.tickets.send', compact('conversations','locale','categoriesArray'));
        }
        $conversations  = Conversation::where('user_id', Auth::id())->with('user')
            ->with('messages')
            ->orderBy('id', 'desc')->get();
        for($i = 0; $i < count($conversations); $i++){
            $db = 'App\Models\\' . $conversations[$i]->slug;
            $conversations[$i]['announcement']  =   $db::where('id', $conversations[$i]->product_id)->select('name')->first();
        }
//dd($conversations);

        return view('cabinet.tickets.index', compact('conversations','locale','categoriesArray'));
    }

    public function send()
    {
        $locale = app()->getLocale();
        $categoriesArray = $this->categoriesArray->getCategories();
    }

    public function show(Ticket $ticket)
    {
        return view('cabinet.tickets.show', compact('ticket'));
    }

    public function create()
    {
        return view('cabinet.tickets.create');
    }

    public function store(CreateRequest $request)
    {
        try {
            $ticket = $this->service->create(Auth::id(), $request);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('cabinet.tickets.show', $ticket);
    }

    public function message(MessageRequest $request, Ticket $ticket)
    {
        try {
            $this->service->message(Auth::id(), $ticket->id, $request);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('cabinet.tickets.show', $ticket);
    }

    public function destroy(Ticket $ticket)
    {
        $this->checkAccess($ticket);
        try {
            $this->service->removeByOwner($ticket->id);
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect()->route('cabinet.favorites.index');
    }

    private function checkAccess(Ticket $ticket): void
    {
        if (!Gate::allows('manage-own-ticket', $ticket)) {
            abort(403);
        }
    }
}
