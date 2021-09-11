<?php

namespace App\Http\Controllers;

use Spotify;
use Youtube;
use App\Models\Spot;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;

class SpotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function search(Request $request)
    {
        // Provide some validation
        $this->validate(request(), [
            'song_name' => 'required',
        ]);
        $query = $request->input('song_name');
        $tracks = Spotify::searchTracks($query)->limit(12)->get();
        // dd($tracks);
        // foreach ($tracks as $track) {
        //     if(!empty($track['items'])){
        //         foreach ($track['items'] as $item) {
        //             dd($item);
        //             if(!empty($item['album'])){
        //                 foreach ($item['album']['images'] as $album) {
        //                     // dd($album['url']);
        //                     dd($album);
        //                 }
        //             }
        //         }
        //     }
        // }
        return view('home', compact('tracks', 'query'));
        // return view('results')
        //     ->with('song_name', $song_name);
    }
    public function playlist_home()
    {
        return view('playlist');
    }
    public function playlist_search(Request $request)
    {
        // Provide some validation
        $this->validate(request(), [
            'playlist' => 'required',
        ]);
        $video_urls = array();
        $query = $request->input('playlist');
        // https://open.spotify.com/playlist/7Gk43hVIlI8sfl4TptWgkq?si=973995e2a8974cf0
        // Get 7Gk43hVIlI8sfl4TptWgkq
        $segment = explode('/' ,$query);
        $url = explode('?' ,$segment[4]);
        $playlist = Spotify::playlist($url[0])->get();
        // ddd($playlist);
        $countTracks = count($playlist['tracks']['items']);
        // foreach ($playlist['tracks']['items'] as $track){
        //     $video_id = Youtube::searchVideos($track['track']['name'].' '.$track['track']['artists'][0]['name'])[0]->id->videoId;
        //     $video_url = 'www.youtube.com/watch?v='.$video_id;
        //     $video_urls[] = $video_url;
        // }
        // ddd($video_urls);
        // ddd($playlist['tracks']['items'][0]['track']['artists']);
        // ddd($playlist['tracks']['items'][0]['track']['album']['images']);
        return view('playlist', compact('playlist', 'countTracks', 'query'));
    }

    public function download_search()
    {
        return view('download');
    }

    public function prepare(Request $request)
    {
        $this->validate($request, [
           'url' => 'required'
        ]);

        try {
            $process = new Process([
                'youtube-dl',
                '-f140',
                $request->url,
                '-o',
                storage_path('app/public/downloads/%(title)s.%(ext)s')
                , '--print-json'
            ]);

            $process->mustRun();

            $output = json_decode($process->getOutput(), true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception("Could not download the file!");
            }

            return response()->download($output['_filename']);

        }  catch (\Throwable $exception) {
            $request->session()->flash('error', 'Could not download the given link!');
            logger()->critical($exception->getMessage());
            return back();
        }
    }

    // Roadmap

    // Update spotify search to contain album, artist, playlist and track
        // Spotify::searchItems('query', 'album, artist, playlist, track')->get();
    // Click on album name to show album details
        // Spotify::album('album_id')->get();
        // Spotify::albumTracks('album_id')->get();
        // Show data in a table
        // Download individual songs
            // Integrate youtube api
            // Search youtube for the track in question using the track and artist name 
            // Grab the first result url
            // Call prepare controller function
        // Download entire album
            // Implement the same but for the above

    // Search for spotify playlist by name or url
        // Spotify::searchPlaylists('query')->get();
    // Show table of playlists from result
    // Show selected playlist songs in a table
    // Download song individually
    // Download entire playlist
}
