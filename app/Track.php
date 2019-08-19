<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    public function owner(){
        return $this->belongsTo(User::class, 'artist_id');
    }

    public function featured(){
        return $this->hasOne(Feature::class, 'feature_id');
    }

    public function addTrack($request){
        $trackRequest = $request->file('track');
        $title = time() . '.' . $trackRequest->getClientOriginalExtension();
        $path = public_path('tracks/');
        $trackRequest->move($path, $title);
        return $title;
    }

    public static function getTrackArchives(){
        return Track::with('owner')->featured()->notThisWeek()->get();
    }

    public static function getWeeklyTrackArchives(){
        $tracks = Track::getTrackArchives();
        return $tracks->groupBy(function($track) {
            //group tracks by week
            return now()->parse($track->created_at)->format('W');
        });
    }

    public function scopeWeekly($query){
        $startWeek = now()->startOfWeek();
        $endWeek =  now()->endOfWeek();

        return $query->whereBetween('created_at', [$startWeek , $endWeek]);
    }
    public function scopeNotThisWeek($query){
        $startWeek = now()->startOfWeek();
        $endWeek =  now()->endOfWeek();

        return $query->whereNotBetween('created_at', [$startWeek , $endWeek]);
    }

    public function scopeFeatured($query){
        return $query->has('featured');
    }
    public function scopeNotFeatured($query){
        return $query->doesntHave('featured');
    }

    public function scopeArtist($query, $id){
        return $query->where('artist_id', '=', $id);
    }

}

