<?php

namespace App\Components\Episode;

use App\Components\Episode\Repositories\EpisodeRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EpisodeApiController extends Controller
{
    /**
     * @var EpisodeRepository
     */
    private $episodeRepository;

    /**
     * EpisodeApiController constructor.
     *
     * @param EpisodeRepository $episode
     */
    public function __construct(EpisodeRepository $episode)
    {
        $this->episodeRepository = $episode;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        //
    }
}
