<?php

namespace App\Http\Controllers;

use Spotify;
use Youtube;
use App\Models\Spot;
use App\Models\Song;
use App\Jobs\DownloadSong;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
    public function about()
    {
        return view('about');
    }
    public function songHome()
    {
        return view('song');
    }
    public function songSearch(Request $request)
    {
        // Provide some validation
        $this->validate(request(), [
            'song_name' => 'required',
        ]);
        $query = $request->input('song_name');
        $tracks = Spotify::searchTracks($query)->limit(12)->get();
        return view('song', compact('tracks', 'query'));
    }
    public function downloadSong($search_key)
    {
        $params = [
            'q'             => $search_key,
            'type'          => 'video',
            'maxResults'    => 1
        ];
        $results = Youtube::searchAdvanced($params);
        $video_id = $results[0]->id->videoId;
        $url = 'www.youtube.com/watch?v='.$video_id;
        // $url = 'https://www.youtube.com/watch?v=Af8b0JAznqc';

        // ------------------------------

        $song = Song::create([
            'url' => $url,
            'filename' => $search_key
        ]);

        DownloadSong::dispatch($song);

        return redirect()->route('status', ['song' => $song]);

        // ------------------------------

        // try {
        //     $process = new Process([
        //         'youtube-dl',
        //         '-f140',
        //         $url,
        //         '-o',
        //         storage_path('app/public/downloads/%(title)s.%(ext)s')
        //         , '--print-json'
        //     ]);

        //     $process->mustRun();

        //     $output = json_decode($process->getOutput(), true);

        //     if (json_last_error() !== JSON_ERROR_NONE) {
        //         throw new \Exception("Could not download the file!");
        //     }

        //     return response()->download($output['_filename']);

        // }  catch (\Throwable $exception) {
        //     $request->session()->flash('error', 'Could not download the given link!');
        //     logger()->critical($exception->getMessage());
        //     return back();
        // }
    }
    public function playlistHome()
    {
        return view('playlist');
    }
    public function playlistSearch(Request $request)
    {
        // Provide some validation
        $this->validate(request(), [
            'playlist' => 'required|url',
        ]);
        $query = $request->input('playlist');
        // https://open.spotify.com/playlist/7Gk43hVIlI8sfl4TptWgkq?si=973995e2a8974cf0
        // Get 7Gk43hVIlI8sfl4TptWgkq
        $segment = explode('/' ,$query);
        $url = explode('?' ,$segment[4]);
        $playlistId = $url[0];
        $playlist = Spotify::playlist($playlistId)->get();
        $countTracks = count($playlist['tracks']['items']);
        return view('playlist', compact('playlist', 'countTracks', 'playlistId', 'query'));
    }

    public function playlistDownload($link)
    {
        $video_urls = array();
        $playlist = Spotify::playlist($link)->get();
        foreach ($playlist['tracks']['items'] as $track){
            // $video_id = Youtube::searchVideos($track['track']['name'].' '.$track['track']['artists'][0]['name'])[0]->id->videoId;
            $search_key = $track['track']['name'].' '.$track['track']['artists'][0]['name'];
            // ddd($search_key);
            $spot_controller = new SpotController;
            $spot_controller->downloadSong($search_key);
            // $video_url = 'www.youtube.com/watch?v='.$video_id;
            // $video_urls[] = $video_url; c
        }
        return view('playlist', compact('playlist'));
    }

    public function playlistList($link)
    {
        $video_urls = array();
        $playlist = Spotify::playlist($link)->get();
        foreach ($playlist['tracks']['items'] as $track){
            $params = [
                'q'             => $track['track']['name'].' '.$track['track']['artists'][0]['name'],
                'type'          => 'video',
                'maxResults'    => 1
            ];
            $results = Youtube::searchAdvanced($params);
            $video_id = $results[0]->id->videoId;
            $video_url = 'www.youtube.com/watch?v='.$video_id;
            $video_urls[] = $video_url;
        }
        ddd($video_urls);
        return view('playlist', compact('playlist'));
    }

    public function status(Song $song)
    {
        return view('status', ['song' => $song]);
    }

    public function download(Song $song)
    {
        abort_if($song->status !== 'completed', 404);
        $filenameNoSpace = str_replace(' ', '_', $song->info->fulltitle).'.m4a';
        $filename = str_replace(['[', ']'], '', $filenameNoSpace);
        $file = public_path('downloads/'.$filename);
        // ddd($file);
        return response()->download($file);
    }
}
